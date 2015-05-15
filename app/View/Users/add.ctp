<div class="principal">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend>Agregar usuario</legend>
			<?php 
				echo $this->Form->input('cedula', array('type'=>'text', 'name'=>'data[User][usuario]', 'class'=>'form-control', 'label'=>'Cedula')); 
				echo $this->Form->input('nombre', array('type'=>'text', 'name'=>'data[User][nombre]', 'class'=>'form-control', 'label'=>'Nombre')); 
			?>
		</fieldset>
	<?php echo $this->Form->submit('Guardar'); ?>
</div>