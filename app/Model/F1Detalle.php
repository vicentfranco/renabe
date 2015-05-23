<?php 

App::uses('AppModel','Model');
class F1Detalle extends AppModel{


	var $belongsTo = array(
		'FormularioF1' => array(
			'className' => 'FormularioF1',
			'foreignKey' => 'formulario_id',
			'dependent' => true
		),
		'Productor' => array(
			'className' => 'Productor',
			'foreignKey' => 'productor_id',
			'dependent' => false
		)
	);
}
?>