<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		
		echo $this->Html->script('jquery-2.1.3.js'); 
		echo $this->Html->css('bootstrap.css');
		echo $this->Html->script('bootstrap.js');
        echo $this->Html->script('../assets/js/Buscador.js'); 


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<style type="text/css">
    .numeric{
        text-align: right;
    }
</style>
<body>
	<div id="container">
		<div id="header">
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">Renabe</a>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav navbar-left">
			        <li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'index')); ?>">Usuarios</a></li>
			      </ul>
			      <ul class="nav navbar-nav">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formularios <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="#">F1 - Productores de la Agricultura Familiar</a></li>
			            <li><a href="#">F2 - Productores Indigenas, Urbanos y Periurbanos</a></li>
			            <li><a href="#">F3 - Productores Agropecuarios Consolidados</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Ver Anexos</a></li>
			          </ul>
			        </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reportes <span class="caret"></span></a>
			          <ul class="dropdown-menu" role="menu">
			            <li><a href="#">Beneficiarios por Departamento</a></li>
			            <li><a href="#">Beneficiarios por Distritos</a></li>
			            <li><a href="#">Beneficiarios por Comite o Asentamiento</a></li>
			            <li class="divider"></li>
			            <li><a href="#">F1 - Productores de la Agricultura Familiar</a></li>
			            <li class="divider"></li>
			            <li><a href="#">Productores</a></li>
			          </ul>
			        </li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'logout')); ?>">Salir  <span class="glyphicon glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
			      </ul>
			      <form class="navbar-form navbar-right" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Submit</button>
			      </form>
			    </div>
			  </div>
			</nav>
		</div>
		<div id="content" class="row">
                    <div class="col-lg-1" id="form-cab-div">
                         <?php echo $this->element('cabecera'); ?>
                    </div>
                    <div class="col-lg-9" id="form-det-div">
                        <?php echo $this->Session->flash(); ?>
                        <?php echo $this->fetch('content'); ?>
                    </div>
                    <div class="col-lg-2" id="form-bus-div">
                        <?php echo $this->element('buscador'); ?>
                    </div>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>
</html>
