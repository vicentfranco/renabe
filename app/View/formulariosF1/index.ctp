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
			<?php echo $this->Paginator->sort('departamento_id', 'Departamento') ?>
		</th>
		<th colspan="2">
			Lugar Sensado
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
					<?php echo $f1['f1_formularios']['fecha'] ?>
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
	<?php
		}
	?>
</table>
