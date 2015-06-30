<form method="get" class="vertical-form" action="<?php echo $this->Html->url(array('action'=>'index')) ?>">
	<label for="desde">Desde:</label>
    <input type="date" class="form-control" name="desde">
    <br />
    <label for="desde">Hasta:</label>
    <input type="date" class="form-control" name="hasta">
    <br />
    <label for="usuario">Departamento:</label>
	<select name = "lugar" class="form-control">
		<option value="">- Todos -</option>
	</select>
	<br />
	<label for="usuario">Lugar Sensado:</label>
	<select name = "lugar" class="form-control">
		<option value="">- Todos -</option>
	</select>
	<br />
    <label for="encuestador">Encuestador:</label>
	<select name = "encuestador" class="form-control">
		<option value="">- Todos -</option>
	</select>
	<br />
	<label for="usuario">Usuario:</label>
	<select name = "usuario" class="form-control">
		<option value="">- Todos -</option>
	</select>
	<br />
	<label for="lineas">Lineas por pagina</label>
	<input type="numeric" name='lineas' class="form-control" value="<?php echo empty($_GET['lineas'])?25:$_GET['lineas'] ?>">
	<br />
	<input type="submit" value="Filtrar" class="btn btn-primary btn-md btn-block">
</form>