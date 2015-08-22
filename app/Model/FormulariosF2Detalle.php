<?php 
App::uses('AppModel','Model');
class FormulariosF2Detalle extends AppModel{
    public $name = 'f2_detalles';

    var $belongsTo = array(
		'FormularioF2' => array(
			'className' => 'FormularioF2',
			'foreignKey' => 'fomulario_id',
			'dependent' => false
		),
		'Zona' => array(
			'className' => 'Zona',
			'foreignKey' => 'zona_id',
			'dependent' => false
		),
		'Actividad' => array(
			'className' => 'Actividad',
			'foreignKey' => 'actividad_id',
			'dependent' => false
		)
	);

}
?>