<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller {

	public function index()
	{
		
		//creamos la configuración del mapa con un array
 		$config = array();
        
        //la zona del mapa que queremos mostrar al cargar el mapa
        //como vemos le podemos pasar la ciudad y el país
        //en lugar de la latitud y la longitud
 		$config['center'] = 'guatemala,guatemala';
        
        // el zoom, que lo podemos poner en auto y de esa forma
        //siempre mostrará todos los markers ajustando el zoom	
 		$config['zoom'] = '12'; 
        
        //el tipo de mapa, en el pdf podéis ver más opciones
 		$config['map_type'] = 'ROADMAP';

        //el ancho del mapa 
 		$config['map_width'] = '1520px'; 

        //el alto del mapa	
 		$config['map_height'] = '800px'; 
        
        //inicializamos la configuración del mapa	
 		$this->googlemaps->initialize($config); 
 
 		//hacemos la consulta al modelo para pedirle 
 		//la posición de los markers y el infowindow
 		//AQUI VA LA OBTENCIÓN DE LOS DATOS RECOPILADOS

 		$marker = array();
            
        //podemos elegir DROP o BOUNCE
		$marker ['animation'] = 'DROP';
        
        //posición de los markers
		$marker ['position'] = "14.6157899,-90.5127812";
        
        //infowindow de los markers(ventana de información)	
		$marker ['descripcion'] = "Ubicación de toma de datos de Marvin Calderón";
        
        //la id del marker
		$marker['id'] = 1; 
			
		$this->googlemaps->add_marker($marker);

 		//en $data['datos'tenemos la información de cada marker para
        //poder utilizarlo en el sidebar en nuestra vista mapa_view
 		$data['datos'] = array(array(
 			'id' 	=> 1,
 			'pos_y' => '-90.5127812',
 			'pos_x' => '14.6157899',
 			'descripcion' => $marker['descripcion']
 		));

        //en data['map'] tenemos ya creado nuestro mapa para llamarlo en la vista
 		$data['map'] = $this->googlemaps->create_map();

 		//cargamos la información a la vista
 		$this->load->view('v_mapa', $data);

	}

}
