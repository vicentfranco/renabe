<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormularioF2
 *
 * @author vfranco
 */
App::uses('AppModel', 'Model');
class FormularioF2 extends AppModel{
    public $name = 'f2_formularios';

    var $hasMany = array(
		'FormulariosF2Detalle' => array(
			'className' => 'FormulariosF2Detalle',
			'foreignKey' => 'formulario_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
		)
	);

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'usuario_id',
			'dependent' => false
		),
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
		)
	);
}
