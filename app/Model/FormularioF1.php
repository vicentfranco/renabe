<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormularioF1
 *
 * @author vfranco
 */
App::uses('AppModel','Model');
class FormularioF1 extends AppModel{
    public $name = 'f1_formularios';

    var $hasMany = array(
		'DetalleF1' => array(
			'className' => 'DetalleF1',
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
		'Carpeta'=>array(
			'className' => 'Carpeta',
			'foreignKey' => 'carpeta_id',
			'dependent' => false
		)
	);
}
