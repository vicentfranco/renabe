<?php //print_r($f1); die(); ?>
<span class="options">
	<h3>F1 - Productores de la Agriculatura Familiar</h3>
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
					<?php echo $this->Html->link($f1['f1_formularios']['id'], array('controller'=>'formulariosF1', 'action'=>'view', $f1['f1_formularios']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($f1['f1_formularios']['codigo'], array('controller'=>'formulariosF1', 'action'=>'view', $f1['f1_formularios']['id'])) ?>
				</td>
				<td>
					<?php echo $this->Fx->format($f1['f1_formularios']['fecha'], 'fecha'); ?>
				</td>
				<td>
					<?php echo $f1['Asentamiento']['nombre'] ?>
				</td>
				<td>
					<?php echo $f1['Compania']['nombre'] ?>
				</td>
				<td>
					<?php echo $f1['Comite']['nombre'] ?>
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
<br />
<table class="table table-striped">
	<tr>
		<td colspan="2">
			<h5>Totales Generales</h5>
		</td>
	</tr>
	<tr>
		<td>
			<strong>
				Total de Superficie de Finca
			</strong>
		</td>	
		<td class="numeric">
			<strong>
				<?php echo $this->Fx->format($summary[0]['Summary']['superficie_finca'], 'numerico', array('decimales'=>2)); ?>
			</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>
				Total de Superficie de Cultivo
			</strong>
		</td>	
		<td class="numeric">
			<strong>
				<?php echo $this->Fx->format($summary[0]['Summary']['superficie_cultivo'], 'numerico', array('decimales'=>2)); ?>
			</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>
				Total de Contratados
			</strong>
		</td>	
		<td class="numeric">
			<strong>
				<?php echo $this->Fx->format($summary[0]['Summary']['total_contratados'], 'numerico', array('decimales'=>0)); ?>
			</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>
				Total de Superficie de Porcinos
			</strong>
		</td>	
		<td class="numeric">
			<strong>
				<?php echo $this->Fx->format($summary[0]['Summary']['porcinos'], 'numerico', array('decimales'=>0)); ?>
			</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>
				Total de Superficie de Aves
			</strong>
		</td>	
		<td class="numeric">
			<strong>
				<?php echo $this->Fx->format($summary[0]['Summary']['aves'], 'numerico', array('decimales'=>0)); ?>
			</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>
				Total de Superficie de bovinos
			</strong>
		</td>	
		<td class="numeric">
			<strong>
				<?php echo $this->Fx->format($summary[0]['Summary']['bovinos'], 'numerico', array('decimales'=>0)); ?>
			</strong>
		</td>
	</tr>
</table>