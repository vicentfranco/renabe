<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormulariosF3Controller
 *
 * @author vfranco
 */
App::import('Model', 'FormularioF3');
class FormulariosF3Controller extends AppController{
       

    function beforeRender(){
        $this->set('cabecera', 'f3_cabecera');
        $this->set('tipo', 'f3');
    }

    
    public function __construct($request = null, $response = null){
    	parent::__construct($request, $response);
    	$this->FormularioF3 = new FormularioF3;
    }
    
    public function add(){
        $this -> layout = 'formulario';
        return $this -> render();
    }
    
    public function addHeader(){
        if (!$this -> request -> is('post')){
            return $this ->responseJson(array('status'=>'error', 'message'=>'Bad method'));
        }
        
        if(empty($this -> request -> data)){
            $this ->log("No se enviaron datos para crear la cabecera");
            return array('status'=>'error', 'message'=>'No hay datos en la peticion');
        }
        
        $this->request -> data['FormularioF3']['fecha_inicio'] = $this-> request-> data['FormularioF3']['fecha_inicio'].'-07-01';
        $this->request -> data['FormularioF3']['fecha_fin'] =  $this-> request-> data['FormularioF3']['fecha_fin'].'-07-01';

        try {
            $this -> log("Datos recibidos para insertar la cabecera F3", "info");
            $this->log($this->request->data, 'info');
            
            if(!$this->FormularioF3->saveAll($this->request->data['FormularioF3'])){
                $this-> log("Error al guardar la cabecera. Return False");
                return $this -> responseJson(array('status' => 'error', 'message' => 'Error saving'));   
            }
            
            return $this -> responseJson(array('status' => 'ok', 'message' => $this->FormularioF3 -> id));
            
        } catch(Exception $e){
            
            $this -> log( sprintf("Error al guardar la cabecera. Exception [ %s ]", $e -> getMessage()) );
            return $this-> responseJson(
                    array('status' => 'error', 'message' => 'Error al guardar la cabecera'));
        }
        
    }
    
    public function addDetail(){
    	
        if(!$this-> request -> is('post')){
            return $this -> responseJson(array('status'=>'error', 'message'=>'Bad method')); 
        }

        if(empty($this -> request -> data)){
            $this -> log("No se enviaron datos para agregar el detalle");
            return $this-> responseJson(array('status' => 'error', 'message' => 'No se enviaron datos para agregar el detalle'));
        }
        
        try {
            $this -> log("Datos recibidos para insertar el detalle F3", "info");
            $this->log($this-> request-> data, 'info');
            
            if(!$this-> FormularioF3 -> FormulariosF3Detalle->saveAll($this-> request -> data['FormulariosF3Detalle'])){
                return $this -> responseJson(array('status' => 'error', 'message' => 'Error saving'));
            }
            
        } catch (Exception $ex) {
            $this -> log(sprintf("Error al guardar el detalle. Exception [ %s ]", $ex -> getMessage()));
            return $this -> responseJson(array('status' => 'error', 'message' => 'Error al guardar el detalle'));
        }
        
        return $this -> responseJson(array('status' => 'ok', 'message' => $this -> FormularioF3 -> FormulariosF3Detalle -> id, 'data'=>$this->request->data['FormulariosF3Detalle']));
    }
    
    
    public function deleteDetail(){
        
        if (!$this->request->is('get')){
            return $this -> responseJson(array('status' => 'error', 'message' => 'Bad method'));
        }
        
        if (empty($_GET['id'])){
            $this ->log ("No se envio ningun id de registro para eliminar");
            return $this -> responseJson(array('status' => 'error', 'message' => 'No se paso ningun id para eliminar'));
        }
        try {
            if(!$this -> FormularioF3 -> FormulariosF3Detalle -> delete($_GET['id'])){
                return $this -> responseJson(array('status' => 'error', 'message' => 'Error al eliminar registro'));
            }
        } catch (Exception $ex) {
            $this -> log(sprintf("Error al eliminar un detalle. Exception [ %s ]", $ex -> getMessage()));
            return $this -> responseJson(array('status' => 'error', 'message' => 'Error al eliminar registro'));
        }
        
        return $this -> responseJson(array('status' => 'ok', 'message' => 'Succesful'));
    }

    public function index(){
        $options = array(
            'conditions'=> $this->conditions(),
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
        if (!empty($_GET['lineas'])){
            $options['limit'] = $_GET['lineas'];
        } else{
            $options['limit'] = 25;
        }
        
        //print_r($options); die();
        $this -> FormularioF3 -> Behaviors -> attach('Containable');
        $this -> paginate = $options;
        $this -> set('f3', $this-> paginate ('FormularioF3'));
        $this -> layout = 'renabe';
    }

    private function conditions(){
        $conditions = array();
        if(!empty($_GET['desde'])){
            $conditions['f3_formularios.fecha >='] = $_GET['desde'];
        }
        if(!empty($_GET['hasta'])){
            $conditions['f3_formularios.fecha <='] = $_GET['hasta'];
        }
        if(!empty($_GET['codigo'])){
            $conditions[] = 'f3_formularios.codigo ILIKE %'.$_GET['codigo'].'%';
        }
        if(!empty($_GET['asentamiento'])){
            $conditions['f3_formularios.asentamiento'] = $_GET['asentamiento'];
        }
        if(!empty($_GET['carpeta'])){
            $conditions['f3_formularios.carpeta_id'] = $_GET['carpeta'];
        }
        if(!empty($_GET['compania'])){
            $conditions['f3_formularios.compania_id'] = $_GET['compania'];
        }
        if(!empty($_GET['comite'])){
            $conditions['f3_formularios.comite_id'] = $_GET['comite'];
        }
        if(!empty($_GET['usuario'])){
            $conditions['f3_formularios.usuario_id'] = $_GET['usuario'];
        }
        return $conditions;
    }

    function view($id = null){
        
        if (empty($id)) {
            $this -> Session -> setFlash('Formulario invalido', 'error'); 
        }
        
        $options = array(
            'conditions'=>array(
                'f3_formularios.id'=>$id
            ),
            'contain'=> array(
                'FormulariosF3Detalle'=> array(
                    'Productor'
                ),
                'Comite'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Compania'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Asentamiento'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'User'
            )
        ); 
        $this -> FormularioF3 -> Behaviors -> attach('Containable');
        $f3 = $this-> FormularioF3 -> find('first', $options);
        if (empty($f3)){
            $this -> Session -> setFlash('No se a podido encontrar el formulario');
        }
        $this -> set(compact('f3'));
    }

    function delete($id = null){
        if (empty($id)){
            $this -> Session-> setFlash ('Formulario no valido', 'error');
            $this -> redirect(array('controller'=>'formulariosF3','action'=>'index'));
        }
        if( $this -> FormularioF3 -> delete($id)){
            $this -> Session -> setFlash('Formulario eliminado');
            $this -> redirect(array('controller'=>'formulariosF3','action'=>'index'));
        }else{
            $this -> Session -> setFlash('Error al eliminar el formulario. Intente nuevamente', 'error');
            $this -> redirect(array('controller'=>'formulariosF3','action'=>'index'));
        }
    }

}
