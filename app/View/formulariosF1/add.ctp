




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
                    <td><input type="text" class="form-control" id="t-supfinca"></td>
                    <td><input type="text" class="form-control" id="t-supcultivo"></td>
                    <td><input type="text" class="form-control" id="t-totcontra"></td>
                    <td><input type="text" class="form-control" id="t-cantganado"></td>
                    <td><input type="text" class="form-control" id="t-cantporcino"></td>
                    <td><input type="text" class="form-control" id="t-cantaves"></td>
                    <td><input type="text" class="form-control" id="t-codexcl"></td>
                </tr>
                </tbody>
        </table>

    </div>
</div>


<script>

var data = {
    "3942308": {
        "cedula" : "3942308",
        "nombre" : "vicente",
        "cantFamilia" : "5"
    }
}

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


$(document).ready(function(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller"=>"departamentos", "action"=>"index"))?>",
            success: function(data){
                 $("#s-departamento").append("<option></option>");
                for(var i in data){
                    var depar = data[i];
                    var option =  String.format("<option value={0}>{1}</option>", depar.id, depar.nombre);
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
            $("#s-compania").append("<option></option>");
            var urls ="<?php echo $this->
                    Html->url(array("controller"=>"companias", "action"=>"view"))?>"+"/"+selected;
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: urls,
                success: function(data){
                    for(var i in data){
                        var compa = data[i];
                        var option =  String.
                                format("<option value={0}>{1}</option>",compa.id, compa.nombre);
                        $("#s-compania").append(option);
                    }
                }
            });
        });
     
     
        
        $("#b-agregar").hide();
        var p = {};
       
        $("#b-search").click(function(){
            $('#tb-buscador tr').remove();
        var valueCI = $("#t-cedula-s").val();
        p = data[valueCI];
        
        for (var key in p) {
            if (p.hasOwnProperty(key)) {
                var table = String.format("<tr><td>{0}</td><td>{1}</td></tr>", key, p[key]);
               $('#tb-buscador').append(table);
            }
        }
        $("#b-agregar").fadeIn(300);
    });
    
    $("#b-agregar").click(function(){
        $("#t-nombre").val(p.nombre);
        $("#t-ci").val(p.cedula);
        $("#t-cantfamilia").val(p.cantFamilia);
    });
    
    
    
});

</script>
