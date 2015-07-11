<span class="options">
	<a href="<?php echo $this->Html->url(array('action'=>'edit', $f1['f1_formularios']['id'])); ?>" class="btn btn-primary">Editar</a>
	<a href="<?php echo $this->Html->url(array('action'=>'export', $f1['f1_formularios']['id'])); ?>" class="btn btn-primary">Exportar</a>
	<a href="<?php echo $this->Html->url(array('action'=>'delete', $f1['f1_formularios']['id'])); ?>" class="btn btn-danger">Eliminar</a>
</span>
<hr />
<table class="table table-striped">
	<tr>		
		<th>C. I.</th>
		<th>Productor</th>
		<th>Cod. Exclusion</th>
		<th>Sup. Finca</th>
		<th>Sup. Cultivo</th>
		<th>Total Contratados</th>
		<th>Bovinos</th>
		<th>Porcinos</th>
		<th>Aves</th>
	</tr>
	<?php 
		$totales['superficie_finca'] = 0;
		$totales['superficie_cultivo'] = 0;
		$totales['total_contratados']= 0;
		$totales['bovinos']= 0;
		$totales['porcinos']= 0;
		$totales['aves']= 0;
		foreach ($f1['FormulariosF1Detalle'] as $detalle) { ?>
			<tr>
				<td><?php echo $detalle['Productor']['cedula'] ?></td>
				<td><?php echo $detalle['Productor']['nombre'] ?></td>
				<td class="numeric"><?php echo $detalle['codigo_exclusion'] ?></td>
				<td class="numeric"><?php echo $detalle['superficie_finca'] ?></td>
				<td class="numeric"><?php echo $detalle['superficie_cultivo'] ?></td>
				<td class="numeric"><?php echo $detalle['total_contratados'] ?></td>
				<td class="numeric"><?php echo $detalle['bovinos'] ?></td>
				<td class="numeric"><?php echo $detalle['porcinos'] ?></td>
				<td class="numeric"><?php echo $detalle['aves'] ?></td>
			</tr>
	<?php 
			$totales['superficie_finca'] += $detalle['superficie_finca'];
			$totales['superficie_cultivo'] += $detalle['superficie_cultivo'];
			$totales['total_contratados'] += $detalle['total_contratados'];
			$totales['bovinos'] += $detalle['bovinos'];
			$totales['porcinos'] += $detalle['porcinos'];
			$totales['aves'] += $detalle['aves'];
		} ?>
	<tr>
		<td colspan="3">
			<strong>Totales:</strong>
		</td>
		<td class="numeric">
			<strong><?php echo $totales['superficie_finca'] ?></strong>
		</td>
		<td class="numeric">
			<strong><?php echo $totales['superficie_cultivo'] ?></strong>
		</td>
		<td class="numeric">
			<strong><?php echo $totales['total_contratados'] ?></strong>
		</td>
		<td class="numeric">
			<strong><?php echo $totales['bovinos'] ?></strong>
		</td>
		<td class="numeric">
			<strong><?php echo $totales['porcinos'] ?></strong>
		</td>
		<td class="numeric">
			<strong><?php echo $totales['aves'] ?></strong>
		</td>
	</tr>
</table>