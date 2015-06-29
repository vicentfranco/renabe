<?php //print_r($f1); die(); ?>
<h3>F1 - Productores de la Agriculatura Familiar</h3>
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
			<?php echo $this->Paginator->sort('distrito_id', 'Distrito') ?>
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
		foreach ($f1 as $key=>$f1) {
	?>
			<tr>
				<td class="numeric key">
					<?php echo $this->Html->link($f1['f1_formularios']['id'], $this->Html->url(array('action'=>'view', $f1['f1_formularios']['id']))); ?>
				</td>
				<td>
					<?php echo $this->Html->link($f1['f1_formularios']['codigo'], $this->Html->url($f1['f1_formularios']['codigo'], array('action'=>'view', $f1['f1_formularios']['id']))) ?>
				</td>
				<td>
					<?php echo $this->Fx->format($f1['f1_formularios']['fecha'], 'fecha'); ?>
				</td>
				<td>
					<?php echo $f1['Asentamiento']['Distrito']['nombre'] ?>
				</td>
				<td>
					<?php 
						echo $this->Fx->renabeFormat($f1); 
					?>
				</td>
				<td>
					<?php echo $f1['User']['nombre'] ?>
				</td>
				<td>
					<?php echo $f1['f1_formularios']['created'] ?>
				</td>
			</tr>
	<?php
		}
	?>
</table>
