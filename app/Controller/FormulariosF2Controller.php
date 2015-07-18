<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormulariosF2Controller
 *
 * @author vfranco
 */
class FormulariosF2Controller extends AppController{
    function beforeRender(){
        $this->set('cabecera', 'f2_cabecera');
    }
}
