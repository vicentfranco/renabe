<?php echo $this->Html->script('util.js') ?>
<div class="row" id="modal-div">
    <div id="source-modal" class="modal fade in" aria-hidden="false" style="display: block;">
        <?php echo $this->element('../Productors/modal_add'); ?>
    </div>  

</div>
<div class="row" id="modal-edit-div">
    <div id="source-edit-modal" class="modal fade in" aria-hidden="false" style="display: block;">
        <?php echo $this->element('../formulariosF2/modal_edit'); ?>
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
                        <th>Actividad</th>
                        <th class="key">C. Indigena</th>
                        <th class="key">Z. Urbana</th>
                        <th class="key">Z. Periurbana</th>
                        <th>Codigo exclusion</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" id="t-nombre"></td>
                        <td><input type="text" class="form-control" id="t-ci"></td>
                        <td><input type="text" class="form-control" id="t-cantfamilia"></td>
                        <td><select class="form-control" id="s-actividad" name="data[FormulariosF2Detalle][actividad_id]"></select></td>
                        <td><input type="radio" class="form-control" name="data[FormulariosF2Detalle][zona_id]" id="ck-indigena" value="1" ></td>
                        <td><input type="radio" class="form-control" name="data[FormulariosF2Detalle][zona_id]" id="ck-urbana" value="2"></td>
                        <td><input type="radio" class="form-control" name="data[FormulariosF2Detalle][zona_id]" id="ck-periurbana" value="3"></td>
                        <td><input type="text" class="form-control" id="t-codexcl" name="data[FormulariosF2Detalle][codigo_exclusion]"></td>
                        <td><input type="button" class="btn btn-primary" id="b-agregar-detalle" value="Guardar">
                            <input type="hidden" class="form-control" id="t-hid-cabecera" name="data[FormulariosF2Detalle][formulario_id]">
                            <input type="hidden" class="form-control" id="t-hid-productor" name="data[FormulariosF2Detalle][productor_id]"></td>

                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</div>

<div class="row">

    <div class="col-lg-12" id="detalle-tab">
        <form id="f-detalle-tab">
            <table class="table table-striped" id="t-list">
                <thead>
                    <tr>
                        <th>Nombre y Apellido del titular</th>
                        <th>C.I. Titular</th>
                        <th>Total miembros familia</th>
                        <th>Actividad</th>
                        <th class="key">C. Indigena</th>
                        <th class="key">Z. Urbana</th>
                        <th class="key">Z. Periurbana</th>
                        <th>Codigo exclusion</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>
    </div>

</div>
<script>

    var mapDetallesF2 = new Map();
    var detalleSelect = new Object();

    $(document).ready(function () {
        
        disabledInputElement("#t-detalle", true);
        $("#b-agregar-detalle").click(function () {
            bindAddEvent();
        });
        $("#s-actividad option").remove();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller" => "actividades", "action" => "index")) ?>",
            success: function (data) {
                $("#s-actividad").append("<option></option>");
                for (var i in data) {
                    var acti = data[i];
                    var option =
                            String.format("<option value={0} rel={1}>{1}</option>", acti.id, acti.nombre);
                    $("#s-actividad").append(option);
                }
            }
        });
    });

    /**
     * Crea un detalleF2
     */
    function bindAddEvent(){
        
        var empty = $("#detalle").find("input").not('input[type="radio"]').filter(function () {
            return this.value === "";
        });
        
        if (empty.length) {
            alert('Todos los campos son obligatorios');
            return;
        }
        
        var ob = new Object();
        var dataForm = $('#t-detalle :input').serialize();
        var url = "<?php
            echo $this->
            Html->url(
                    array("controller" => "formulariosF2", "action" => "addDetail"))?>";
        
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: dataForm,
            url: url,
            success: function (data) {

                if (data["status"] == "error") {
                    alert('error al guardar la cabecera:'.data['message']);
                }
                ob.id = data["message"];
            }
        });

        var tr = $('#t-detalle tr:last');
        ob.ci = tr.find('input[id=t-ci]').val();
        ob.nombre = tr.find('input[id=t-nombre]').val();
        ob.familia = tr.find('input[id=t-cantfamilia]').val();
        ob.actividad = tr.find('select[id=s-actividad] option:selected').attr('rel');
        ob.zona = tr.find('input[id=s-actividad]').val();
        ob.exclusion = tr.find('input[id=t-codexcl]').val();
        if($('input[id=ck-indigena]').is(':checked')){
            ob.indigena = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>';
        }else{
            ob.indigena = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
        }
        if($('input[id=ck-urbana]').is(':checked')){
            ob.urbana = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>';
        }else{
            ob.urbana = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
        }
        if($('input[id=ck-periurbana]').is(':checked')){
            ob.periurbana = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>';
        }else{
            ob.periurbana = '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>';
        }
        mapDetallesF2.set(ob.ci, ob);
        var row = String.format
                ('<tr rel={0}>\n\
                    <td>{1}</td>\n\
                    <td class="numeric">{2}</td>\n\
                    <td class="numeric">{3}</td>\n\
                    <td rel="actividad" class="numeric">{4}</td>\n\
                    <td rel="indigena" class="centered">{5}</td>\n\
                    <td rel="urbana" class="centered">{6}</td>\n\
                    <td rel="preiurbana" class="centered">{7}</td>\n\
                    <td rel="exclusion" class="numeric">{8}</td>\n\
                ',ob.ci, ob.nombre, ob.ci, ob.familia, ob.actividad, ob.indigena,
                        ob.urbana, ob.periurbana, ob.exclusion);

        var tdoptions =
                '<td><button type="button" class="btn btn-primary btn-sm editar" aria-label="Editar" \n\
            data-toggle="tooltip" data-placement="top" \n\
            title="" data-original-title="Editar" rel="' + ob.ci + '">\n\
            <span class="glyphicon glyphicon-pencil" aria-hidden="true">\n\
            </span></button></td><td><button type="button" \n\
            class="btn btn-danger btn-sm eliminar" aria-label="Eliminar" \n\
            data-toggle="tooltip" data-placement="top" title="" \n\
            data-original-title="Eliminar" rel="' + ob.ci + '">\n\
            <span class="glyphicon glyphicon-trash" aria-hidden="true">\n\
            </span></button></td></tr>';
        $("#t-list tbody").append(row + tdoptions);

        borrarCamposDetalle();
        bindDetailEvents();
        $('#t-cedula-s').focus();
    }

    function bindDetailEvents() {
        $('button.eliminar').unbind('click');
        $('button.eliminar').click(function () {
            if (confirm('Desea eliminar este registro?')) {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->Html->url(array("controller" => "formulariosF2", "action" => "deleteDetail")); ?>',
                    data: 'id=' + mapDetallesF2.get($(this).attr('rel')).id,
                    success: function (data) {
                        reply = eval('(' + data + ')');
                        if (reply.status == 'error') {
                            alert('Error al eliminar. Intente nuevamente');
                            return false;
                        }
                    }
                });
                $(this).parent().parent().remove();
            }
        });
        $('button.editar').unbind('click');
        $('button.editar').click(function () {
            $('#modal-edit-div').fadeIn(300);
            loadForm(mapDetallesF2.get($(this).attr('rel')));
        });
    }
    
    function borrarCamposDetalle() {
        $("#t-detalle").find("input[type!=hidden]").not("input[type=button]").val('');
        $("#t-detalle").find("input[type=radio]").attr('selected', false);
        $('#s-actividad').val('');
    }

</script>
