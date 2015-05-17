<div class="principal">
	<?php echo $this->Form->create('User'); ?>
		<fieldset>
			<legend>Editar usuario</legend>
			<?php 
				echo $this->Form->input('id', array('type'=>'hidden', 'name'=>'data[User][id]','value'=>$user['User']['id']));
				echo $this->Form->input('cedula', array('type'=>'text', 'name'=>'data[User][usuario]', 'label'=>'Cedula', 'value'=>$user['User']['cedula'])); 
				echo $this->Form->input('nombre', array('type'=>'text', 'name'=>'data[User][nombre]', 'label'=>'Nombre', 'value'=>$user['User']['nombre'])); 
				echo $this->Form->input('username', array('type'=>'text', 'name'=>'data[User][username]', 'label'=>'Nombre de Usuario', 'value'=>$user['User']['username']));
				echo $this->Form->input('password', array('type'=>'password', 'name'=>'data[User][password]', 'label'=>'Clave'));
			?>
		</fieldset>
	<?php echo $this->Form->submit('Guardar'); ?>
</div>