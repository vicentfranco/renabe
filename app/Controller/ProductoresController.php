<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductorController
 *
 * @author vfranco
 */
app::import('Model','Productor');
class ProductoresController extends AppController{
       
    public function __construct($request = null, $response = null) {
        parent::__construct( $request, $response );
        $this->Productor = new Productor;
    }
    
    public function index(){
       $productores = array();
       
        try {

           $productores = $this->Productor->find('all');
        } catch (Exception $ex) {
           return Err.getErrorFromDescription('001','Error inesperado');
        }
        return $this->responseJson($productores);
    }
    
    public function search($cedula = null){
        if (!$cedula){
            throw new NotFoundException(__('La cedula no puede ser vacio'));
        }
        $productor = null;
        try {
            $productores = $this->Productor->find('all', 
                    array('conditions'=>array('cedula'=>$cedula)));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        $p = array();
        foreach($productores as $productor){
            $data = $productor['productores'];
            $p = array("id"=>$data["id"], 
                "nombre"=>$data["nombre"],
                "cedula"=>$data["cedula"],
                "cantFamilia"=>$data["total_familiares"]
            );
        }
        return $this->responseJson($p);
            
    }
    
    function addProductor(){
        if($this->request->is('post')){
            $reply = array();
            if(empty($this->request->data)){
                return $reply = array('status'=>'error', 'message'=>'Not input data');
            }
            if($this->Productor->saveAll($this->request->data['Productor'])){
                return $this->responseJson(array('status'=>'ok', 'message'=>$this->Productor->id, 'data'=>$this->request->data['Productor']));
            }else{
                return $this->responseJson(array('status'=>'error', 'message'=>'Error saving'));
            }
        }else{
            return $this->responseJson(array('status'=>'error', 'message'=>'Bad method'));
        }
    }
    
}
