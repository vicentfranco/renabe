<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DetallesF1
 *
 * @author vfranco
 */
App::uses('AppModel', 'Model');
class DetalleF1 extends AppModel{
    public $name = 'f1_detalle';

    var $belongsTo = array(
		'FormularioF1' => array(
			'className' => 'FormularioF1',
			'foreignKey' => 'formulario_id',
			'dependent' => false
		),
		'Productor'=> array(
			'className' => 'Productor',
			'foreignKey' => 'productor_id',
			'dependent' => false
		)
	);
}
