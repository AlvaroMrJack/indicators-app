<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Indicators App</title>

	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>assets/materialize/css/materialize.min.css"  media="screen,projection"/>
  <!-- Import DataTable.css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <!-- Select2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
  <body class="grey lighten-3">
    <div class="navbar-fixed">
      <nav class="amber accent-2">
        <div class="nav-wrapper">
          
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="https://mindicador.cl/" target="_blank" class="black-text">Indicators API web</a></li>
          </ul>
        </div>
      </nav>
    </div>
	




  <div class="parallax-container">
      <div class="parallax"><img src="<?=base_url()?>assets/img/banner.jpg"></div>
    </div>
    <div class="section grey lighten-3">
      <div class="row container">
        <h2 class="header">Indicators</h2>
        <p class="grey-text text-darken-3 lighten-3">Website where you can see the information about the and can see the historical information about the UF</p>
      </div>
    </div>

    <div class="container">
    	<div class="row">

        <div class="col s12 m12">
          <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Line chart Indicators</span>

    					<div class="row" style="padding: 10px">
    	          <label for="idSelect2">
    						  Select the indicator

    						  <select
    						  	class="indicators-Select browser-default js-states form-control"
    						  	id="idSelect2"
    						  	style="width: 100%"
    						  ></select>

    						</label>
              </div>	

              <div id="chart_div"></div>

            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Historical UF value</span>
                <p>You can reload the historical data about the UF clicking in the grey button.</p>
                <br>
              <div class="col md12 right">
                <a onclick="reloadData()" data-position="top" data-tooltip="Reload here the information" class="btn-floating pulse btn-large waves-effect waves-light blue-grey lighten-4 tooltip-class">
                  <i class="material-icons black-text">autorenew</i>
                </a>
              </div>


              <div class="card " style="padding: 50px;">
                <div class="card-content">
                  <table id="table-uf" class="table table-bordered table-striped hover">
                    <thead>
                      <tr>
                        <th width="20%">ID</th>
                        <th width="40%">Date</th>
                        <th width="20%">Value</th>
                        <th width="10%"><i class="material-icons center">delete</i></th>
                        <th width="10%"><i class="material-icons center">edit</i></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

	<footer class="page-footer amber accent-2">
    <div class="footer-copyright">
      <div class="container black-text">
      © 2020 Copyright
      <a class="black-text text-lighten-4 right" target="_blank" href="https://github.com/AlvaroMrJack">AlvaroMrJack Github</a>
      </div>
    </div>
  </footer>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/materialize/js/materialize.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>

