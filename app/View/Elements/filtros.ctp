<?php echo $this->Html->script('util.js') ?>
<div id="f-d-filtro">
<form method="get" id="f-filtro" class="vertical-form">
    <label for="desde">Desde:</label>
    <input type="date" class="form-control" name="desde">
    <br />
    <label for="desde">Hasta:</label>
    <input type="date" class="form-control" name="hasta">
    <br />
    <label for="departamento">Departamento:</label>
    <select name ="departamento" class="form-control" id="s-f-departamento">
    </select>
    <br />
    <label for="lugar">Lugar Sensado:</label>
    <select name = "lugar" class="form-control">
    	<option value="">- Todos -</option>
    </select>
    <br />
    <label for="encuestador">Encuestador:</label>
    <select name = "encuestador" class="form-control" id="s-f-encuestador">
    </select>
    <br />
    <label for="usuario">Usuario:</label>
    <select name = "usuario" class="form-control" id="s-f-usuarios">
    </select>
    <br />
    <label for="lineas">Lineas por pagina</label>
    <input type="numeric" name='lineas' class="form-control" value="<?php echo empty($_GET['lineas'])?25:$_GET['lineas'] ?>">
    <br />
    <input type="button" value="Filtrar" class="btn btn-primary btn-md btn-block" id="sub-filtrar">
</form>
</div>

<script>
    $(document).ready(function(){
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller" => "users", "action" => "encuestadores")) ?>",
            success: function (data) {
                $("#s-f-encuestador").append("<option></option>");
                for (var i in data) {
                    var encue = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", encue.id, encue.nombre);
                    $("#s-f-encuestador").append(option);
                }
            }
        });
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller" => "departamentos", "action" => "index")) ?>",
            success: function (data) {
                $("#s-f-departamento").append("<option></option>");
                for (var i in data) {
                    var depar = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", depar.id, depar.nombre);
                    $("#s-f-departamento").append(option);
                }
            }
        });
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller" => "users", "action" => "usuarios")) ?>",
            success: function (data) {
                $("#s-f-usuarios").append("<option></option>");
                for (var i in data) {
                    var usu = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", usu.id, usu.nombre);
                    $("#s-f-usuarios").append(option);
                }
            }
        });
       
       
        $("#sub-filtrar").click(function(){
            var dataForm = $('#f-d-filtro').find(':input').serialize();
            $.ajax({
                type: "GET",
                dataType: "html",
                data : dataForm,
                url: "<?php echo $this->Html->url(array("action" => "index")) ?>",
                success: function (data) {
                   $("#d-content-index").html($(data).find("#d-content-index"));
                }
            });
            
        });
   
    });
    
    
    

</script>