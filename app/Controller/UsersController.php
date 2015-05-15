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
			if($this->User->saveAll($this->data)){
				//Redirecciona a ver al usuario nuevo
				$this->Session->setFlash('Usuario creado');
				$this->redirect(array('action'=>'view', $this->User->id));
			}else{
				$this->Session->setFlash('Error al registrar el usuario. Intente nuevamente.', 'error');
			}
		}
		//tendria que pasar los roles disponibles;
	}
}
