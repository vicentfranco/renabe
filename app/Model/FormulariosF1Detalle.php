<?php 
App::uses('AppModel','Model');
class FormulariosF1Detalle extends AppModel{
    public $name = 'f1_detalles';

    var $belongsTo = array(
		'FormularioF1' => array(
			'className' => 'FormularioF1',
			'foreignKey' => 'fomulario_id',
			'dependent' => false
		),
		'Productor' => array(
			'className' => 'Productor',
			'foreignKey' => 'productor_id',
			'dependent' => false
		)
	);

}
?>