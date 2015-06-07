




<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                    <tr>
                        <th>Orden</th>
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
                    </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" id="t-orden"></td>
                    <td><input type="text" class="form-control" id="t-nombre"></td>
                    <td><input type="text" class="form-control" id="t-ci"></td>
                    <td><input type="text" class="form-control" id="t-cantfamilia"></td>
                    <td><input type="text" class="form-control" id="t-supfinca" name="data[FormularioF1][superficie_finca]"></td>
                    <td><input type="text" class="form-control" id="t-supcultivo" name="data[FormularioF1][superficie_cultivo]"></td>
                    <td><input type="text" class="form-control" id="t-totcontra" name="data[FormularioF1][total_contratados]"></td>
                    <td><input type="text" class="form-control" id="t-cantganado" name="data[FormularioF1][bovino]"></td>
                    <td><input type="text" class="form-control" id="t-cantporcino" name="data[FormularioF1][porcino]"></td>
                    <td><input type="text" class="form-control" id="t-cantaves" name="data[FormularioF1][aves]"></td>
                    <td><input type="text" class="form-control" id="t-codexcl" name="data[FormularioF1][codigo_exclusion]"></td>
                    <td><input type="hidden" class="form-control" id="t-hid-cabecera" name="data[FormularioF1][formulario_id]"></td>
                    <td><input type="hidden" class="form-control" id="t-hid-productor" name="data[FormularioF1][productor_id]"></td>
                </tr>
                </tbody>
        </table>

    </div>
</div>


<script>


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
                        $("#b-agregar").fadeIn(300);
                    }
                });

        });
    
        $("#b-agregar").click(function(){
            $("#t-nombre").val(productor["nombre"]);
            $("#t-id-prod").val(productor["id"]);
            $("#t-ci").val(productor["cedula"]);
            $("#t-cantfamilia").val(productor["cantFamilia"]);
        
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
                var url = "<?php echo $this->
                    Html->url(array("controller"=>"formulariosF1", "action"=>"addHeader"))?>";
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: dataForm,
                    url: url,
                    success: function(data){
                        alert(data);
                        if(data["status"] == "OK"){
                            $("#t-hid-cabecera").val(data['id']);
                        }else{
                            alert('error al guardar la cabecera');
                        }
                    }
                });
                
                $("#cabecera :input").attr("disabled", true);
                $("#b-agregarcabecera").html("Modificar datos");
            }
        });
    
});

</script>
