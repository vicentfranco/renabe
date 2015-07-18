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
                        <td><input type="text" class="form-control" id="t-totcontra" name="data[FormulariosF2Detalle][total_contratados]"></td>
                        <td><input type="radio" class="form-control" name="data[FormulariosF2Detalle][zonda_id]" id="ck-indigena" ></td>
                        <td><input type="radio" class="form-control" name="data[FormulariosF2Detalle][zonda_id]" id="ck-urbana" ></td>
                        <td><input type="radio" class="form-control" name="data[FormulariosF2Detalle][zonda_id]" id="ck-periurbana" ></td>
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

    var mapDetallesF2 = new Map();
    var detalleSelect = new Object();

    $(document).ready(function () {
        
        disabledInputElement("#t-detalle", true);
        $("#b-agregar-detalle").click(function () {
            bindAddEvent();
        });
    });

    /**
     * Crea un detalleF2
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
        ob.finca = tr.find('input[id=t-supfinca]').val();
        ob.cultivo = tr.find('input[id=t-supcultivo]').val();
        ob.contratados = tr.find('input[id=t-totcontra]').val();
        ob.bovinos = tr.find('input[id=t-cantganado]').val();
        ob.porcinos = tr.find('input[id=t-cantporcino]').val();
        ob.aves = tr.find('input[id=t-cantaves]').val();
        ob.exclusion = tr.find('input[id=t-codexcl]').val();
        mapDetallesF2.set(ob.ci, ob);
        var row = String.format
                ('<tr rel={0}>\n\
                    <td>{1}</td>\n\
                    <td class="numeric">{2}</td>\n\
                    <td class="numeric">{3}</td>\n\
                    <td rel="finca" class="numeric">{4}</td>\n\
                    <td rel="cultivo" class="numeric">{5}</td>\n\
                    <td rel="contratados" class="numeric">{6}</td>\n\
                    <td rel="bovinos" class="numeric">{7}</td>\n\
                    <td rel="porcinos" class="numeric">{8}</td>\n\
                    <td rel="aves" class="numeric">{9}</td>\n\
                    <td rel="exclusion" class="numeric">{10}</td>\n\
                ', ob.ci, ob.nombre, ob.ci, ob.familia, ob.finca, ob.cultivo,
                        ob.contratados, ob.bovinos, ob.porcinos,
                        ob.aves, ob.exclusion);

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
    }

</script>
