<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		$this->load->view('indicators_dashboard');
	}

	public function load_uf_data(){

		$apiUrl = 'https://mindicador.cl/api/uf';
			//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
		if ( ini_get('allow_url_fopen') ) {
		    $json = file_get_contents($apiUrl);
		} else {
		    //De otra forma utilizamos cURL
		    $curl = curl_init($apiUrl);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    $json = curl_exec($curl);
		    curl_close($curl);
		}
		 
		$ufValues = json_decode($json);

		foreach ($ufValues->serie as $key => $value) {
			
			$data_to_load[] = array('date' => $value->fecha, 'value' => $value->valor);
			
		}

		$this->Dashboard_model->load_uf_data($data_to_load);

	}

	public function load_uf_data_to_table(){

		$fetch_data = $this->Dashboard_model->make_datatable();

		$data = array();

		foreach ($fetch_data as $row) {
			$sub_array = array();

			$sub_array[] = $row->id;

			$sub_array[] = '<div class="input-field col s12">
					          <input id="inputDate'.$row->id.'" type="text" class="validate" value="'.$row->date.'" disabled>
					        </div>';

			$sub_array[] = '<div class="input-field col s12">
					          <input id="inputValue'.$row->id.'" type="text" class="validate" value="'.$row->value.'" disabled>
					        </div>';

			$sub_array[] = '<button
								type="button"
								id="'.$row->id.'"
								name="delete"
								onclick="deleteIndicator('.$row->id.')"
								data-position="top" data-tooltip="Delete"
								class="waves-effect waves-light btn-small red btn-sm"
								>
								<i class="material-icons center">delete</i>
							</button>';

			$sub_array[] = '<button
								type="button"
								id="editButton'.$row->id.'"
								name="update"
								onclick="disabledData('.$row->id.')"
								data-state="1"
								data-position="top" data-tooltip="Edit"
								class="btnEdit waves-effect waves-light btn-small orange btn-sm"
								>
								<i class="material-icons center">edit</i>
							</button>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->Dashboard_model->get_all_data(),
			"recordsFiltered" => $this->Dashboard_model->get_filtered_data(),
			"data" => $data
		);

		echo json_encode($output);

	}

	public function create_record(){

		if($this->input->post('new_record')){

			$data = $this->input->post('new_record');

			$new_record = array('date' => $data['date'], 'value' => $data['value']);

			$this->Dashboard_model->create_record($new_record);

		}

	}

	public function delete_record(){

		try {

			if($this->input->post('id_record')){

				$validate_delete = $this->Dashboard_model->delete_record($this->input->post('id_record'));

				echo json_encode($validate_delete);
			}

		} catch (Exception $e) {
			echo json_encode($e);
		}

	}

	public function update_record(){

		try {

			if($this->input->post()){
				
				$data = array(
							'date' => $this->input->post('date'),
							'value' => $this->input->post('value'),
							'updated_at' => date('Y-m-d H:i:s', time())
						);

				$validate_updated = $this->Dashboard_model->updated_record($this->input->post('id'), $data);

				echo json_encode($validate_updated);
			}

		} catch (Exception $e) {
			echo json_encode($e);
		}

	}

	


}
