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
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<style type="text/css">
    .numeric{
        text-align: right;
    }
    .principal{
    	margin-left: 10px;
    }
    #menu-panel{
    	margin-left: 25px;
    	margin-right: 5px;
    	padding-left: 0px;
    	padding-right: 0px;
    }

    .key{
    	width: 25px;	
    }

    .header{
    	margin-top: auto;
    	height: 38px;
    	padding: 5px 16px;
    }


</style>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('menu'); ?>
		</div>
		<div id="content" class="row">
			 <?php echo $this->Session->flash(); ?>
                <div class="panel panel-primary col-md-2" id="menu-panel">
				  <div class="panel-heading">
				    <h3 class="panel-title">Opciones</h3>
				  </div>
				  <div class="panel-body principal" style="margin-left:0px; margin-bottom:0px">
				    <?php echo $this->element('filtros'); ?>
				  </div>
				</div>
				<div class="principal col-md-9" id="contenido">
					<?php echo $this->fetch('content'); ?>
					<?php echo $this->element('paginate'); ?>
				</div>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>
</html>
