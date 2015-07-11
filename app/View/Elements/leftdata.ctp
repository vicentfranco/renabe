<div class="index">
	<h6>Codigo:</h6>
	<h5><strong><?php echo $f1['f1_formularios']['codigo'] ?></strong></h5>
	<br />
	<h6>Fecha:</h6>
	<h5><strong><?php echo $this->Fx->format($f1['f1_formularios']['fecha'], 'fecha') ?></strong></h5>
	<br />
	<h6>Departamento:</h6>
	<h5><strong><?php echo $this->Fx->getDepartament($f1)['nombre'] ?></strong></h5>
	<br />
	<h6>Distrito:</h6>
	<h5><strong><?php echo $this->Fx->getDistrito($f1)['nombre']; ?></strong></h5>
	<br />
	<h6>Lugar sensado:</h6>
	<h5><strong><?php echo $this->Fx->renabeFormat($f1); ?></strong></h5>
	<br />
	<h6>Encuestador:</h6>
	<h5><strong><?php echo $f1['Encuestador']['nombre']; ?></strong></h5>
	<br />
	<h6>Usuario:</h6>
	<h5><strong><?php echo $f1['User']['nombre']; ?></strong></h5>
	<br />
	<h6>Fecha de Modifcación:</h6>
	<h5><strong><?php echo $f1['f1_formularios']['modified']; ?></strong></h5>
</div>