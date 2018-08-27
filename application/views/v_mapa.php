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

				$(document).ready(function() {

			        var myLatlng = new google.maps.LatLng(14.6407200, -90.5132700);
			        var map = new google.maps.Map(document.getElementById('map'), {
			            zoom: 8,
			            center: myLatlng
			        });

			        var marker;

			        $.ajax({

						type: "GET",
		                url: "https://api.myjson.com/bins/9mhy0",
		                timeout: 5000,
			            success: function(obj) {

							$.each(obj.datos, function(k, v){

								marker = new google.maps.Marker({
									position: new google.maps.LatLng(v.latitud, v.longitud),
									map: map,
									title: 'Dato No.' + k
								});

								google.maps.event.addListener(marker, 'click', function() {
									$('#google_weather_modal').modal('show');
							    });

							});

			            }

			        });

			    });

            }

        </script>

    </body>

</html>
