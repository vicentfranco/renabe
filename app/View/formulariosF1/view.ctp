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
		<th>Sup. Finca</th>
		<th>Sup. Cultivo</th>
		<th>Total Contratados</th>
		<th>Bovinos</th>
		<th>Porcinos</th>
		<th>Aves</th>
		<th>Cod. Exclusion</th>
	</tr>
	<?php foreach ($f1['FormulariosF1Detalle'] as $detalle) { ?>
			<tr>
				<td><?php echo $detalle['Productor']['cedula'] ?></td>
				<td><?php echo $detalle['Productor']['nombre'] ?></td>
				<td class="numeric"><?php echo $detalle['superficie_finca'] ?></td>
				<td class="numeric"><?php echo $detalle['superficie_cultivo'] ?></td>
				<td class="numeric"><?php echo $detalle['total_contratados'] ?></td>
				<td class="numeric"><?php echo $detalle['bovinos'] ?></td>
				<td class="numeric"><?php echo $detalle['porcinos'] ?></td>
				<td class="numeric"><?php echo $detalle['aves'] ?></td>
				<td class="numeric"><?php echo $detalle['codigo_exclusion'] ?></td>
			</tr>
	<?php } ?>
</table>