<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
	<html lang="es">
		<head>
 			
 			<meta charset="utf-8">
 			<title>Mapa de recolección de datos | ClimaGT</title>
 			<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">
 			<style type="text/css">
 				body{
 					background: #888888
 				}
 				#sidebar{
 					position: absolute;
 					width: 375px;
					height: 800px;
					background: #222;
					color: #fff;
					margin-left: 1525px;
					margin-top: -800px;
					border: 5px solid #fff;
 				}
 				ul{
 					padding: 0;
 					text-align: justify; 
 				}
 				li{
 					cursor: pointer;
 					border-top: 1px solid #fff;
 					background: #c3c3c3; 
 					list-style: none;
 					color: #111
 				}
 				li:hover{
 					background: #fefefe;
 				}
 			</style>
 			
 			<script type="text/javascript">
 				
 				function datos_marker(lat, lng, marker) {
     				
     				var mi_marker = new google.maps.LatLng(lat, lng);
     				map.panTo(mi_marker);
     				google.maps.event.trigger(marker, 'click');
    			}

 			</script>
 			
 			<?php echo $map['js']; ?>
 			
		</head>
		
		<body>
			
			<div class="alert alert-success">
			  	<strong><h1 style="text-align:center;"> UBICACIÓN DE RECOPILACIÓN DE INFORMACION | CLIMAGT </h1></strong>.
			</div>

			<div style="text-align:center;">
				<?php echo $map['html']; ?>
			</div>

			<div id="sidebar">
 				
 				<ul>
 					
 					<?php foreach($datos as $marker_sidebar){ ?>
 						
 						<li onclick="datos_marker(<?php echo $marker_sidebar['pos_y']; ?>, <?php echo $marker_sidebar['pos_x']; ?>, marker_<?php echo $marker_sidebar['id']; ?>)">
 							<?php echo $marker_sidebar['id']; ?> &nbsp;&nbsp; <?php echo $marker_sidebar['descripcion']; ?>
 						</li>

 					<?php } ?>

 				</ul>

			</div>

		</body>

</html>