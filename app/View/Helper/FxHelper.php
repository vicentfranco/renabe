<?php
App::uses('Helper', 'View');

class FxHelper extends Helper {

	function format($data, $type,$options = array()){
		$result = null;
		switch ($type) {
			case 'numerico':
				if(empty($options['decimales'])){
					$options['decimales'] = 0;
				}
				$result = number_format($data, $options['decimales'], ',', '.');
				break;
			
			case 'fecha':
				$time = strtotime($data);
				$result = date('Y-m-d', $time);
				break;
			default:
				$result = $data;
		}
		return $result;
	}

	function renabeFormat($form = array()){
		$result = '';
		if(!empty($form['Asentamiento'])){
			$result = 'Asentamiento'; 
		}else if(!empty($form['Compania'])){
			$result = 'Compania'; 
		}else if(!empty($form['Comite'])){
			$result = 'Comite';
		}
		if(!empty($form[$result]['nombre'])){
			$result .= ' - '.$form[$result]['nombre'];
		}
		return $result;
	}

	function getDepartament($data = null){
		$type = $this->getType($data);
		if(isset($data[$type]['Distrito']['Departamento'])){
			return $data[$type]['Distrito']['Departamento'];
		}
		return array('nombre'=>'Desconocido');
	}

	function getDistrito($data = null){
		$type = $this->getType($data);
		if(isset($data[$type]['Distrito'])){
			return $data[$type]['Distrito'];
		}
		return array('nombre'=>'Desconocido');
	}

	function getType($data = null){
		if (!empty($data['Asentamiento']['id'])) {
			return 'Asentamiento';
		}
		if (!empty($data['Distrito']['id'])) {
			return 'Distrito';
		}
		if (!empty($data['Compania']['id'])) {
			return 'Compania';
		}
		return 'Desconocido';
	}
}

?>