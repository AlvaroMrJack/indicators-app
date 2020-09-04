<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct(){
        parent::__construct();
		$this->load->database();
    }

    var $table = "uf_historical_data";
    var $select_column = array("id", "date", "value", "created_at", "updated_at");
    var $order_column = array("id", "date", "value", null, null );

    function make_query(){
    	$this->db->select($this->select_column);
    	$this->db->from($this->table);

    	if(isset($_POST["search"]["value"])){
    		$this->db->like("value", $_POST["search"]["value"]);
    		$this->db->or_like("date", $_POST["search"]["value"]);
    	}

    	if(isset($_POST["order"])){
    		$this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    	}else{
    		$this->db->order_by('id', 'desc');
    	}
    }

    function make_datatable(){

    	$this->make_query();

    	if($_POST["length"] != -1){
    		$this->db->limit($_POST["length"], $_POST["start"]);
    	}

    	$query = $this->db->get();
    	return $query->result();
    }

    function get_filtered_data(){
    	$this->make_query();
    	$query = $this->db->get();
    	return $query->num_rows();
    }

    function get_all_data(){

    	$this->db->select('*');
    	$this->db->from('uf_historical_data');
		return $this->db->count_all_results();
    }

	public function load_uf_data($data){
		// print_r($data);exit;
		
		$this->db->trans_begin();

		$this->db->truncate('uf_historical_data');

		if ($this->db->trans_status() === TRUE){
		    
		    $this->db->trans_commit();
	
		    foreach ($data as $row) {
				$this->db->insert('uf_historical_data', $row);
		    }
		    
		}

	}

	public function create_record($data){
		echo "nothing";
	}

	public function delete_record($id){
		$this->db->where('id', $id);
		$this->db->delete('uf_historical_data');
		return $this->db->affected_rows();
	}

	public function updated_record($id, $data){
		$this->db->where('id', $id);
		$this->db->update('uf_historical_data', $data);
		return $this->db->affected_rows();
	}

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */