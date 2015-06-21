<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Asentamiento
 *
 * @author vfranco
 */
App::uses('AppModel', 'Model');
class Asentamiento extends AppModel{
    public $name = 'asentamientos';

	var $belongsTo = array(
		'Distrito' => array(
			'className' => 'Distrito',
			'foreignKey' => 'distrito_id',
			'dependent' => false
		)
	);
}
