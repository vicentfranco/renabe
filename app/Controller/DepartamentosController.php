<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartamentoController
 *
 * @author vfranco
 */
class DepartamentosController extends AppController {
    
    public function index() {
        //TODO: return from model departamento
        //$departamentos = array('1'=>'central','2'=>'alto parana');
        $departamentos = array();
        $response = array();
        try{
           $departamentos = $this->Departamento->find('all');
        } catch (Exception $ex) {
           $this->log("Error al obtener los departamentos");
           return Err.getErrorFromDescription('001','Error inesperado');
        }
        foreach($departamentos as $departamento){
            $data = $departamento['Departamento'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre']);
           array_push($response, $a);
        }
        return $this->responseJson($response);
    }
    
    
}
