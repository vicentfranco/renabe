<?php
App::uses('Model', 'Productor');
class ProductorsController extends AppController{
	
	function addProductor(){
		if($this->request->is('post')){
    		$reply = array();
    		if(empty($this->request->data)){
    			return $reply = array('status'=>'error', 'message'=>'Not input data');
    		}
    		if($this->Productor->saveAll($this->request->data['Productor'])){
    			return $this->responseJson(array('status'=>'ok', 'message'=>$this->Productor->id));
    		}else{
    			return $this->responseJson(array('status'=>'error', 'message'=>'Error saving'));
    		}
    	}else{
    		return $this->responseJson(array('status'=>'error', 'message'=>'Bad method'));
    	}
	}
}
?>