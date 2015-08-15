<?php echo $this->Html->script('util.js') ?>
<div class="row" id="modal-div">
    <div id="source-modal" class="modal fade in" aria-hidden="false" style="display: block;">
        <?php echo $this->element('../Productors/modal_add'); ?>
    </div>  
</div>

<div class="row" id="modal-edit-div">
    <div id="source-edit-modal" class="modal fade in" aria-hidden="false" style="display: block;">
        <?php echo $this->element('../formulariosF3/modal_edit'); ?>
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
                        <th>Superficie finca</th>
                        <th>Actividad que desarrolla</th>
                        <th>Codigo exclusion</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" id="t-nombre"></td>
                        <td><input type="text" class="form-control" id="t-ci"></td>
                        <td><input type="text" class="form-control" id="t-supfinca" name="data[FormulariosF3Detalle][superficie_finca]"></td>
                        
                        <td>
                            <select class="form-control" id="s-actividad" name="data[FormulariosF3Detalle][actividad_id]">
                            </select>
                        </td>
                        
                        <td><input type="text" class="form-control" id="t-codexcl" name="data[FormulariosF3Detalle][codigo_exclusion]"></td>
                        
                        <td><input type="button" class="btn btn-primary" id="b-agregar-detalle" value="Guardar">
                            
                        <input type="hidden" class="form-control" id="t-hid-cabecera" name="data[FormulariosF3Detalle][formulario_id]">
                        <input type="hidden" class="form-control" id="t-hid-productor" name="data[FormulariosF3Detalle][productor_id]">
                        </td>
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
                        <th>Nombre y Apellido</th>
                        <th>C.I. Titular</th>
                        <th>Sup. finca</th>
                        <th>Actividad que desarrolla</th>
                        <th>Cod. exclusion</th>
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

    var mapDetallesF3 = new Map();
    var detalleSelect = new Object();

    $(document).ready(function () {
        
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
                            String.format("<option value={0}>{1}</option>", acti.id, acti.nombre);
                    $("#s-actividad").append(option);
                }
            }
        });
        
        
        
        disabledInputElement("#t-detalle", true);
        $("#b-agregar-detalle").click(function () {
            bindAddEvent();
        });
    });

    /**
     * Crea un detalleF1
     */
    function bindAddEvent(){
        
        var empty = $("#detalle").find("input").filter(function () {
            return this.value === "";
        });
        
        if (empty.length) {
            alert('Todos los campos son obligatorios');
            return;
        }
        
        var ob = new Object();
        var dataForm = $('#t-detalle').find(':input').serialize();
        var url = "<?php
            echo $this->
            Html->url(
                    array("controller" => "formulariosF3", "action" => "addDetail"))?>";
        
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: dataForm,
            url: url,
            success: function (data) {

                if (data["status"] == "error") {
                    alert('error al guardar el detalle:'.data['message']);
                }
                ob.id = data["message"];
            }
        });
        
       

        var tr = $('#t-detalle tr:last');
        ob.ci = tr.find('input[id=t-ci]').val();
        ob.nombre = tr.find('input[id=t-nombre]').val();
        ob.finca = tr.find('input[id=t-supfinca]').val();
        ob.actividad = tr.find('select[id=s-actividad]').val();

        ob.exclusion = tr.find('input[id=t-codexcl]').val();
        

        
        mapDetallesF3.set(ob.ci, ob);
        var row = String.format
                ('<tr rel={0}>\n\
                    <td>{1}</td>\n\
                    <td class="numeric">{2}</td>\n\
                    <td rel="finca" class="numeric">{3}</td>\n\
                    <td rel="actividad" class="numeric">{4}</td>\n\
                    <td rel="exclusion" class="numeric">{5}</td>\n\
                ', ob.ci, ob.nombre, ob.ci, ob.finca,
                        ob.actividad, ob.exclusion);

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
    }

    function bindDetailEvents() {
        $('button.eliminar').unbind('click');
        $('button.eliminar').click(function () {
            if (confirm('Desea eliminar este registro?')) {
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $this->Html->url(array("controller" => "formulariosF3", "action" => "deleteDetail")); ?>',
                    data: 'id=' + mapDetallesF3.get($(this).attr('rel')).id,
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
            loadForm(mapDetallesF3.get($(this).attr('rel')));
        });
    }
    
    function borrarCamposDetalle() {
        $("#t-detalle").find("input[type!=hidden] ").not("input[type=button]").val('');
        $("#t-detalle").find("select").val('');
    }

</script>
