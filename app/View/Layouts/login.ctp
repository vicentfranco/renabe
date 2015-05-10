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

		
		echo $this->Html->script('jquery-2.1.3.min.js');
		echo $this->Html->script('jquery-2.1.3.js'); 
		echo $this->Html->css('bootstrap.css');
		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->script('bootstrap.js');
		echo $this->Html->script('bootstrap.min.js');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<style type="text/css">
.panel-heading {
    padding: 5px 15px;
}

.panel-footer {
	padding: 1px 15px;
	color: #A0A0A0;
}

.profile-img {
	width: 96px;
	height: 96px;
	margin: 0 auto 10px;
	display: block;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
}

body{
	background: rgb(255,252,252); /* Old browsers */
	background: -moz-linear-gradient(top,  rgba(255,252,252,1) 0%, rgba(227,234,237,1) 90%, rgba(200,215,220,1) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,252,252,1)), color-stop(90%,rgba(227,234,237,1)), color-stop(100%,rgba(200,215,220,1))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(255,252,252,1) 0%,rgba(227,234,237,1) 90%,rgba(200,215,220,1) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(255,252,252,1) 0%,rgba(227,234,237,1) 90%,rgba(200,215,220,1) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(255,252,252,1) 0%,rgba(227,234,237,1) 90%,rgba(200,215,220,1) 100%); /* IE10+ */
	background: linear-gradient(to bottom,  rgba(255,252,252,1) 0%,rgba(227,234,237,1) 90%,rgba(200,215,220,1) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fffcfc', endColorstr='#c8d7dc',GradientType=0 ); /* IE6-9 */
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-position: bottom; 
}

</style>
<body>
	<div id="container">
		<div id="header">
			
		</div>
		<div id="content">

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
</body>
</html>
