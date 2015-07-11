<div>
    <div class="row" id="inp-buscador">
        <div class="col-lg-12">
            <div class="form-group">
                <h4>Buscar Produtor:<h4>
                <input type="text" class="form-control" id="t-cedula-s" placeholder="Introduzca Cedula">
                <br>
                <input type="button" class="btn btn-primary" id ="b-search" value="Buscar">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped" id="tb-buscador">
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-dismissible alert-danger" id="error-buscador" style="display: none">
                
            </div>
            <button type="button" class="btn btn-primary" id="b-agregar">Agregar</button>
            <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Agregar productor" data-original-title="Agregar productor" id="b-aproductor">+</button>
            <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Agregar productor" data-original-title="Agregar productor" id="b-eproductor">Editar</button>
        </div>
    </div>
</div>
    
<script>
    
    var productor = null;
    
    $(document).ready(function(){
        
        disabledInputElement("#inp-buscador", true);
        $('#b-aproductor').hide();
         
        $("#b-search").click(function () {
            bindSearchProductor();
        });
        
        $("#t-cedula-s").keypress(function (e) {
            if (e.keyCode == 13) {
                bindSearchProductor();
            }
        });

        $("#b-agregar").click(function () {
            disabledInputElement("#t-detalle", false);
            addInfoProductorForm(productor["cedula"], productor["nombre"],
                productor["cantFamilia"], productor["id"]);
        });   
    });
    
    function bindSearchProductor() {
        $("#b-aproductor").hide();
        $("#b-eproductor").hide();
        $("#b-agregar").hide();
        $("#error-buscador strong").remove();
        $("#error-buscador").hide();
        
        if (!$("#t-cedula-s").val()) {
            alert('cedula no puede ser nulo');
            return;
        }
        var valueCI = $("#t-cedula-s").val();

        var urls = "<?php
        echo $this->
        Html->url(array("controller" => "productores", "action" => "search"))
        ?>" + "/" + valueCI;

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: urls,
            success: function (data) {
                addTableProductor(data);

                if (typeof data['cedula'] != 'undefined') {
                    $("#b-agregar").fadeIn(300);
                    $("#b-eproductor").fadeIn(300);
                    $('#b-agregar').focus();
                } else {
                    $("#error-buscador").append("<strong>No se encontro información del productor, haga click en el boton de abajo para agregar</strong>");
                    $("#error-buscador").show();
                    $("#b-aproductor").fadeIn(300);
                }
            }
        });
    }
    

    function addTableProductor(data) {
        productor = data;
        $('#tb-buscador tr').remove();
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                if (key == 'id') {
                    continue;
                }
                var table = String.format("<tr><td>{0}</td><td>{1}</td></tr>", key, data[key]);
                $('#tb-buscador').append(table);
            }
        }
    }
    
    function addInfoProductorForm(ci, nombre, cantF, id) {
        $("#t-nombre").val(nombre);
        $("#t-ci").val(ci);
        $("#t-cantfamilia").val(cantF);
        $("#t-hid-productor").val(id);
        $("#t-nombre, #t-ci, #t-cantfamilia").prop('disabled', true);
    }
    
</script> 