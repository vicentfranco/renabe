<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormulariosF1Controller
 *
 * @author vfranco
 */
App::import('Model', 'FormularioF1');
class FormulariosF1Controller extends AppController {

    function beforeRender(){
        $this->set('cabecera', 'f1_cabecera');
        $this->set('form_title', 'F1 - Productores de la Agriculatura Familiar');
        $this->set('tipo', 'f1');
    }

    public function __construct($request = null, $response = null){
    	parent::__construct($request, $response);
    	$this->FormularioF1 = new FormularioF1;
    }

    public function add(){
        $this->layout = 'formulario';
        return $this->render();
    }

    public function addHeader(){
        if(!$this->request->is('post')){
            return $this->responseJson(array('status'=>'error', 'message'=>'Bad method')); 
        }    

        if(empty($this->request->data)){
            $this->log("No se enviaron datos para crear la cabecera");
            return array('status'=>'error', 'message'=>'No hay datos en la peticion');
        }

        $this->request->data['FormularioF1']['fecha_inicio'] = $this->request->data['FormularioF1']['fecha_inicio'].'-07-01';
        $this->request->data['FormularioF1']['fecha_fin'] =  $this->request->data['FormularioF1']['fecha_fin'].'-07-01';

        try {
            if(!$this->FormularioF1->saveAll($this->request->data['FormularioF1'])){
                $this->log("Error al guardar la cabecera. Return False");
                return $this->responseJson(array('status'=>'error', 'message'=>'Error saving'));   
            }
            return $this->responseJson(array('status'=>'ok', 'message'=>$this->FormularioF1->id));
            
        } catch(Exception $e){
            $this->log(sprintf("Error al guardar la cabecera. Exception [ %s ]", $e->getMessage()));
            return $this->responseJson(
                    array('status'=>'error', 'message'=>'Error al guardar la cabecera'. $e->getMessage()));
        }
    }

    public function addDetail(){
    	
        if(!$this->request->is('post')){
            return $this->responseJson(array('status'=>'error', 'message'=>'Bad method')); 
        }

        if(empty($this->request->data)){
            $this->log("No se enviaron datos para agregar el detalle");
            return $this->responseJson(array('status'=>'error', 'message'=>'No se enviaron datos para agregar el detalle'));
        }
        
        try{
            if(!$this->FormularioF1->FormulariosF1Detalle->saveAll($this->request->data['FormulariosF1Detalle'])){
                return $this->responseJson(array('status'=>'error', 'message'=>'Error saving'));
            } 
        } catch (Exception $ex) {
            $this->log(sprintf("Error al guardar el detalle. Exception [ %s ]", $ex->getMessage()));
            return $this->responseJson(array('status'=>'error', 'message'=>'Error al guardar el detalle'));
        }
        
        return $this->responseJson(array('status'=>'ok', 'message'=>$this->FormularioF1->FormulariosF1Detalle->id, 'data'=>$this->request->data['FormulariosF1Detalle']));
    }

    public function deleteDetail(){
        
        if(!$this->request->is('get')){
            return $this->responseJson(array('status'=>'error', 'message'=>'Bad method'));
        }
        
        if(empty($_GET['id'])){
            $this->log("No se envio ningun id de registro para eliminar");
            return $this->responseJson(array('status'=>'error', 'message'=>'No se paso ningun id para eliminar'));
        }
        try{
            if(!$this->FormularioF1->FormulariosF1Detalle->delete($_GET['id'])){
                return $this->responseJson(array('status'=>'error', 'message'=>'Error al eliminar registro'));
            }
        } catch (Exception $ex) {
            $this->log(sprintf("Error al eliminar un detalle. Exception [ %s ]", $ex->getMessage()));
            return $this->responseJson(array('status'=>'error', 'message'=>'Error al eliminar registro'));
        }
        
        return $this->responseJson(array('status'=>'ok', 'message'=>'Succesful'));
    }