<script>
	
	M.AutoInit();

  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltip-class');
    var instances = M.Tooltip.init(elems);
  });

  $(document).ready(function(){


    $('.tooltip-class').tooltip();

    $('.parallax').parallax();

    $('.datepicker').datepicker();

    var dataTable = $("#table-uf").DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        url: "<?= base_url() . 'index.php/Dashboard/load_uf_data_to_table'; ?> ",
        type: "POST"
      },
      "columnDefs": [
        {
          "targets":[0, 3, 4],
          "orderable": false,
        }
      ]
    });

    const indicators = [{id: 'uf', text: 'uf'},
										    {id: 'ivp', text: 'ivp'}, 
										    {id: 'dolar', text: 'dolar'}, 
										    {id: 'dolar_intercambio', text: 'dolar_intercambio'}, 
										    {id: 'euro', text: 'euro'}, 
										    {id: 'ipc', text: 'ipc'}, 
										    {id: 'utm', text: 'utm'}, 
										    {id: 'imacec', text: 'imacec'}, 
										    {id: 'tpm', text: 'tpm'}, 
										    {id: 'libra_cobre', text: 'libra_cobre'}, 
										    {id: 'tasa_desempleo', text: 'tasa_desempleo'}, 
										    {id: 'bitcoin', text: 'bitcoin'}];

	  $(".indicators-Select").select2({
	  	theme: "classic",
		  data: indicators
		})

  });


  $('.indicators-Select').on('select2:select', function (e) {

    console.log('asas');

    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Chart loaded',
      showConfirmButton: false,
      timer: 1500
    })

    drawAnnotations($("#idSelect2").val());

  });
  
  $(window).resize(function(){
    drawAnnotations();
  });

  google.charts.load('current', {packages: ['corechart', 'line']});
	google.charts.setOnLoadCallback(drawAnnotations);


  function drawAnnotations(indicator) {
      var data = new google.visualization.DataTable();
      var indicatorValue = indicator ? indicator : 'uf';

      data.addColumn('number', 'X');
      data.addColumn('number', indicatorValue);

      var jsonData = $.ajax({
        url: "https://mindicador.cl/api/" + indicatorValue,
        dataType: "json",
        async: false
        }).responseText;

      jsonData = JSON.parse(jsonData);

      jsonData.serie.forEach( (element, index) =>
        {
          data.addRows([
            [index, element.valor]
          ]) 
        }
      );

      var options = {
        hAxis: {
          title: 'Dates'
        },
        vAxis: {
          title: 'Values'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

    function deleteIndicator(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "This action is forever!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        reverseButtons: true
      }).then((result) => {

        if( result.isConfirmed == true){
          $.ajax({
            type: 'POST',
            url: "<?= base_url() . 'index.php/Dashboard/delete_record'; ?> ",
            data: { 'id_record': id },
            beforeSend: function() {
              let timerInterval
              Swal.fire({
                timer: 2000,
                timerProgressBar: true,
                onBeforeOpen: () => {
                  Swal.showLoading()
                  timerInterval = setInterval(() => {
                    const content = Swal.getContent()
                    if (content) {
                      const b = content.querySelector('b')
                      if (b) {
                        b.textContent = Swal.getTimerLeft()
                      }
                    }
                  }, 100)
                },
                onClose: () => {
                  clearInterval(timerInterval)
                }
              })
            },
            success: function(data) {

              Swal.close();
              
              if (data == 1) {
                Swal.fire(
                  'Deleted!',
                  'The record has been deleted.',
                  'success'
                )
                $('#table-uf').DataTable().ajax.reload();
              }else{
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: "The record can't be deleted, the record don't exist.",
                })
              }

            },
            error: function(xhr) { // if error occured
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anonymous hacked our website!',
              })
            },
            dataType: 'html'
          });
        }else if( result.isConfirmed == false){
          return false;
        }
        

      })
    }

    function disabledData(id){


      //option 0, disabled true
      //option 1, disabled false

      if($('#editButton'+id).attr('data-state') == 0){

        Swal.fire({
          title: 'Are you sure?',
          text: "Don't worry, the record can be updated again!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, update!'
        }).then((result) => {
          if (result.isConfirmed == true) {

            var dateUpdated = $('#inputDate'+id).val();
            var valueUpdated = $('#inputValue'+id).val();

            $.ajax({
              type: 'POST',
              url: "<?= base_url() . 'index.php/Dashboard/update_record'; ?> ",
              data: { 'id': id, 'date': dateUpdated, 'value': valueUpdated },
              beforeSend: function() {
                let timerInterval
                Swal.fire({
                  timer: 2000,
                  timerProgressBar: true,
                  onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                      const content = Swal.getContent()
                      if (content) {
                        const b = content.querySelector('b')
                        if (b) {
                          b.textContent = Swal.getTimerLeft()
                        }
                      }
                    }, 100)
                  },
                  onClose: () => {
                    clearInterval(timerInterval)
                  }
                })
              },
              success: function(data) {

                Swal.close();
                
                if (data == 1) {
                  Swal.fire(
                    'Edited!',
                    'The record has been edited.',
                    'success'
                  )

                  $('#table-uf').DataTable().ajax.reload();

                  $('#editButton'+id).attr('data-state', 1);
                  document.getElementById('inputDate'+id).disabled = true;
                  document.getElementById('inputValue'+id).disabled = true;
                  document.getElementById('editButton'+id).classList.remove('green');
                  document.getElementById('editButton'+id).classList.add('orange');
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "The record can't be edited because don't exist changes.",
                  })
                }

              },
              error: function(xhr) { // if error occured
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Anonymous hacked our website!',
                })
              },
              dataType: 'html'
            });
          }else if(result.isConfirmed == false){
            return false;
          }
        });

        
      }else if($('#editButton'+id).attr('data-state') == 1){
        $('#editButton'+id).attr('data-state', 0);
        document.getElementById('inputDate'+id).disabled = false;
        document.getElementById('inputValue'+id).disabled = false;
        document.getElementById('editButton'+id).classList.remove('orange');
        document.getElementById('editButton'+id).classList.add('green');
      }
      
    }

    function reloadData(){

      $.ajax({
        type: "POST",
        url: "<?= base_url() . 'index.php/Dashboard/load_uf_data'; ?> ", 
        data: {textbox: $("#textbox").val()},
        dataType: "text",  
        cache:false,
         beforeSend: function(){

          let timerInterval

          Swal.fire({
            timerProgressBar: true,
            onBeforeOpen: () => {
              Swal.showLoading()
              timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                  const b = content.querySelector('b')
                  if (b) {
                    b.textContent = Swal.getTimerLeft()
                  }
                }
              }, 100)
            },
            onClose: () => {
              clearInterval(timerInterval)
            }
          })

         },
         success: function(data){
            Swal.fire({
              icon: 'success',
              title: 'information reloaded',
              showConfirmButton: false,
              timer: 1500
            })
            $('#table-uf').DataTable().ajax.reload();
          }
        });    
    }

    


</script>