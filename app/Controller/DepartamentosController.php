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
        //TODO: return from model departamento
        $departamentos = array('1'=>'central','2'=>'alto parana');

        return $this->responseJson($departamentos);
    }
    
    
}
