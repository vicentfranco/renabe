<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DistritosController
 *
 * @author vfranco
 */
class DistritosController extends AppController{
    
    public function index() {
        
        
        $distritos = array();
        try{
           $distritos = $this->Distrito->find('all');
        } catch (Exception $ex) {
           return Err.getErrorFromDescription('001','Error inesperado');
        }

        return $this->responseJson($distritos);
    }
    /**
     * Va a traer los distritos que pertenecen a un distrito
     * @param type $id id del departamento
     * @return array de distritos
     * @throws NotFoundException
     */
    public function view($id = null) {
        if (!$id) {
            //TODO: voy a modificar esto luego
            throw new NotFoundException(__('Invalid post'));
        }
        $distritos = array();
        $response = array();
        try{
            $distritos = $this->Distrito->find('all',array('conditions'=>array('departamento_id'=>$id)));
        } catch (Exception $ex) {
            return Err.getErrorFromDescription('001','Error inesperado');
        }
        
        foreach($distritos as $distrito){
            $data = $distrito['Distrito'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre'], "departamento_id"=>$data['departamento_id']);
            array_push($response, $a);
        }
        return $this->responseJson($response);
    }
}
