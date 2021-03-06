<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author vfranco
 */
class UsersController extends AppController{
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }


    public function login() {
            //verificar que haya recibido parametros del formulario e intenta validar
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                    //login correcto
                return $this->redirect($this->Auth->redirectUrl());
            }
            //fallo login
            $this->Session->setFlash('Nombre de usuario y clave incorrecta. Vuelva a intentar');   
        }
        $this->layout = 'login';
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function add(){
            if(!empty($this->data)){
                    if ($this->request->is('post')){
                            $this->User->create();
                            if($this->User->saveAll($this->data)){
                                    //Redirecciona a ver al usuario nuevo
                                    $this->Session->setFlash('Usuario creado');
                                    $this->redirect(array('action'=>'index'));
                            }else{
                                    $this->Session->setFlash('Error al registrar el usuario. Intente nuevamente.', 'error');
                            }
                    }
            }
            //tendria que pasar los roles disponibles;
    }

    public function index(){
            $this->paginate = array(
                    'limit' => 25
            );
            $this->set('usuarios', $this->paginate());

    }


    public function delete($id = null){
            if(empty($id)){
                    $this->Session->setFlash('Id no valido', 'error');
                    $this->redirect(array('action'=>'index'));
            }
            if($this->User->delete($id)){
                    $this->Session->setFlash('Usuario eliminado', 'suscces');
                    $this->redirect(array('action'=>'index'));	
            }else{
                    $this->Session->setFlash('No es posible eliminar el usuario', 'suscces');
                    $this->redirect(array('action'=>'index'));	
            }
    }

    public function edit($id = null){
            if(empty($id)){
                    $this->Session->setFlash('Id no valido', 'error');
                    $this->redirect(array('action'=>'index'));
            }
            if(!empty($this->data)){
                    if($this->User->saveAll($this->data)){
                            $this->Session->setFlash('Usuario editado');
                            $this->redirect(array('action'=>'index'));	
                    }
            }else{
                    $user = $this->User->find('first', array('conditions'=>array('User.id'=>$id)));
                    $this->set('user', $user);
            }
    }

    public function encuestadores(){
        $encuestadores = array();
        $response = array();
        try{
            //TODO: FILTRAR POR TIPO ENCUESTADOR
           $encuestadores = $this->User->find('all');
        } catch (Exception $ex) {
           return Err.getErrorFromDescription('001','Error inesperado');
        }

        foreach($encuestadores as $encuestador){
            $data = $encuestador['User'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre']);
            array_push($response, $a);
    }

        return $this->responseJson($response);
    }
    
    public function usuarios(){
        $usuarios = array();
        $response = array();
        try{
            //TODO: FILTRAR POR TIPO ENCUESTADOR
           $usuarios = $this->User->find('all');
        } catch (Exception $ex) {
           return Err.getErrorFromDescription('001','Error inesperado');
        }

        foreach($usuarios as $usuario){
            $data = $usuario['User'];
            $a = array("id"=>$data['id'], "nombre"=>$data['nombre']);
            array_push($response, $a);
        }

        return $this->responseJson($response);
    }
        
        
}
