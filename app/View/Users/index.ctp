<div class="principal">
	<h1>Usuarios</h1>
	<hr />
	<table class="table table-striped table-hover ">
		<tr>
			<th><?php echo $this->Paginator->sort('id', '#'); ?></th>
			<th><?php echo $this->Paginator->sort('cedula', 'Cedula') ?></th>
			<th><?php echo $this->Paginator->sort('nombre', 'Nombre') ?></th>
			<th><?php echo $this->Paginator->sort('username', 'Login'); ?></th>
			<th>Fecha de creacion</th>
			<th colspan="3">Opciones</th>
		</tr>
		<?php 
			foreach ($usuarios as $usuario) { 
		?>
				<tr class="active">
					<td scope="row"><?php echo $usuario['User']['id'] ?></td>
					<td><?php echo $usuario['User']['cedula'] ?></td>
					<td><?php echo $usuario['User']['nombre'] ?></td>
					<td><?php echo $usuario['User']['username'] ?></td>
					<td><?php echo $usuario['User']['created'] ?></td>
					<td scope="row">
  							<?php echo $this->Html->link('Editar', array('controller'=>'users', 'action'=>'edit', 'class'=>'btn btn-primary')); ?>
					</td>
					<td>
							<?php
								if($usuario['User']['habilitado']){
									echo '<a href="#" class="btn btn-default deshabilitar">Deshabilitar</a>';
								}else{
									echo '<a href="#" class="btn btn-succes deshabilitar">Habilitar</a>';
								}
							?>
					</td>
					<td scope="row">
  							<?php echo $this->Html->link('Eliminar', array('controller'=>'users', 'action'=>'edit', 'class'=>'btn btn-warning')); ?>
					</td>
				<tr>
		<?php 
			}
		?>
	</table>
	<?php echo $this->element('paginate'); ?>
</div>