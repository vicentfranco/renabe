<div class="row">
    <div class="col-lg-12" id="cabecera">
        <form id="f-cabecera">
            <label for="s-departamento" >Departamento:</label>
            <select class="form-control" id="s-departamento">
                
            </select>
 
            <label for="s-distrito">Distrito:</label>
            <select class="form-control" id="s-distrito">
            </select>
            
            <label for="s-opcion-lugar">Tipo Lugar:</label>
            <select class="form-control" id="s-opcion-lugar">
                <option></option>
                <option id="comite">Comite</option>
                <option id="asentamiento">Asentamiento</option>
                <option id="compania">Compañia</option>
            </select>
            <br>

            <select class="form-control" id="s-lugar">
                
            </select>
            
            <label for="s-comite">Encuestador:</label>
            <select class="form-control" id="s-encuestador" name="data[FormularioF1][encuestador_id]">
            </select>
            
            
            <label for="s-carpeta">Carpeta:</label>
            <input type="text" class="form-control" id="t-carpeta" name="data[FormularioF1][carpeta_id]">
            
            <label>Periodo Agricola:</label>
            <label for="t-desde">Del 1 DE JULIO:</label>
            <input type="text" class="form-control" id="t-desde" name="data[FormularioF1][fecha_inicio]">
            <label for="t-hasta">Al 30 DE JUNIO:</label>
            <input type="text" class="form-control" id="t-hasta" name="data[FormularioF1][fecha_fin]">
            <label for="t-fecha">Fecha firma:</label>
            <input type="date" class="form-control" id="t-fecha" name="data[FormularioF1][fecha]">
            <label for="t-codigo">Código</label>
            <input type="text" class="form-control" id="t-codigo" name="data[FormularioF1][codigo]" />
            <br>
            
        </form>
    </div>
    <input type="hidden" id="t-hid-edit-cabecera" name="data[FormularioF1][id]">
    <button type="button" class="btn btn-primary" id="b-agregarcabecera">Agregar registros</button>
              
</div>
<script>
    
    $(document).ready(function(){
        
        $("#s-departamento").focus();
        $("#b-agregar").hide();
        
        /* LOS INPUT DE DETALLE Y BUSCADOR QUEDAN DESABILITADOS HASTA QUE SE CARGUE LA CABECERA*/


        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller" => "users", "action" => "encuestadores")) ?>",
            success: function (data) {
                $("#s-encuestador").append("<option></option>");
                for (var i in data) {
                    var encue = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", encue.id, encue.nombre);
                    $("#s-encuestador").append(option);
                }
            }
        });
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller" => "departamentos", "action" => "index")) ?>",
            success: function (data) {
                $("#s-departamento").append("<option></option>");
                for (var i in data) {
                    var depar = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", depar.id, depar.nombre);
                    $("#s-departamento").append(option);
                }
            }
        });
    });
    
    $("#s-departamento").change(function () {
            var selected = $("#s-departamento").val();

            $("#s-distrito option").remove();
            $("#s-distrito").append("<option></option>");
            var urls = "<?php echo $this->Html->url(array("controller" => "distritos", "action" => "view")) ?>" + "/" + selected;
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: urls,
                success: function (data) {
                    for (var i in data) {
                        var distri = data[i];
                        var option = String.format("<option value={0}>{1}</option>", distri.id, distri.nombre);
                        $("#s-distrito").append(option);
                    }
                }
            });
    });
        
    $("#s-opcion-lugar").change(function (){ 
        var selected = $("#s-opcion-lugar").val();
        var id = $("#s-distrito").val();
        var name = null;
        $("#s-lugar option").remove();

        var url = null;
        switch(selected){
            case "Asentamiento":
                url = "<?php
                    echo $this->
                    Html->url(array("controller" => "asentamientos", "action" => "view"))
                    ?>"+"/"+id;
                name = "data[FormularioF1][asentamiento_id]"
                break;
            case "Comite":
                url = "<?php
                    echo $this->
                    Html->url(array("controller" => "comites", "action" => "view"))
                    ?>"+"/"+id;
                name = "data[FormularioF1][comite_id]"
                break;
            case "Compañia":
                url = "<?php
                    echo $this->
                    Html->url(array("controller" => "companias", "action" => "view"))
                    ?>"+"/"+id;
                name = "data[FormularioF1][compania_id]"
                break;
            default:
                alert("no funciona");
        }
        $("#s-lugar").attr("name", name);   
        $("#s-lugar").append("<option></option>");
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: url,
            success: function (data) {
                for (var i in data) {
                    var compa = data[i];
                    var option = String.
                            format("<option value={0}>{1}</option>", compa.id, compa.nombre);
                    $("#s-lugar").append(option);
                }
            }
        });


    });


    $("#b-agregarcabecera").click(function () {

        if ($("#cabecera :input").is('[disabled=disabled]')) {

            $("#cabecera :input").attr("disabled", false);
            $("#b-agregarcabecera").html("Agregar Registros");
        } else {

            var empty = $("#cabecera").find("input").filter(function () {
                return this.value === "";
            });

            if (empty.length) {
                alert('Todos los campos son obligatorios');
                return;
            }

            var dataForm = $('#f-cabecera').serialize();

            if ($("#t-hid-edit-cabecera").length != 0) {
                dataForm = 
                        dataForm.concat("&data[FormularioF1][id]=" + 
                        $("#t-hid-edit-cabecera").val());
            }

            var url = "<?php
                echo $this->
                Html->url(array("controller" => "formulariosF1", "action" => "addHeader"))
                ?>";

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                url: url,
                success: function (data) {
                    if (data["status"] == "ok") {
                        $("#t-hid-cabecera").val(data['message']);
                        $("#t-hid-edit-cabecera").val(data['message']);
                        //HABILITAMOS EL BUSCADOR DE PRODUCTOR
                        disabledInputElement("#inp-buscador", false);
                        getFocus("#t-cedula-s");

                    } else {
                        alert('error al guardar la cabecera');
                    }
                }
            });

            $("#cabecera :input").attr("disabled", true);
            $("#b-agregarcabecera").html("Modificar datos");
        }
    });
        
</script>