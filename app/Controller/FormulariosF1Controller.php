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
    		if(empty($this->request->data)){
    			return $this->responseJson(array('status'=>'error', 'message'=>'Not input data'));
    		}
    		if($this->FormularioF1->FormulariosF1Detalle->saveAll($this->request->data['FormulariosF1Detalle'])){
    			return $this->responseJson(array('status'=>'ok', 'message'=>$this->FormularioF1->FormulariosF1Detalle->id, 'data'=>$this->request->data['FormulariosF1Detalle']));
    		}else{
    			return $this->responseJson(array('status'=>'error', 'message'=>'Error saving'));
    		}
                
    	}else{
    		return $this->responseJson(array('status'=>'error', 'message'=>'Bad method'));
    	}	
    }

    public function deleteDetail(){
        if($this->request->is('get')){
            $reply = array();
            if(empty($_GET['id'])){
                return $this->responseJson(array('status'=>'error', 'message'=>'Not input data'));
            }
            if($this->FormularioF1->FormulariosF1Detalle->delete($_GET['id'])){
                return $this->responseJson(array('status'=>'ok', 'message'=>'Succesful'));
            }else{
                return $this->responseJson(array('status'=>'error', 'message'=>'Error deleting'));
            }
                
        }else{
            return $this->responseJson(array('status'=>'error', 'message'=>'Bad method'));
        }    
    }

    public function index(){
        $options = array(
            'conditions'=> $this->conditions,
            'contain'=> array(
                'User'=> array(
                    'nombre'
                ),
                'Compania'=> array(
                    'fields'=> array(
                        'nombre'
                    ),
                    'Distrito'=> array(
                        'nombre'
                    )
                ),
                'Comite'=> array(
                    'fields'=> array(
                        'nombre'
                    ),
                    'Distrito'=> array(
                        'nombre'
                    )
                ),
                'Asentamiento'=> array(
                    'fields'=> array(
                        'nombre'
                    ),
                    'Distrito'=> array(
                        'nombre'
                    )
                )
            )
        );
        if(!empty($_GET['lineas'])){
            $options['limit'] = $_GET['lineas'];
        }else{
            $options['limit'] = 25;
        }
        $this->FormularioF1->Behaviors->attach('Containable');
        $this->paginate = $options;
        $this->set('f1', $this->paginate('FormularioF1'));
        $this->layout = 'renabe';
    }

    private function conditions(){
        if(empty($_GET['desde'])){
            $conditions['f1_formularios.fecha >='] = $_GET['desde'];
        }
        if(empty($_GET['hasta'])){
            $conditions['f1_formularios.fecha <='] = $_GET['hasta'];
        }
        if(empty($_GET['codigo'])){
            $conditions[] = 'f1_formularios.codigo ILIKE %'.$_GET['codigo'].'%';
        }
        if(empty($_GET['asentamiento'])){
            $conditions['f1_formularios.asentamiento'] = $_GET['asentamiento'];
        }
        if(empty($_GET['carpeta'])){
            $conditions['f1_formularios.carpeta_id'] = $_GET['carpeta'];
        }
        if(empty($_GET['compania'])){
            $conditions['f1_formularios.compania_id'] = $_GET['compania'];
        }
        if(empty($_GET['comite'])){
            $conditions['f1_formularios.comite_id'] = $_GET['comite'];
        }
        if(empty($_GET['encuestador'])){
            $conditions['f1_formularios.encuestador_id'] = $_GET['encuestador'];
        }
        if(empty($_GET['usuario'])){
            $conditions['f1_formularios.usuario_id'] = $_GET['usuario'];
        }
        return $conditions;
    }
}
