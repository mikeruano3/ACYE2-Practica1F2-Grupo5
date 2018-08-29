<div class="container">
    <div class="row">
        <div class="col-md-5">
            <?php if($flag){ ?>
                <div class="weather">
                    <div class="current">
                        <div class="info">
                            <div>&nbsp;</div>
    						<div class="city">
                                <small>CIUDAD:&nbsp&nbspGuatemala</small>
                            </div>
    						<div class="temp">
                                <?php echo $real_temp; ?>&deg;<small>C</small>
                            </div>
                        </div>
                        <div class="icon">
                            <?php if($weather == "lluvioso"){ ?>
                                <span class="wi wi-rain"></span>
                            <?php }else if($weather == "nublado"){ ?>
                                <span class="wi wi-day-cloudy"></span>
                            <?php }else if($weather == "nubes y sol"){ ?>
                                <span class="wi wi-showers"></span>
                            <?php }else if($weather == "soleado"){ ?>
                                <span class="wi wi-day-sunny"></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="future">
                        <div class="day">
                            <h6>Radiación</h6>
                            <h5><?php echo intval($promedio_radiacion)." nm"; ?></h5>
                            <p><i class="fa fa-fw fa-sun-o"></i></p>
                        </div>
                        <div class="day">
                            <h6>Presión</h6>
                            <h5><?php echo intval($promedio_presion)." mb"; ?></h5>
                            <p><i class="fa fa-fw fa-compress"></i></p>
                        </div>
                        <div class="day">
                            <h6>Humedad</h6>
                            <h5><?php echo intval($promedio_humedad)." %"; ?></h5>
                            <p><i class="fa fa-fw fa-soundcloud"></i></p>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
                <h1> No hay datos para el filtro indicado. </h1>
            <?php } ?>
        </div>
    </div>
</div>
