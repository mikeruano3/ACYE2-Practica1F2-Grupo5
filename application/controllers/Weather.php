<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'controllers\Datos.php';
class Weather extends CI_Controller {

    public function obtenerInfo(){
        /**EXTRAYENDO INFORMACION DEL SERVIDOR */
        $url = "http://35.192.151.177:8080/data";
        $json = file_get_contents($url);
        $obj = json_decode($json);
        /** Guardar arreglo en una variable **/
        return $this->arreglarInfo($obj->datos);
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



	public function index()
	{
        $data['titulo'] = "Tit";
        $datos = $this->obtenerInfo();
        $ubicaciones = $this->obtenerUbicacionesUnicas($datos);
        $fechas = $this->obtenerFechasUnicas($datos);


        $data['ubicaciones'] = $ubicaciones;
        $data['fechas'] = $fechas;
        $this->load->view('weather/index', $data);
    }


}
