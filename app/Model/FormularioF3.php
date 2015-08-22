<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormularioF3
 *
 * @author vfranco
 */
App::uses('AppModel', 'Model');
class FormularioF3 extends AppModel{
    public $name = 'f3_formularios';
    
    var $hasMany = array(
		'FormulariosF3Detalle' => array(
			'className' => 'DetalleF3',
			'foreignKey' => 'formulario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
		)
	);

	var $belongsTo = array(
		'Encuestador' => array(
			'className' => 'User',
			'foreignKey' => 'encuestador_id',
			'dependent' => false
		),
		'Asentamiento'=> array(
			'className' => 'Asentamiento',
			'foreignKey' => 'asentamiento_id',
			'dependent' => false
		),
		'Compania'=> array(
			'className' => 'Compania',
			'foreignKey' => 'compania_id',
			'dependent' => false
		),
		'Comite'=> array(
			'className' => 'Comite',
			'foreignKey' => 'comite_id',
			'dependent' => false
		),
		'Carpeta'=> array(
			'className' => 'Carpeta',
			'foreignKey' => 'carpeta_id',
			'dependent' => false
		),
		'User'=> array(
			'className' => 'User',
			'foreignKey' => 'usuario_id',
			'dependent' => false
		)
	);
}
