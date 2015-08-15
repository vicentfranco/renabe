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
    	margin-left: 0px;
    }
</style>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('menu'); ?>
		</div>
		<div id="content">
                    <div class="col-lg-12 principal" id="form-cab-div">
                    	<h4>Cabecera</h4>
                         <?php echo $this->element($cabecera); ?>
                    </div>
                    <div class="col-lg-10" id="form-det-div">
                        <?php echo $this->Session->flash(); ?>
                        <div class="principal" style="margin:0;">
                        	<h2>F1 - Productores de la Agriculatura Familiar</h2>
                        	<hr />
                        	<?php echo $this->fetch('content'); ?>
                        </div>
                    </div>
                    <div class="col-lg-2 principal" id="form-bus-div">
                        <?php echo $this->element('buscador'); ?>
                    </div>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>
</html>
