<?php $cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
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
			    <h3 class="panel-title">Informacion General</h3>
			  </div>
			  <div class="panel-body principal" style="margin-left:0px; margin-bottom:0px">
			    <?php echo $this->element('leftdata'); ?>
			  </div>
			</div>
			<div class="principal col-md-9" id="contenido">
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>