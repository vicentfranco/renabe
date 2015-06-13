<div class="row" id="modal-div">
    <div id="source-modal" class="modal fade in" aria-hidden="false" style="display: block;">
        <?php echo $this->element('../Productors/modal_add'); ?>
    </div>  
    
</div>
<div class="row" id="modal-div">
    <div id="source-modal" class="modal fade in" aria-hidden="false" style="display: block;">
        <?php echo $this->element('../FormulariosF1Detalle/modals_edit'); ?>
    </div>  
    
</div>
<div class="row">
    
    <div class="col-lg-12" id="detalle">
        <form id="f-detalle">
            <table class="table table-striped" id="t-detalle">
                <thead>
                        <tr>
                            <th>Nombre y Apellido del titular</th>
                            <th>C.I. Titular</th>
                            <th>Total miembros familia</th>
                            <th>Superficie finca</th>
                            <th>Superficie cultivos</th>
                            <th>Total contratados</th>
                            <th>Cantidad ganado bovino</th>
                            <th>Cantidad porcino</th>
                            <th>Cantidad aves</th>
                            <th>Codigo exclusion</th>
                            <th>&nbsp;</th>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" id="t-nombre"></td>
                        <td><input type="text" class="form-control" id="t-ci"></td>
                        <td><input type="text" class="form-control" id="t-cantfamilia"></td>
                        <td><input type="text" class="form-control" id="t-supfinca" name="data[FormulariosF1Detalle][superficie_finca]"></td>
                        <td><input type="text" class="form-control" id="t-supcultivo" name="data[FormulariosF1Detalle][superficie_cultivo]"></td>
                        <td><input type="text" class="form-control" id="t-totcontra" name="data[FormulariosF1Detalle][total_contratados]"></td>
                        <td><input type="text" class="form-control" id="t-cantganado" name="data[FormulariosF1Detalle][bovinos]"></td>
                        <td><input type="text" class="form-control" id="t-cantporcino" name="data[FormulariosF1Detalle][porcinos]"></td>
                        <td><input type="text" class="form-control" id="t-cantaves" name="data[FormulariosF1Detalle][aves]"></td>
                        <td><input type="text" class="form-control" id="t-codexcl" name="data[FormulariosF1Detalle][codigo_exclusion]"></td>
                        <td><input type="button" class="btn btn-primary" id="b-agregar-detalle" value="Guardar">
                        <input type="hidden" class="form-control" id="t-hid-cabecera" name="data[FormulariosF1Detalle][formulario_id]">
                        <input type="hidden" class="form-control" id="t-hid-productor" name="data[FormulariosF1Detalle][productor_id]"></td>
                        
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
 
</div>

<div class="row">

    <div class="col-lg-12" id="detalle">
        <form id="f-detalle">
            <table class="table table-striped" id="t-list">
                <thead>
                        <tr>
                            <th>Nombre y Apellido</th>
                            <th>C.I. Titular</th>
                            <th>Total miembros familia</th>
                            <th>Sup. finca</th>
                            <th>Sup. cultivos</th>
                            <th>Contratados</th>
                            <th>Cant. ganado bovino</th>
                            <th>Cant. porcino</th>
                            <th>Cant. aves</th>
                            <th>Cod. exclusion</th>
                            <th>&nbsp;</th>
                        </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>
    </div>
 
</div>
<script>

    var mapDetallesF1 = new Map();

String.format = function() {
    // The string containing the format items (e.g. "{0}")
    // will and always has to be the first argument.
    var theString = arguments[0];
    
    // start with the second argument (i = 1)
    for (var i = 1; i < arguments.length; i++) {
        // "gm" = RegEx options for Global search (more than one instance)
        // and for Multiline search
        var regEx = new RegExp("\\{" + (i - 1) + "\\}", "gm");
        theString = theString.replace(regEx, arguments[i]);
    }
    
    return theString;
}

