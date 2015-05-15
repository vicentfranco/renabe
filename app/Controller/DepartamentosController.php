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
        //$departamentos = array('1'=>'central','2'=>'alto parana');
        $departamentos = null;
        try{
           $departamentos = $this->Departamento->find('all');
        } catch (Exception $ex) {
           return Err.getErrorFromDescription('001','Error inesperado');
        }

        return $this->responseJson($departamentos);
    }
    
    
}
