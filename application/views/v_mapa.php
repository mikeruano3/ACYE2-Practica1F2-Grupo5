<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
    <head>

		<meta charset="utf-8">
		<title>Mapa de recolección de datos | ClimaGT</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    	<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    	<link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnzdh15cMd1fizOlGEskh0yWMdgCdrXHM&callback=initMap" async defer></script>

        <style>
            #map {
				min-height: 500px;
			    width: 100%;
			    height:100%;
            }
            body {
            	background-color: #cbd0ce;
            }
        </style>

    </head>

    <body>
		<div class="section">
		    <div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success">
						  	<strong><h1 style="text-align:center;"> UBICACIÓN DE RECOPILACIÓN DE INFORMACION | CLIMAGT </h1></strong>.
						</div>
					</div>
				</div>
		        <div class="row">
		            <div class="col-md-12">
						<div id="map"></div>
					</div>
		        </div>
				<br><br>
				<div class="row">
		            <div class="col-md-12">
						<div class="alert alert-warning" style="color:black;">
						  	<strong>Atención!</strong> Debes dar click en los marcadores sobre el mapa para ver el detalle del clima.
						</div>
					</div>
		        </div>
		    </div>
		</div>

		<div id="google_weather_modal" class="modal fade" role="dialog">
		  	<div class="modal-dialog">
				<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="close" data-dismiss="modal">&times;</button>
		        		<h4 class="modal-title">Modal Header</h4>
		      		</div>
		      		<div class="modal-body">
		        		<p>Some text in the modal.</p>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      		</div>
		    	</div>
		  	</div>
		</div>

        <script>

			function initMap() {

				var myLatlng = new google.maps.LatLng(14.6407200, -90.5132700);
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 11,
					center: myLatlng
				});

				var marker;
				var obj_coordenadas = {"datos":[
					{ "nombre": "Patrik Sacbajá", "latitud": 14.5824371, "longitud": -90.4969449 },
					{ "nombre": "Marvin Calderón", "latitud": 14.6157899, "longitud": -90.5127812 },
					{ "nombre": "Kevin Orellana", "latitud": 14.518221, "longitud": -90.544376 },
					{ "nombre": "Susel Retana", "latitud": 14.54091, "longitud": -90.603772 },
					{ "nombre": "Diana Jimenez", "latitud": 14.718391, "longitud": -90.472897 },
					{ "nombre": "Miguel Ruano", "latitud": 14.615966, "longitud": -90.510603 }
				]};

				$.each(obj_coordenadas.datos, function(k, v){

					marker = new google.maps.Marker({
						position: new google.maps.LatLng(v.latitud, v.longitud),
						map: map,
						title: 'Datos de ' + v.nombre
					});

					google.maps.event.addListener(marker, 'click', function() {
						$('#google_weather_modal').modal('show');
					});

				});

            }

        </script>

    </body>

</html>
