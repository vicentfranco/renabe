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
				$result = number_format($data, ',', '.', $options['decimales']);
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
}

?>