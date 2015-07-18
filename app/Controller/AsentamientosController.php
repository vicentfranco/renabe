<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsentamientosController
 *
 * @author vfranco
 */
class AsentamientosController extends AppController{
    
    public function index() {
        
        $asentamientos = array();
        try{
           $asentamientos = $this->Asentamiento->find('all');
        } catch (Exception $ex) {
           $this->log("Error al obtener los asentamientos");
           return Err.getErrorFromDescription('001','Error inesperado');
        }

        return $this->responseJson($asentamientos);
    }
    /**
     * Va a traer los asentamientos que pertenecen a una companhia
     * @param type $id id de la companhia
     * @return array de asentamientos
     * @throws NotFoundException
     */
    public function view($id = null) {
        if (!$id) {
            //TODO: voy a modificar esto luego
            throw new NotFoundException(__('Invalid post'));
        }
        $asentamientos = array();
        $response = array();
        
        try{
            $asentamientos = $this->Asentamiento->find('all',array('conditions'=>array('distrito_id'=>$id)));
        } catch (Exception $ex) {
            $this->log("Error al obtener el asentamiento con id: " + $id);
            return Err.getErrorFromDescription('001','Error inesperado');
        }
        
        foreach($asentamientos as $asentamiento){
            $data = $asentamiento['Asentamiento'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre'], "distrito_id"=>$data['distrito_id']);
            array_push($response, $a);
        }
        
        return $this->responseJson($response);
    }
}
