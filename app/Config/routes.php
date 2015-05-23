<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';

        
        
//ruta para obtener departamentos
Router::connect(
    '/departamentos',
    array('controller' => 'departamentos', 'action' => 'index')
);

//ruta para obtener los distritos
Router::connect(
        '/distritos',
        array('controller'=> 'distritos', 'action'=> 'index')
);


//ruta para obtener los distritos por departamento
Router::connect('/distritos/view/:id', array(
        'controller' => 'distritos',
        'action' => 'view' ),
    array('id' => '[0-9]+')
);

//ruta para obtener las companhias
Router::connect(
        '/companias',
        array('controller'=> 'companias', 'action'=> 'index')
);


//ruta para obtener las companhias por departamento
Router::connect('/companias/view/:id', array(
        'controller' => 'companias',
        'action' => 'view' ),
    array('id' => '[0-9]+')
);

//ruta para obtener los asentamientos
Router::connect(
        '/asentamientos',
        array('controller'=> 'asentamientos', 'action'=> 'index')
);


//ruta para obtener los asentamientos por departamento
Router::connect('/asentamientos/view/:id', array(
        'controller' => 'asentamientos',
        'action' => 'view' ),
    array('id' => '[0-9]+')
);


Router::connect('/formulariosF1/add', array(
        'controller' => 'formulariosF1',
        'action' => 'add')
);

Router::connect('/productores', array(
        'controller' => 'productores',
        'action' => 'index')
);

Router::connect('/asentamientos/search/:cedula', array(
        'controller' => 'productores',
        'action' => 'search' )
);