var productor = null;
$(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller"=>"users", "action"=>"encuestadores"))?>",
            success: function(data){
                 $("#s-encuestador").append("<option></option>");
                for(var i in data){
                    var encue = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", encue.id, encue.nombre);
                    $("#s-encuestador").append(option);
                }
        }
        });
        
        
        $("#s-departamento").focus();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller"=>"departamentos", "action"=>"index"))?>",
            success: function(data){
                 $("#s-departamento").append("<option></option>");
                for(var i in data){
                    var depar = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", depar.id, depar.nombre);
                    $("#s-departamento").append(option);
                }
        }
        });
        
        $("#s-departamento").change(function(){
            var selected = $("#s-departamento").val();
            
            $("#s-distrito option").remove();
            $("#s-distrito").append("<option></option>");
            var urls ="<?php echo $this->Html->url(array("controller"=>"distritos", "action"=>"view"))?>"+"/"+selected ;
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: urls,
                success: function(data){
                    for(var i in data){
                        var distri = data[i];
                        var option =  String.format("<option value={0}>{1}</option>", distri.id, distri.nombre);
                        $("#s-distrito").append(option);
                    }
                }
            });
            
        });
        
        $("#s-distrito").change(function(){
            var selected = $("#s-distrito").val();
            $("#s-compania option").remove();
            $("#s-comite option").remove();
            $("#s-asentamiento option").remove();
            
            $("#s-asentamiento").append("<option></option>");
            $("#s-compania").append("<option></option>");
            $("#s-comite").append("<option></option>");
            
            var url_compania ="<?php echo $this->
                    Html->url(array("controller"=>"companias", "action"=>"view"))?>"+"/"+selected;
                                
            var url_comite ="<?php echo $this->
                    Html->url(array("controller"=>"comites", "action"=>"view"))?>"+"/"+selected;
            
            var urls_asentamientos ="<?php echo $this->
                    Html->url(array("controller"=>"asentamientos", "action"=>"view"))?>"+"/"+selected;            
            
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: url_compania,
                success: function(data){
                    for(var i in data){
                        var compa = data[i];
                        var option =  String.
                                format("<option value={0}>{1}</option>",compa.id, compa.nombre);
                        $("#s-compania").append(option);
                    }
                }
            });
            
            
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: urls_asentamientos,
                success: function(data){
                    for(var i in data){
                        var asent = data[i];
                        var option =  String.
                                format("<option value={0}>{1}</option>",asent.id, asent.nombre);
                        $("#s-asentamiento").append(option);
                    }
                }
            });
            
            
            
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: url_comite,
                success: function(data){
                    for(var i in data){
                        var comi = data[i];
                        var option =  String.
                                format("<option value={0}>{1}</option>",comi.id, comi.nombre);
                        $("#s-comite").append(option);
                    }
                }
            });   
        });
        
        
        
        $("#b-agregar").hide();
        $('#b-aproductor').hide();
            var p = {};
            $("#b-search").click(function(){
                $('#tb-buscador tr').remove();
                if(!$("#t-cedula-s").val()){
                    alert ('cedula no puede ser nulo');
                    return;
                }
                var valueCI = $("#t-cedula-s").val();
                
                
                var urls ="<?php echo $this->
                    Html->url(array("controller"=>"productores", "action"=>"search"))?>"+"/"+valueCI;
                
                
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: urls,
                    success: function(data){
                        productor = data;
                        for(var key in data){
                           if (data.hasOwnProperty(key)) {
                               if(key == 'id'){
                                   continue;
                               }
                               var table = String.format("<tr><td>{0}</td><td>{1}</td></tr>", key, data[key]);
                               $('#tb-buscador').append(table);
                            }
                        }
                        
                        if(typeof data['cedula'] != 'undefined'){
                            $("#b-agregar").fadeIn(300);
                            $("#b-eproductor").fadeIn(300);
                        }else{
                            $("#error-buscador").append("<strong>No se encontro información del productor, haga click en el boton de abajo para agregar</strong>");
                            $("#error-buscador").show();
                            $("#b-aproductor").fadeIn(300);
                        }
                    }
                });
        });
    
        $("#b-agregar").click(function(){
            $("#t-nombre").val(productor["nombre"]);
            $("#t-ci").val(productor["cedula"]);
            $("#t-cantfamilia").val(productor["cantFamilia"]);
            $("#t-hid-productor").val(productor['id']);
        
        });
    
        $("#b-agregarcabecera").click(function(){
            if($("#cabecera :input").is('[disabled=disabled]')){
                $("#cabecera :input").attr("disabled", false);
                $("#b-agregarcabecera").html("Agregar Registros");
            }else{
               
                var empty = $("#cabecera").find("input").filter(function() {
                    return this.value === "";
                });
                if(empty.length) {
                    alert('Todos los campos son obligatorios');
                    return;
                }
          
                var dataForm = $('#f-cabecera').serialize();
                
                if ($("#t-hid-edit-cabecera").length != 0){
                    dataForm = dataForm.concat("&data[FormularioF1][id]="+$("#t-hid-edit-cabecera").val() );
                }
                
                var url = "<?php echo $this->
                    Html->url(array("controller"=>"formulariosF1", "action"=>"addHeader"))?>";
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: dataForm,
                    url: url,
                    success: function(data){
                        if(data["status"] == "ok"){
                            $("#t-hid-cabecera").val(data['message']);
                            $("#t-hid-edit-cabecera").val(data['message']);
                        }else{
                            alert('error al guardar la cabecera');
                        }
                    }
                });
                
                $("#cabecera :input").attr("disabled", true);
                $("#b-agregarcabecera").html("Modificar datos");
            }
        });
        
        $("#b-agregar-detalle").click(function(){
            var empty = $("#detalle").find("input").filter(function() {
                    return this.value === "";
                });
            if(empty.length) {
                alert('Todos los campos son obligatorios');
                return;
            }
            var ob = new Object();
            
            var dataForm = $('#t-detalle :input').serialize();
            var url = "<?php echo $this->
                Html->url(array("controller"=>"formulariosF1", "action"=>"addDetail"))?>";
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: dataForm,
                url: url,
                success: function(data){

                    if(data["status"] == "error"){
                        alert('error al guardar la cabecera:'. data['message']);
                    }
                    ob.id = data["message"];
                }
            });
            var tr = $('#t-detalle tr:last');
            
            ob.ci = tr.find('input[id=t-ci]').val();
            ob.nombre = tr.find('input[id=t-nombre]').val();
            ob.familia = tr.find('input[id=t-cantfamilia]').val();
            ob.finca = tr.find('input[id=t-supfinca]').val();
            ob.cultivo = tr.find('input[id=t-supcultivo]').val();
            ob.contratados = tr.find('input[id=t-totcontra]').val();
            ob.bovinos = tr.find('input[id=t-cantganado]').val();
            ob.porcinos = tr.find('input[id=t-cantporcino]').val();
            ob.aves = tr.find('input[id=t-cantaves]').val();
            ob.exclusion = tr.find('input[id=t-codexcl]').val();
            mapDetallesF1.set(ob.ci, ob);

            var row = String.format
                ("<tr>\n\
                    <td>{0}</td>\n\
                    <td>{1}</td>\n\
                    <td>{2}</td>\n\
                    <td>{3}</td>\n\
                    <td>{4}</td>\n\
                    <td>{5}</td>\n\
                    <td>{6}</td>\n\
                    <td>{7}</td>\n\
                    <td>{8}</td>\n\
                    <td>{9}</td>\n\
                ", ob.nombre, ob.ci, ob.familia, ob.finca, ob.cultivo,
                                ob.contratados, ob.bovinos, ob.porcinos,
                                ob.aves, ob.exclusion);
                var tdoptions = 
            '<td><button type="button" class="btn btn-primary btn-sm" aria-label="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar" rel="'+ob.ci+'"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td><td><button type="button" class="btn btn-danger btn-sm" aria-label="Eliminar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar" rel="'+ob.ci+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td></tr>';
            $("#t-list  tbody").append(row+tdoptions);
        });
        
        
        
        
    
});

</script>
