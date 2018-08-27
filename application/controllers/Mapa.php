<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller {

	public function index()
	{
		$data['metricas'] = $this->obtenerInfo();
		$data['ubicaciones'] = $this->obtenerUbicacionesUnicas($data['metricas']);
		$data['fechas'] = $this->obtenerFechasUnicas($data['metricas']);
		$this->load->view('v_mapa', $data);
	}

	public function obtenerInfo(){
        /**EXTRAYENDO INFORMACION DEL SERVIDOR */
        $url = "http://35.192.151.177:8080/data";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        /** Guardar arreglo en una variable **/
        return $obj->datos;
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

}
