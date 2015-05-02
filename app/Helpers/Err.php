<?php

namespace helper;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Err
 *
 * @author vfranco
 */
class Err {
    const ERROR_RESPONSE = 'error';
    private $code;
    private $description;
    
    function __construct($code, $description){
        $this->code = $code;
        $this->description = $description;  
    }


    static function getErrorFromDescription($code, $description){
        $error = new Err($code, $description);
        $response = array(ERROR_RESPONSE => $error);
        return $response;
    }
}
