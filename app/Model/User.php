<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author vfranco
 */

App::uses('AppModel', 'Model');
class User extends AppModel{
    public $name = 'usuarios'; 
        public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El usuario es requerido'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La contraseña es requerida'
            )
        ),
        'role' => array(
            'valid' => array(
                'message' => 'Rol no valido',
                'allowEmpty' => false
            )
        )
    );
}
