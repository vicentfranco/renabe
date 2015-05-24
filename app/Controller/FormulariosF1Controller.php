<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormulariosF1Controller
 *
 * @author vfranco
 */
App::import('Model', 'FormularioF1');
class FormulariosF1Controller extends AppController {

    public function __construct($request = null, $response = null){
    	parent::__construct($request, $response);
    	$this->FormularioF1 = new FormularioF1;
    }

    public function add(){
        return $this->render();
    }

    public function addHeader(){
    	if($this->request->is('post')){
    		$reply = array();
    		if(!empty($this->request->data)){
                $this->request->data['FormularioF1']['fecha_inicio'] = $this->request->data['FormularioF1']['fecha_inicio'].'-07-01';
                $this->request->data['FormularioF1']['fecha_fin'] =  $this->request->data['FormularioF1']['fecha_fin'].'-07-01';
    		}else{
    			return $reply = array('status'=>'error', 'message'=>'Not input data');
    		}
    		if($this->FormularioF1->saveAll($this->request->data['FormularioF1'])){
    			return $this->responseJson(array('status'=>'ok', 'message'=>$this->FormularioF1->id));
    		}else{
    			return $this->responseJson(array('status'=>'error', 'message'=>'Error saving'));
    		}
    	}else{
    		return $this->responseJson(array('status'=>'error', 'message'=>'Bad method'));
    	}
    }

    public function addDetail(){
    	if($this->request->is('post')){
    		$reply = array();
    		if(!empty($_POST)){
    			$header = $_POST;
    		}else{
    			return $this->responseJson(array('status'=>'error', 'message'=>'Not input data'));
    		}
    		if($this->FormularioF1->saveAll($header)){
    			return $this->responseJson(array('status'=>'ok', 'message'=>$this->FormularioF1->id));
    		}else{
    			return $this->responseJson(array('status'=>'error', 'message'=>'Error saving'));
    		}
    	}else{
    		return $this->responseJson(array('status'=>'error', 'message'=>'Bad method'));
    	}	
    }
}
