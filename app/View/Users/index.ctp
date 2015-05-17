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
			<th colspan="2">Opciones</th>
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
  							<?php echo $this->Html->url('edit', array('controller'=>'users', 'action'=>'edit', 'class'=>'glyphicon glyphicon-pencil')); //<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> ?>
					</td>
					<td scope="row">
  							<span class="glyphicon glyphicon-trash" aria-hidden="true"><?php echo $this->Html->url(array('controller'=>'users', 'action'=>'delete')); ?></span>
					</td>
				<tr>
		<?php 
			}
		?>
	</table>
	<?php echo $this->element('paginate'); ?>
</div>