    public function index(){
        $this->log($_GET['lineas'], 'info');
        $conditions = $this->conditions();
        $options = array(
            'conditions'=> $conditions,
            'contain'=> array(
                'User'=> array(
                    'nombre'
                ),
                'Compania'=> array(
                    'fields'=> array(
                        'nombre'
                    ),
                    'Distrito'=> array(
                        'nombre'
                    )
                ),
                'Comite'=> array(
                    'fields'=> array(
                        'nombre'
                    ),
                    'Distrito'=> array(
                        'nombre'
                    )
                ),
                'Asentamiento'=> array(
                    'fields'=> array(
                        'nombre'
                    ),
                    'Distrito'=> array(
                        'nombre'
                    )
                )
            )
        );
        if(!empty($_GET['lineas'])){
            $options['limit'] = $_GET['lineas'];
        }else{
            $options['limit'] = 25;
        }
        //print_r($options); die();
        $this->FormularioF1->Behaviors->attach('Containable');
        $this->paginate = $options;
        $this->set('f1', $this->paginate('FormularioF1'));
        $this->set('summary', $this->summary($this->conditions('sql')));
        $this->layout = 'renabe';
    }

    private function conditions($mode = null){
        $conditions = array();
        $condsql = '';
        if(!empty($_GET['desde'])){
            $conditions['f1_formularios.fecha >='] = $_GET['desde'];
            $condsql .= ' AND f1_formularios.fecha >= \''.$_GET['desde'].'\'';
        }
        if(!empty($_GET['departamento'])){
            $conditions['f1_formularios.distrito_id'] = $_GET['departamento'];
        }
        if(!empty($_GET['hasta'])){
            $conditions['f1_formularios.fecha <='] = $_GET['hasta'];
            $condsql .= ' AND f1_formularios.fecha <= \''.$_GET['hasta'].'\'';
        }
        if(!empty($_GET['codigo'])){
            $conditions[] = 'f1_formularios.codigo ILIKE %'.$_GET['codigo'].'%';
            $condsql .= ' AND f1_formularios.codigo ILIKE %'.$_GET['codigo'].'%';
        }
        if(!empty($_GET['asentamiento'])){
            $conditions['f1_formularios.asentamiento'] = $_GET['asentamiento'];
            $condsql .= ' AND f1_formularios.codigo = '.$_GET['asentamiento'];

        }
        if(!empty($_GET['carpeta'])){
            $conditions['f1_formularios.carpeta_id'] = $_GET['carpeta'];
            $condsql .= ' AND f1_formularios.carpeta = '.$_GET['carpeta'];
        }
        if(!empty($_GET['compania'])){
            $conditions['f1_formularios.compania_id'] = $_GET['compania'];
            $condsql .= ' AND f1_formularios.compania = '.$_GET['compania'];
        }
        if(!empty($_GET['comite'])){
            $conditions['f1_formularios.comite_id'] = $_GET['comite'];
            $condsql .= ' AND f1_formularios.comite_id = '.$_GET['comite'];
        }
        if(!empty($_GET['encuestador'])){
            $conditions['f1_formularios.encuestador_id'] = $_GET['encuestador'];
            $condsql .= ' AND f1_formularios.encuestador_id = '.$_GET['encuestador'];
        }
        if(!empty($_GET['usuario'])){
            $conditions['f1_formularios.usuario_id'] = $_GET['usuario'];
            $condsql .= ' AND f1_formularios.usuario_id = '.$_GET['usuario'];
        }
        if($mode == 'sql'){
            return $condsql;
        }
        return $conditions;
    }

    function view($id = null){
        if (empty($id)) {
            $this->Session->setFlash('Formulario invalido', 'error'); 
        }
        $options = array(
            'conditions'=>array(
                'f1_formularios.id'=>$id
            ),
            'contain'=> array(
                'FormulariosF1Detalle'=> array(
                    'Productor'
                ),
                'Comite'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Compania'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Asentamiento'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Encuestador',
                'User'
            )
        ); 
        $this->FormularioF1->Behaviors->attach('Containable');
        
        $f1 = $this->FormularioF1->find('first', $options);
        
        if(empty($f1)){
            $this->Session->setFlash('No se a podido encontrar el formulario');
        }
        $this->set(compact('f1'));
        $this->layout = 'pages';
    }

