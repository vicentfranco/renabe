<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of CompaniaController
 *
 * @author vfranco
 */
class CompaniasController extends AppController{
    
    public function index() {
        
        $companias = array();
        try{
           $companias = $this->Compania->find('all');
        } catch (Exception $ex) {
           $this->log("Error al obtener las companias");
           return $this->responseJson($ex.message);
        }

        return $this->responseJson($companias);
    }
    /**
     * Va a traer las companhias que pertenecen a un distrito
     * @param type $id id del distrito
     * @return array de companhias
     * @throws NotFoundException
     */
    public function view($id = null) {
        
        if (!$id) {
            //TODO: voy a modificar esto luego
            throw new NotFoundException(__('Invalid post'));
        }
        
        $companias = array();
        $response = array();
        
        try{
            $companias = $this->Compania->find('all',array('conditions'=>array('distrito_id'=>$id)));
        
        } catch (Exception $ex) {
            $this->log("Error al obtener la compania con id: " + $id);
            return Err.getErrorFromDescription('001','Error inesperado');
        }
        
        foreach($companias as $compania){
            $data = $compania['Compania'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre'], "distrito_id"=>$data['distrito_id']);
            array_push($response, $a);
        }
        
        return $this->responseJson($response);
    }
}
