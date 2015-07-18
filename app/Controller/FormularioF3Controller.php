<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormularioF3Controller
 *
 * @author vfranco
 */
class FormularioF3Controller extends AppController{
    function beforeRender(){
        $this->set('cabecera', 'f3_cabecera');
    }
}