    function delete($id = null){
        if(empty($id)){
            $this->Session->setFlash('Formulario no valido', 'error');
            $this->redirect(array('controller'=>'formulariosF1','action'=>'index'));
        }
        if($this->FormularioF1->delete($id)){
            $this->Session->setFlash('Formulario eliminado');
            $this->redirect(array('controller'=>'formulariosF1','action'=>'index'));
        }else{
            $this->Session->setFlash('Error al eliminar el formulario. Intente nuevamente', 'error');
            $this->redirect(array('controller'=>'formulariosF1','action'=>'index'));
        }
    }

    function summary($conditions = ''){
        $sql = 
            'SELECT
                COALESCE(SUM(superficie_finca), 0) AS "Summary__superficie_finca",
                COALESCE(SUM(superficie_cultivo), 0) AS "Summary__superficie_cultivo",
                COALESCE(SUM(total_contratados), 0) AS "Summary__total_contratados",
                COALESCE(SUM(bovinos), 0) AS "Summary__bovinos",
                COALESCE(SUM(porcinos), 0) AS "Summary__porcinos",
                COALESCE(SUM(aves), 0) AS "Summary__aves"
            FROM
                f1_detalles,
                f1_formularios
            WHERE
                1 = 1
            '. $conditions;
        ;   
        return $this->FormularioF1->query($sql);
    }
    
    function edit($id = null){
       
        
        if (empty($id)){
            $this->Session->setFlash('Formulario no valido', 'error');
            $this->redirect
                    (array('controller'=>'formulariosF1','action'=>'index'));
        }
        
         $options = array(
            'conditions'=>array(
                'f1_formularios.id'=>$id
            ),
            'contain'=> array(
                'FormulariosF1Detalle'=> array(
                    'Productor'
                ),
                'Comite'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Compania'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Asentamiento'=> array(
                    'Distrito'=> array(
                        'Departamento'
                    )
                ),
                'Encuestador',
                'User',
                'Carpeta'
            )
        ); 
        $this->FormularioF1->Behaviors->attach('Containable');
        
        $f1 = $this->FormularioF1->find('first', $options);
  
        $distrito_id = $f1['Compania']['distrito_id'];
        
        $depar_id = $f1['Compania']['Distrito']['departamento_id'];
        
        $asentamiento = $this -> FormularioF1 -> Asentamiento->find
                ('list',array('conditions'=>array('distrito_id'=> $distrito_id), 'fields' => array('nombre')));
        
        $distrito = $this -> FormularioF1 -> Asentamiento -> Distrito ->find
                ('list',array('conditions'=>array('departamento_id'=> $depar_id), 'fields' => array('nombre')));
               
        $compania = $this -> FormularioF1 -> Compania ->find
                ('list',array('conditions'=>array('distrito_id'=> $distrito_id), 'fields' => array('nombre')));
        
        $comite = $this -> FormularioF1 -> Comite ->find
                ('list',array('conditions'=>array('distrito_id'=> $distrito_id), 'fields' => array('nombre')));
        
        $departamento = $this -> FormularioF1 -> Asentamiento -> Distrito -> Departamento -> find
                ('list',array('conditions'=>array(), 'fields' => array('nombre')));
       
        $encuestador = $this -> FormularioF1 -> User -> find
                ('list',array('conditions'=>array(), 'fields' => array('nombre')));
        
        
        if(empty($f1)){
            $this->Session->setFlash('No se a podido encontrar el formulario');
        }
        
        $this -> set (compact('encuestador') );
        $this -> set (compact( 'departamento' ));
        $this -> set ( compact('comite') );
        $this -> set( compact( 'distrito' ) );
        $this -> set( compact( 'compania' ) );
        $this -> set(compact('asentamiento'));
        $this -> set(compact('f1'));
        $this -> layout = 'formulario';
       
    }

}
