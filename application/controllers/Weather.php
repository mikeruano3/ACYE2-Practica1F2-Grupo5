<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Weather extends CI_Controller {

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
            /** kevin */
            else if($datos[$x]->coordenadas == '14.518221, -90.544376'){
                $fecha = date("Y-m-", strtotime($datos[$x]->fecha))."26".date(" h:i:s.000000+0000", strtotime($datos[$x]->fecha));
                $datos[$x]->fecha = $fecha;   
            }
        }
        return $datos;
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
    
    public function procesarunahora($datosfiltrados, $hora){
        for ($x = 0; $x < count($datosfiltrados); $x++) {
            if(date("h", strtotime($datosfiltrados[$x]->fecha))==$hora){
                return $datosfiltrados[$x];
            }
        }
        return -1;
    }
    public function procesarhoras($datosfiltrados){
        $datosporhora = [];
        for ($x = 0; $x < 13; $x++) {
            $hora = $x;
            if($x<10){
                $hora = "0".$x;
            }
            $datosporhora[$x] = $this->procesarunahora($datosfiltrados, $hora);
        }
        return $datosporhora;
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
        $datosfiltrados = [];
        $conteofiltrados = 0;
        for ($x = 0; $x < count($datos); $x++) {
            if($datos[$x]->coordenadas === $ubicaciones[$noUbicacion]){
                $datosfiltrados[$conteofiltrados] = $datos[$x];
                $conteofiltrados++;
                $humedad[$x] = $datos[$x]->humedad;
                $presion[$x] = $datos[$x]->presion;
                $radiacion[$x] = $datos[$x]->radiacion;
                $temperatura[$x] = $datos[$x]->temperatura;
            }
        }
        $data = $this->obtenerPromedios($humedad, $presion, $radiacion, $temperatura);
        $data['titulo'] = $ubicacion;
        $data['horasunicas'] = $this->obtenerHorasUnicas($datos);
        $data['datosporhora'] = $this->procesarhoras($datosfiltrados);
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

    public function porfechahora($fecha = NULL, $hora = NULL)
	{
        $datos = $this->obtenerInfo();
        $humedad = []; $presion = []; $radiacion = [];
        $temperatura = [];
        for ($x = 0; $x < count($datos); $x++) {
            if(date("h", strtotime($datos[$x]->fecha)) == $hora
                && date("d", strtotime($datos[$x]->fecha)) == $fecha){
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
