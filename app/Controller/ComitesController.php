<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComitesController
 *
 * @author vfranco
 */
class ComitesController extends AppController{
    public function index() {
        
        
        $comites = array();
        try{
           $comites = $this->Comite->find('all');
        } catch (Exception $ex) {
           return Err.getErrorFromDescription('001','Error inesperado');
        }

        return $this->responseJson($comites);
    }
    
    
    
    /**
     * Va a traer los comites que pertenecen a un distrito
     * @param type $id id del distrito
     * @return array de comites
     * @throws NotFoundException
     */
    public function view($id = null) {
        if (!$id) {
            //TODO: voy a modificar esto luego
            throw new NotFoundException(__('Invalid post'));
        }
        $comites = array();
        $response = array();
        try{
            $comites = $this->Comite->find('all',array('conditions'=>array('distrito_id'=>$id)));
        } catch (Exception $ex) {
            return Err.getErrorFromDescription('001','Error inesperado');
        }
        
        foreach($comites as $comite){
            $data = $comite['Comite'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre'], "distrito_id"=>$data['distrito_id']);
            array_push($response, $a);
        }
        return $this->responseJson($response);
    }
}
