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

	public function index()
	{
        $data['titulo'] = "Tit";
        $data['coordenadas'] = "19.12321323, -19.12321312";
       /* $datos = $this->obtenerInfo();
        $ubicaciones = $this->obtenerUbicacionesUnicas($datos);
        $fechas = $this->obtenerFechasUnicas($datos);

    
        $data['ubicaciones'] = $ubicaciones;
        $data['fechas'] = $fechas;
        */
        $this->load->view('weather/index', $data);
    }

    public function porubicacion($ubicacion = NULL)
	{
        $datos = $this->obtenerInfo();
        $ubicaciones = $this->obtenerUbicacionesUnicas($datos);
        $noUbicacion = 0;
        for ($x = 0; $x < count($ubicaciones); $x++) {
            if($x == $ubicacion){
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
        $this->load->view('weather/filtro', $data);
    }
    
    public function porfecha($fecha = NULL)
	{
        $datos = $this->obtenerInfo();
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
        $this->load->view('weather/filtro', $data);
    }
    
    public function porhora($hora = NULL)
	{
        $datos = $this->obtenerInfo();
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
        $this->load->view('weather/filtro', $data);
	}
}


