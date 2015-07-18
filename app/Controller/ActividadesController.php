<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActividadesController
 *
 * @author vfranco
 */
App::uses('Actividad', 'Model');
class ActividadesController extends AppController{
    
    public function __construct($request = null, $response = null){
    	parent::__construct($request, $response);
    	$this->Actividad = new Actividad;
    }
    
    public function index(){
        $actividades = array();
        $response = array();
        try {
            
           $actividades = $this->Actividad->find('all');
           $this -> log($actividades, 'info');
        } catch (Exception $ex) {
           $this->log("Error al obtener las actividades");
           return Err.getErrorFromDescription('001','Error inesperado');
        }
        
         foreach($actividades as $actividad){
            $data = $actividad['actividades'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre']);
            array_push($response, $a);
        }

        return $this->responseJson($response);
    }
}
