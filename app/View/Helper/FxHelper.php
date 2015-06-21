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

	function renabeFormat($data = array()){
		$result = '';
		$key = key($data);
		if($key != null){
			$result .= $key;
		}
		if(!empty($data['nombre'])){
			$result .= ' - '.$data['nombre'];
		}
		return $result;
	}
}

?>