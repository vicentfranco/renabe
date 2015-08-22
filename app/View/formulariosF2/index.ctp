<?php //print_r($zonas); die(); ?>
<span class="options">
	<h3>F2 - Productores Indíginas, Urbanos y Periurbanos</h3>
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
			<?php echo $this->Paginator->sort('copmania_id', 'Compañia') ?>
		</th>
		<th>
			<?php echo $this->Paginator->sort('comite_id', 'Comite') ?>
		<th>
			Usuario
		</th>
		<th>
			Registro
		</th>
	</tr>
	<?php 
		foreach ($f2 as $key=>$f2) {
	?>
			<tr>
				<td class="numeric key">
					<?php echo $this->Html->link($f2['f2_formularios']['id'], array('controller'=>'formulariosF2', 'action'=>'view', $f2['f2_formularios']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($f2['f2_formularios']['codigo'], array('controller'=>'formulariosF2', 'action'=>'view', $f2['f2_formularios']['id'])) ?>
				</td>
				<td>
					<?php echo $this->Fx->format($f2['f2_formularios']['fecha'], 'fecha'); ?>
				</td>
				<td>
					<?php echo $f2['Asentamiento']['nombre'] ?>
				</td>
				<td>
					<?php echo $f2['Compania']['nombre'] ?>
				</td>
				<td>
					<?php echo $f2['Comite']['nombre'] ?>
				</td>
				<td>
					<?php echo $f2['User']['nombre'] ?>
				</td>
				<td>
					<?php echo $f2['f2_formularios']['created'] ?>
				</td>
			</tr>
	<?php
		}
	?>
</table>
