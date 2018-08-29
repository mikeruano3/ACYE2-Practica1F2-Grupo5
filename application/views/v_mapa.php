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
		<link href="<?php echo base_url('css/weather.css'); ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css" />
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

        <?php //echo '<pre>'.print_r($horas, 1).'</pre>'; ?>

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
					<div class="col-md-3">
						<div class="alert alert-info" style="color:black;">
						  	<strong>Filtros</strong>
						</div>
                        <div class="form-group">
                            <label>Tipo de filtro:</label>
                            <select class="form-control" id="tipo_filtro">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <option value="ubicacion_block">Filtrar por ubicación</option>
                                <option value="fecha_block">Filtrar por fecha</option>
                                <option value="hora_block">Filtrar por hora</option>
                                <option value="dia_block">Filtrar por día</option>
                            </select>
                        </div>
                        <div id="ubicacion_block" class="form-group" style="display:none;">
                            <label>Filtrar por ubicación:</label>
                            <select class="form-control subfilter" id="ubicacion">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <?php foreach ($ubicaciones as $k => $v) {  ?>
                                    <option value="<?php echo $v['coordenadas']; ?>"><?php echo $v['coordenadas']." - ".$v['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="fecha_block" class="form-group" style="display:none;">
                            <label>Filtrar por fecha:</label>
                            <select class="form-control subfilter" id="fecha">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <?php foreach ($fechas as $k => $v) {  ?>
                                    <option value="<?php echo $v; ?>">2018-08-<?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="hora_block" class="form-group" style="display:none;">
                            <label>Filtrar por hora:</label>
                            <select class="form-control subfilter" id="hora">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <?php foreach ($horas as $k => $v) {  ?>
                                    <option value="<?php echo $v; ?>"><?php echo $v; ?> A.M.</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="dia_block" class="form-group" style="display:none;">
                            <label>Filtrar por dia:</label>
                            <select class="form-control subfilter" id="dia">
                                <option value="0" disabled selected>Seleccione una opción</option>
                                <?php foreach ($fechas as $k => $v) {  ?>
                                    <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
                                <?php } ?>
                            </select>
                        </div>
					</div>
					<div class="col-md-9">
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
		        		<h4 class="modal-title">Clima promedio</h4>
		      		</div>
		      		<div class="modal-body">
						<div class="container">
						    <div class="row">
						        <div id="content_weather" class="col-md-6">
						        </div>
						    </div>
						</div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      		</div>
		    	</div>
		  	</div>
		</div>

        <script type="text/javascript">

            function filtrarClima(tipo_filtro, valor_filtro) {

                $.ajax({

                    type: 'POST',
                    url: "<?php echo base_url('mapa/filtrar'); ?>",
                    data: { tipo_filtro : tipo_filtro, valor_filtro : valor_filtro },
                    timeout: 50000,

                    error: function(jqXHR, textStatus, errorThrown) {
                        if (textStatus === 'timeout') {
                            alert('Ocurrio un error, Intentelo de nuevo porfavor');
                        } else {
                            alert('Ocurrio un error, Intentelo de nuevo porfavor');
                        }
                    },

                    success: function(data) {
                        //Colocamos el HTML que dibuja el clima como Google Weather
                        $('#content_weather').html('');
                        $('#content_weather').html(data);
                        $('#google_weather_modal').modal('show');
                    }

                });

            }

        </script>

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
					{ "nombre": "Marvin Calderón", "latitud": 14.615966, "longitud": -90.510603 },
					{ "nombre": "Kevin Orellana", "latitud": 14.518221, "longitud": -90.544376 },
					{ "nombre": "Susel Retana", "latitud": 14.54091, "longitud": -90.603772 },
					{ "nombre": "Diana Jimenez", "latitud": 14.718344, "longitud": -90.473360 },
					{ "nombre": "Miguel Ruano", "latitud": 14.591183, "longitud": -90.548498 }
				]};

				$.each(obj_coordenadas.datos, function(k, v){

					marker = new google.maps.Marker({
						position: new google.maps.LatLng(v.latitud, v.longitud),
						map: map,
						title: 'Datos de ' + v.nombre,
                        latitud: v.latitud,
                        longitud: v.longitud
					});

					google.maps.event.addListener(marker, 'click', function(evt) {

					});

				});

            }

        </script>

        <script type="text/javascript">

            $(document).ready(function(){

                $('#tipo_filtro').on('change', function(){

                    var valor = $(this).val();

                    $(".subfilter").val($(".subfilter option:first").val());

                    switch (valor) {
                        case "ubicacion_block":
                            $('#ubicacion_block').show();
                            $('#fecha_block').hide();
                            $('#dia_block').hide();
                            $('#hora_block').hide();
                            break;
                        case "fecha_block":
                            $('#ubicacion_block').hide();
                            $('#fecha_block').show();
                            $('#dia_block').hide();
                            $('#hora_block').hide();
                            break;
                        case "dia_block":
                            $('#ubicacion_block').hide();
                            $('#fecha_block').hide();
                            $('#dia_block').show();
                            $('#hora_block').hide();
                            break;
                        case "hora_block":
                            $('#ubicacion_block').hide();
                            $('#fecha_block').hide();
                            $('#dia_block').hide();
                            $('#hora_block').show();
                            break;
                        default:
                            break;
                    }

                });

            });

        </script>

        <script type="text/javascript">

            $(document).ready(function(){

                $('.subfilter').on('change', function(){

                    var tipo_filtro = $(this).attr('id');
                    var valor_filtro = $(this).val();
                    filtrarClima(tipo_filtro, valor_filtro);

                });

            });

        </script>

    </body>

</html>
