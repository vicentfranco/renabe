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
    	margin:0;
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
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<div class="principal col-md-12">
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>