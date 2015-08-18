
<div class="row">
    <div class="col-lg-12" id="cabecera">
        <form class="form-horizontal" id="f-cabecera">
            <div class="col-lg-6" >
                <div class="form-group">
                    <label for="s-departamento" class="col-lg-2 control-label">Departamento:</label>
                    <div class="col-lg-2">
                        <?php echo $this->Form->select('s-departamento', 
                                array($departamento), 
                                array('default' => $f1['Compania']['Distrito']['departamento_id'] ,'id'=>'s-departamento', 'class'=>'form-control')); ?>
                        
                    </div>

                    <label for="s-distrito" class="col-lg-2 control-label">Distrito:</label>
                    <div class="col-lg-2">
                        
                         <?php echo $this->Form->select('s-distrito', 
                                array($distrito), 
                                array('default' => $f1['Compania']['distrito_id'] ,'id'=>'s-campania', 'class'=>'form-control')); ?>
                      
                    </div>

                    
                    <label for="s-compania" class="col-lg-2 control-label">Compañia:</label>
                    <div class="col-lg-2">
                        <?php echo $this->Form->select('s-compania', 
                                array($compania), 
                                array('id'=>'s-campania', 'class'=>'form-control', 'default' => $f1['Compania']['id']  )); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="s-asentamiento" class="col-lg-2 control-label">Asentamiento:</label>
                    
                    <div class="col-lg-2">
                        <?php echo $this->Form->select('s-asentamiento', 
                                array($asentamiento), 
                                array('id'=>'s-asentamiento', 'class'=>'form-control', 'default'=>$f1['Asentamiento']['id'])); ?>
                    </div>
                    
                    <label for="s-comite" class="col-lg-2 control-label">Comite:</label>
                    
                    <div class="col-lg-2">
                        
                        <?php echo $this->Form->select('s-comite', 
                                array($comite), 
                                array('id'=>'s-comite', 'class'=>'form-control', 'default'=> $f1['Comite']['id'])); ?>
                    </div>
                    
                    <label for="s-encuestador" class="col-lg-2 control-label">Encuestador:</label>
                    <div class="col-lg-2">
                        <?php echo $this->Form->select('s-encuestador', 
                                array($encuestador), 
                                array('id'=>'s-encuestador', 'class'=>'form-control', 'default'=> $f1['Encuestador']['id'])); ?>
                                               
                    </div>
                    
                </div>
                
                
            </div>
            
            <div class="col-lg-6">
            
                <div class="form-group">
                
                    <label for="s-carpeta" class="col-lg-2 control-label">Carpeta:</label>
                    <div class="col-lg-2">
                        <input type="text" value="<?php echo $f1['f1_formularios']['carpeta_id']   ?>" class="form-control" id="t-carpeta" name="data[FormularioF1][carpeta_id]">
                    </div>
                    
                    <label for="t-fecha" class="col-lg-2 control-label">Fecha firma:</label>
                    <div class="col-lg-2">
                        
                        <input type="date" class="form-control" id="t-fecha" name="data[FormularioF1][fecha]" value="<?php echo new DateTime($f1['f1_formularios']['fecha'])   ?>">
                    </div>   

                    <label for="t-codigo" class="col-lg-2 control-label">Código</label>
                    <div class="col-lg-2">
                        <input type="text" class="form-control" id="t-codigo" name="data[FormularioF1][codigo]" value="<?php echo $f1['f1_formularios']['codigo']?>"/>
                    </div>
                    
                </div>
                
                <div class="form-group">
                <label class="col-lg-12 col-lg-offset-7">Periodo Agricola:</label>
                
                <label for="t-desde" class="col-lg-2 col-lg-offset-4 control-label">Del 1 DE JULIO:</label>
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="t-desde" name="data[FormularioF1][fecha_inicio]" value="<?php echo $f1['f1_formularios']['fecha_inicio']?>">
                </div>
                
                <label for="t-hasta" class="col-lg-2 control-label">Al 30 DE JUNIO:</label>
                
                <div class="col-lg-2">
                    <input type="text" class="form-control" id="t-hasta" name="data[FormularioF1][fecha_fin]" value="<?php echo $f1['f1_formularios']['fecha_fin']?>">
                </div>
                
            </div>
            
            </div>
            
        </form>
    </div>
    <input type="hidden" id="t-hid-edit-cabecera" name="data[FormularioF1][id]">
    <button type="button" class="btn btn-primary" id="b-agregarcabecera" style="float: right">Agregar registros</button>
              
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
       
    $("#s-distrito").change(function () {
            var selected = $("#s-distrito").val();

            $("#s-comite option").remove();
            $("#s-asentamiento option").remove();
            $("#s-compania option").remove();
            
            $("#s-comite").append("<option></option>");
            $("#s-asentamiento").append("<option></option>");
            $("#s-compania").append("<option></option>");
            
            var urlComite = "<?php echo $this->Html->url(array("controller" => "comites", "action" => "view")) ?>"+ "/" + selected;
            var urlCompania = "<?php echo $this->Html->url(array("controller" => "companias", "action" => "view")) ?>"+ "/" + selected;
            var urlAsentamientos = "<?php echo $this->Html->url(array("controller" => "asentamientos", "action" => "view")) ?>"+ "/" + selected;
            
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: urlComite,
                success: function (data) {
                    for (var i in data) {
                        var comite = data[i];
                        var option = String.format("<option value={0}>{1}</option>", comite.id, comite.nombre);
                        $("#s-comite").append(option);
                    }
                }
            });
            
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: urlAsentamientos,
                success: function (data) {
                    for (var i in data) {
                        var asent = data[i];
                        var option = String.format("<option value={0}>{1}</option>", asent.id, asent.nombre);
                        $("#s-asentamiento").append(option);
                    }
                }
            });
            
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: urlCompania,
                success: function (data) {
                    for (var i in data) {
                        var compa = data[i];
                        var option = String.format("<option value={0}>{1}</option>", compa.id, compa.nombre);
                        $("#s-compania").append(option);
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