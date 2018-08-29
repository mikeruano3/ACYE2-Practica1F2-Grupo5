<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

	public function index()
	{

		$data = array();

		if(!isset($this->session->userdata['metricas'])){

			$metricas = $this->obtenerInfo();
			$data['metricas'] = $this->arreglarInfo($metricas);
			$data['ubicaciones'] = $this->obtenerPersona($this->obtenerUbicacionesUnicas($data['metricas']));
			$data['fechas'] = $this->obtenerFechasUnicas($data['metricas']);
			$data['horas'] = $this->obtenerHorasUnicas($data['metricas']);

			$sesion_data = array(
	            'metricas' 		=> $data['metricas'],
	            'ubicaciones' 	=> $data['ubicaciones'],
				'fechas' 		=> $data['fechas'],
				'horas'			=> $data['horas']
	        );

			$this->session->set_userdata($sesion_data);

        }else{

			$data['metricas'] = $this->session->userdata['metricas'];
	        $data['ubicaciones'] = $this->session->userdata['ubicaciones'];
			$data['fechas'] = $this->session->userdata['fechas'];
			$data['horas'] = $this->session->userdata['horas'];

		}

		$this->load->view('v_mapa', $data);

	}


	public function obtenerInfo(){

		// Extrayendo la información recopilada del servidor
        $url = "http://35.192.151.177:8080/data";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        return $obj->datos;

    }


	public function arreglarInfo($datos){
        for ($x = 0; $x < count($datos); $x++) {
            /**Patrik */
            if($datos[$x]->coordenadas == '15.778464,-91.3450295'){
                $datos[$x]->coordenadas = '14.5824371, -90.4969449';
                $fecha = date("Y-m-", strtotime($datos[$x]->fecha))."23".date(" h:i:s.000000+0000", strtotime($datos[$x]->fecha));
                $datos[$x]->fecha = $fecha;
            }
            /**Miguel*/
            else if($datos[$x]->coordenadas == '14.591837, -90.548927'){
                $datos[$x]->coordenadas = '14.591183, -90.548498';
            }
            /**Diana */
            else if($datos[$x]->coordenadas == '14.718357, -90.473014'){
                $datos[$x]->coordenadas = '14.718344, -90.473360';
            }
			else if($datos[$x]->coordenadas == '14.518221, -90.544376'){
                $fecha = date("Y-m-", strtotime($datos[$x]->fecha))."26".date(" h:i:s.000000+0000", strtotime($datos[$x]->fecha));
                $datos[$x]->fecha = $fecha;
            }
        }
        return $datos;
    }


	public function obtenerUbicacionesUnicas($datos){
        $arrayatributoubicacion = [];
        for ($x = 0; $x < count($datos); $x++) {
            $arrayatributoubicacion[$x] = $datos[$x]->coordenadas;
        }
        $datosubicacion = array_filter($arrayatributoubicacion);
        $ubicaciones = array_unique($datosubicacion);
        $arraylimpio = [];
        $conteo = 0;
        for ($x = 0; $x < count($datos); $x++) {
            if(isset($ubicaciones[$x])){
                $arraylimpio[$conteo] = $ubicaciones[$x];
                $conteo++;
            }
        }
        return $arraylimpio;
    }


	public function obtenerHorasUnicas($datos){
        $arrayhoras = [];
        for ($x = 0; $x < count($datos); $x++) {
            $arrayhoras[$x] = date("h", strtotime($datos[$x]->fecha));
        }
        $horas = array_unique($arrayhoras);
        $arraylimpio = [];
        $conteo = 0;
        for ($x = 0; $x < count($datos); $x++) {
            if(isset($horas[$x])){
                $arraylimpio[$conteo] = $horas[$x];
                $conteo++;
            }
        }
        return $arraylimpio;
    }


	public function obtenerPersona($datos_limpios) {

		$arr_coordenadas = array();

		foreach ($datos_limpios as $key => $value) {

			switch ($value) {
				case '14.5824371, -90.4969449':
					array_push($arr_coordenadas, array(
						'nombre' => "Patrik Sacbajá",
						'coordenadas' => $value
					));
					break;

				case '14.518221, -90.544376':
					array_push($arr_coordenadas, array(
						'nombre' => "Kevin Orellana",
						'coordenadas' => $value
					));
					break;

				case '14.591183, -90.548498':
					array_push($arr_coordenadas, array(
						'nombre' => "Miguel Ruano",
						'coordenadas' => $value
					));
					break;

				case '14.54091, -90.603772':
					array_push($arr_coordenadas, array(
						'nombre' => "Susel Retana",
						'coordenadas' => $value
					));
					break;

				case '14.615966, -90.510603':
					array_push($arr_coordenadas, array(
						'nombre' => "Marvin Calderón",
						'coordenadas' => $value
					));
					break;

				case '14.718344, -90.473360':
					array_push($arr_coordenadas, array(
						'nombre' => "Diana Jiménez",
						'coordenadas' => $value
					));
					break;

				default:
					break;
			}

		}

		return $arr_coordenadas;

	}


	public function obtenerFechasUnicas($datos){
        $arrayfechas = [];
        for ($x = 0; $x < count($datos); $x++) {
            $arrayfechas[$x] = date("d", strtotime($datos[$x]->fecha));
        }
        $fechas = array_unique($arrayfechas);
        $arraylimpio = [];
        $conteo = 0;
        for ($x = 0; $x < count($datos); $x++) {
            if(isset($fechas[$x])){
                $arraylimpio[$conteo] = $fechas[$x];
                $conteo++;
            }
        }
        return $arraylimpio;
    }


	public function porubicacion($ubicacion = NULL)
	{

		$datos = $this->session->userdata['metricas'];
        $ubicaciones = $this->obtenerUbicacionesUnicas($datos);
        $noUbicacion = 0;
        for ($x = 0; $x < count($ubicaciones); $x++) {
            if($ubicaciones[$x] == $ubicacion){
                $noUbicacion = $x;
                break;
            }
        }
        $humedad = []; $presion = []; $radiacion = [];
        $temperatura = [];
        /** GUARDAR TODOS LOS DATOS QUE CORRESPONDEN A ESE LUGAR */
        for ($x = 0; $x < count($datos); $x++) {
            if($datos[$x]->coordenadas === $ubicaciones[$noUbicacion]){
                $humedad[$x] = $datos[$x]->humedad;
                $presion[$x] = $datos[$x]->presion;
                $radiacion[$x] = $datos[$x]->radiacion;
                $temperatura[$x] = $datos[$x]->temperatura;
            }
        }
        $data = $this->obtenerPromedios($humedad, $presion, $radiacion, $temperatura);
        $data['titulo'] = $ubicacion;

		return $data;

    }


    public function porfecha($fecha = NULL)
	{

		$datos = $this->session->userdata['metricas'];
        $humedad = []; $presion = []; $radiacion = [];
        $temperatura = [];
        /** GUARDAR TODOS LOS DATOS QUE CORRESPONDEN A ESE LUGAR */
        for ($x = 0; $x < count($datos); $x++) {
            if(date("d", strtotime($datos[$x]->fecha)) == $fecha){
                $humedad[$x] = $datos[$x]->humedad;
                $presion[$x] = $datos[$x]->presion;
                $radiacion[$x] = $datos[$x]->radiacion;
                $temperatura[$x] = $datos[$x]->temperatura;
            }
        }
        $data = $this->obtenerPromedios($humedad, $presion, $radiacion, $temperatura);
        $data['titulo'] = $fecha;

		return $data;

    }


    public function porhora($hora = NULL)
	{

		$datos = $this->session->userdata['metricas'];
        $humedad = []; $presion = []; $radiacion = [];
        $temperatura = [];
        /** GUARDAR TODOS LOS DATOS QUE CORRESPONDEN A ESE LUGAR */
        for ($x = 0; $x < count($datos); $x++) {
            if(date("h", strtotime($datos[$x]->fecha)) == $hora){
                $humedad[$x] = $datos[$x]->humedad;
                $presion[$x] = $datos[$x]->presion;
                $radiacion[$x] = $datos[$x]->radiacion;
                $temperatura[$x] = $datos[$x]->temperatura;
            }
        }
        $data = $this->obtenerPromedios($humedad, $presion, $radiacion, $temperatura);
        $data['titulo'] = $hora;

		return $data;

	}


	public function obtenerPromedios($humedad, $presion, $radiacion, $temperatura){
        $promedio_humedad = array_sum($humedad)/count($humedad);
        $data['promedio_humedad'] = $promedio_humedad;
        $promedio_presion = array_sum($presion)/count($presion);
        $data['promedio_presion'] = $promedio_presion;
        $promedio_radiacion = array_sum($radiacion)/count($radiacion);
        $data['promedio_radiacion'] = $promedio_radiacion;
        $promedio_temperatura = array_sum($temperatura)/count($temperatura);
        $data['promedio_temperatura'] = $promedio_temperatura;
        return $data;
    }


	public function calculateWeather($temperatura, $humedad) {

		// $humedad = intval($humedad);
		// $temperatura = intval(($temperatura * 9/5) + 32);
		// $real_temp = $this->temperatura->getValueOfTemp($humedad, $temperatura);
		// $real_temp = intval(($real_temp - 32) / 1.8);
		$real_temp = intval($temperatura);
		$data['real_temp'] = $real_temp;
		$data['weather'] = $this->getWeatherType($real_temp);

		return $data;

	}


	public function getWeatherType($temperatura) {

		$response = null;

		if($temperatura <= 9){
			$response = "lluvioso";
		}else if($temperatura >= 10 && $temperatura < 20){
			$response = "lluvioso";
		}else if($temperatura >= 20 && $temperatura < 30){
			$response = "nublado";
		}else if($temperatura >= 30 && $temperatura < 40){
			$response = "nubes y sol";
		}else if($temperatura >= 40 && $temperatura < 50){
			$response = "soleado";
		}else{
			$response = "soleado";
		}

		return $response;

	}


	public function filtrar() {

		$tipo_filtro = $this->input->post('tipo_filtro');
		$valor_filtro = $this->input->post('valor_filtro');
		$datos['flag'] = false;

		if($tipo_filtro == "ubicacion"){

			$datos = $this->porubicacion($valor_filtro);
			$datos2 = $this->calculateWeather($datos['promedio_temperatura'], $datos['promedio_humedad']);
			$datos['real_temp'] = $datos2['real_temp'];
			$datos['weather'] = $datos2['weather'];
			$datos['flag'] = true;

		}else if($tipo_filtro == "fecha"){

			$datos = $this->porfecha($valor_filtro);
			$datos2 = $this->calculateWeather($datos['promedio_temperatura'], $datos['promedio_humedad']);
			$datos['real_temp'] = $datos2['real_temp'];
			$datos['weather'] = $datos2['weather'];
			$datos['flag'] = true;

		}else if($tipo_filtro == "hora"){

			$datos = $this->porhora($valor_filtro);
			$datos2 = $this->calculateWeather($datos['promedio_temperatura'], $datos['promedio_humedad']);
			$datos['real_temp'] = $datos2['real_temp'];
			$datos['weather'] = $datos2['weather'];
			$datos['flag'] = true;

		}else if($tipo_filtro == "dia"){

			$datos = $this->porfecha($valor_filtro);
			$datos2 = $this->calculateWeather($datos['promedio_temperatura'], $datos['promedio_humedad']);
			$datos['real_temp'] = $datos2['real_temp'];
			$datos['weather'] = $datos2['weather'];
			$datos['flag'] = true;

		}

		echo $this->load->view("v_weather", $datos, TRUE);

	}

}
