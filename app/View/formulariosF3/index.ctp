<?php //print_r($f3); die(); ?>
<span class="options">
	<h3>F3 - Productores de la Agriculatura Familiar</h3>
	<a href="<?php echo $this->Html->url(array('action'=>'add')); ?>" class="btn btn-primary">Agregar</a>
	<a href="<?php echo $this->Html->url(array('action'=>'export')); ?>" class="btn btn-primary">Exportar</a>
</span>
<hr />
<table class="table table-striped">
	<tr>		
		<th class="key">
			<?php echo $this->Paginator->sort('id', '#') ?>
		</th>
		<th>
			<?php echo $this->Paginator->sort('codigo', 'Codigo') ?>
		</th>
		<th>
			<?php echo $this->Paginator->sort('fecha', 'Fecha') ?>
		</th>
		<th>
			<?php echo $this->Paginator->sort('asentamiento_id', 'Asentamiento') ?>
		</th>
		<th>
			<?php echo $this->Paginator->sort('compania_id', 'Compañia') ?>
		</th>
		<th>
			<?php echo $this->Paginator->sort('comite_id', 'Comite') ?>
		</th>
		<th>
			Lugar Sensado
		</th>
		<th>
			Usuario
		</th>
		<th>
			Registro
		</th>
	</tr>
	<?php 
		foreach ($f3 as $key => $f3) {
	?>
			<tr>
				<td class="numeric key">
					<?php echo $this->Html->link($f3['f3_formularios']['id'], array('controller'=>'formulariosF3', 'action'=>'view', $f3['f3_formularios']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($f3['f3_formularios']['codigo'], array('controller'=>'formulariosF3', 'action'=>'view', $f3['f3_formularios']['id'])) ?>
				</td>
				<td>
					<?php echo $f3['Asentamiento']['nombre'] ?>
				</td>
				<td>
					<?php echo $f3['Copmania']['nombre'] ?>
				</td>
				<td>
					<?php echo $f3['Comite']['nombre'] ?>
				</td>
				<td>
					<?php echo $f3['User']['nombre'] ?>
				</td>
				<td>
					<?php echo $f3['f3_formularios']['created'] ?>
				</td>
			</tr>
	<?php
		}
	?>
</table>
