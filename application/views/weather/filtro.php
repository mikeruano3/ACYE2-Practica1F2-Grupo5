<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Weather Widget Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Weather Widget <small>A responsive and flexible weather widget</small></h1>
</div>

<!-- Weather Widget - START -->
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-7">
            <div class="weather">
                <div class="current">
                    <div class="info">
                        <div>&nbsp;</div>
						<div class="city"><small><small>CIUDAD:&nbsp</small></small>Guatemala</div>
						<div class="city"><small><small>
                            <?php
								if(isset($coordenadas)){
									echo 'Coordenadas:';
								}
							?>
                            </small>
							</small>
							<?php
								if(isset($coordenadas)){
									echo $coordenadas;
								}
							?>
                            </div>
                        <div class="temp">
                            <?php 
                                    if(isset($promedio_temperatura)){
                                        echo $promedio_temperatura;
                                    }
                            ?>&deg; 
                            <small>F</small></div>
                        
                        <div>&nbsp;</div>
                    </div>
                    <div class="icon">
                        <span class="wi wi-day-sunny"></span>
                    </div>
                </div>
                <div class="future">
                    <div class="day">
                        <h6>Radiación</h6>
                        <h5><?php 
                                    if(isset($promedio_radiacion)){
                                        echo $promedio_radiacion;
                                    }
                        ?></h5>
                        <p><span class="wi wi-day-cloudy"></span></p>
                    </div>
                    <div class="day">
                        <h6>Presión</h6>
                        <h5><?php 
                                    if(isset($promedio_presion)){
                                        echo $promedio_presion;
                                    }
                        ?></h5>
                        <p><span class="wi wi-showers"></span></p>
                    </div>
                    <div class="day">
                        <h6>Humedad</h6>
                        <h5><?php 
                                    if(isset($promedio_humedad)){
                                        echo $promedio_humedad;
                                    }
                        ?></h5>
                        <p><span class="wi wi-rain"></span></p>
                    </div>
                </div>
                <div>
                         
                            <?php
                            
                            ?>
                         
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css" />

<style>
    .weather
    {
        display: flex;
        flex-flow: column wrap;
        box-shadow: 0px 1px 10px 0px #cfcfcf;
        overflow: hidden;
    }

        .weather .current
        {
            display: flex;
            flex-flow: row wrap;
            background-image: url("https://guatemalanadventure.com/wp-content/uploads/2012/01/View-from-Cerro-de-la-Cruz-Antigua-Guatemala1.jpg");
            background-repeat: repeat-x;
            color: white;
            padding: 20px;
            text-shadow: 1px 1px #F68D2E;
        }

            .weather .current .info
            {
                display: flex;
                flex-flow: column wrap;
                justify-content: space-around;
                flex-grow: 2;
            }

                .weather .current .info .city
                {
                    font-size: 26px;
                }

                .weather .current .info .temp
                {
                    font-size: 56px;
                }

                .weather .current .info .wind
                {
                    font-size: 24px;
                }

            .weather .current .icon
            {
                text-align: center;
                font-size: 64px;
                flex-grow: 1;
            }

        .weather .future
        {
            display: flex;
            flex-flow: row nowrap;
        }

            .weather .future .day
            {
                flex-grow: 1;
                text-align: center;
                cursor: pointer;
            }

                .weather .future .day:hover
                {
                    color: #fff;
                    background-color: #F68D2E;
                }

                .weather .future .day h3
                {
                    text-transform: uppercase;
                }

                .weather .future .day p
                {
                    font-size: 28px;
                }
</style>

<!-- Weather Widget - END -->

</div>

</body>
</html>
