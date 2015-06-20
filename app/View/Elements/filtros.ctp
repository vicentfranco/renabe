
<?php echo $this->Form->create('User', array('class'=>'vertical-form')); ?>
	<label for="desde">Desde:</label>
    <input type="date" class="form-control" name="desde">
    <br />
    <label for="desde">Hasta:</label>
    <input type="date" class="form-control" name="hasta">
    <br />
    <label for="encuestador">Encuestador:</label>
	<select name = "encuestador" class="form-control">
		<option>- Todos -</option>
		<?php
			foreach ($encuestadores as $key => $encuestador) {
				echo $_GET['encuestador']==$encuestador[$key]?'<option value="'.$key.'" selected>':'<option>';
				echo $encuestador;
				echo '</option>';
			}
		?>
	</select>
	<br />
	<label for="usuario">Usuario:</label>
	<select name = "usuario" class="form-control">
		<option>- Todos -</option>
		<?php
			foreach ($usuario as $key => $usuario) {
				echo $_GET['usuario']==$usuario[$key]?'<option value="'.$key.'" selected>':'<option>';
				echo $usuario;
				echo '</option>';
			}
		?>
	</select>
	<br />
	<label for="lineas">Lineas por pagina</label>
	<input type="numeric" name='lineas' class="form-control" value="<?php echo empty($_GET['lineas'])?25:$_GET['lineas'] ?>">
	<br />
	<input type="submit" value="Filtrar" class="btn btn-primary btn-md btn-block">
</form>