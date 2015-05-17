<div class="principal">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend>Agregar usuario</legend>
			<?php 
				echo $this->Form->input('cedula', array('type'=>'text', 'name'=>'data[User][usuario]', 'label'=>'Cedula')); 
				echo $this->Form->input('nombre', array('type'=>'text', 'name'=>'data[User][nombre]', 'label'=>'Nombre')); 
				echo $this->Form->input('username', array('type'=>'text', 'name'=>'data[User][username]', 'label'=>'Nombre de Usuario'));
				echo $this->Form->input('password', array('type'=>'password', 'name'=>'data[User][password]', 'label'=>'Clave'));
			?>
		</fieldset>
	<?php echo $this->Form->submit('Guardar'); ?>
</div>