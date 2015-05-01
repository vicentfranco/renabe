<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DepartamentoController
 *
 * @author vfranco
 */
class DepartamentosController extends AppController {
    
    public function index() {
       // $departamentos = $this->Departamento->find('all');
        $departamentos = array('1'=>'central','2'=>'alto parana');
        $this->set("status", "OK");
$this->set("message", "You are good");
$this->set("content", $content);
// Can also set() other variables that might not be used in the JSON or XML string
$this->set("other", "something");
$this->set("stuff", "else");
// or simply
$this->set($departamentos);

        return $this->set("_serialize", array("status", "message", "content"));;
    }
    
    
}
