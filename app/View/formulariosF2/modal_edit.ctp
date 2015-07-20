<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close cerrar" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"> Editar Detalle </h4>
        </div>
        <div class="modal-body editing">
            <?php echo $this->Form->create('FormulariosF1Detalle', array('class' => 'horizontal-form')); ?>
            <fieldset>
                <?php
                echo $this->Form->input('id', array('type' => 'hidden', 'name' => 'data[FormulariosF1Detalle][id]', 'id' => 'idDetail'));
                echo $this->Form->input('actividad', array('type'=>'select', 'name'=>'data[FormulariosF1Detalle][actividad_id]', 'id'=>'cb-mactividad'));
                ?>
                <br />
                    <input type="radio" class="form-control" name="data[FormulariosF2Detalle][zona_id]" id="ck-mindigena" value="1"><label for="data[FormulariosF2Detalle][zona_id]">Clan Indígena</label>
                <br />
                    <input type="radio" class="form-control" name="data[FormulariosF2Detalle][zona_id]" id="ck-murbana" value="2"><label for="data[FormulariosF2Detalle][zona_id]">Zona Urbana</label>
                <br />
                    <input type="radio" class="form-control" name="data[FormulariosF2Detalle][zona_id]" id="ck-mperiurbana" value="2"><label for="data[FormulariosF2Detalle][zona_id]">Zona Periurbana</label>
                <br />
                <?php
                echo $this->Form->input('codigo', array('type' => 'text', 'name' => 'data[FormulariosF1Detalle][codigo_exclusion]', 'label' => 'Codigo de Exclusion', 'id' => 'exclusion'));
                echo $this->Form->input('ci', array('type' => 'hidden', 'id' => 'ci-det'));
                ?>
            </fieldset>
        </div>
        <div class="modal-footer">
            <div class="alert medit alert-dismissible alert-danger">
                <strong>Error!</strong> Verifique los datos y vuelva a intentarlo
            </div>
            <button type="button" class="btn btn-primary b-edit" >Guardar</button>
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        bindSaveEditing();
        $('#modal-edit-div').hide();
        $('.medit').hide();
        $('.cerrar').click(function () {
            $('#modal-edit-div').fadeOut(300);
        });
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

    function loadForm(item) {
        $('input#idDetail').val(item.id);
        $('#cb-mactividad').val(item.zona_id);
        $('input#exclusion').val(item.exclusion);
        detalleSelect.ci = item.ci;
    }

    function bindSaveEditing() {
        $('.medit').fadeOut(300);
        $('button.b-edit').click(function () {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo $this->Html->url(array('controller' => 'formulariosF1', 'action' => 'addDetail')) ?>",
                data: $('.editing input').serialize(),
                success: function (data) {
                    if (data['status'] == 'ok') {
                        changeDetailsTable();
                        $('#modal-edit-div').fadeOut(300);
                    } else {
                        $('.medit').fadeIn(300);
                    }
                }
            });
        });
    }

    function changeDetailsTable() {
        var tablatr = $('#f-detalle-tab tbody tr[rel="' + detalleSelect.ci + '"]');
        alert(tablatr.html());
        var b = tablatr.find('td[rel="finca"]').html($("input#supFinca").val()).html();
        tablatr.find('td[rel="cultivo"]').html($("input#supCultivo").val());
        tablatr.find('td[rel="contratados"]').html($("input#totalContratados").val());
        tablatr.find('td[rel="bovinos"]').html($("input#bovinos").val());
        tablatr.find('td[rel="porcinos"]').html($("input#porcinos").val());
        tablatr.find('td[rel="aves"]').html($("input#aves").val());
        tablatr.find('td[rel="exclusion"]').html($("input#exclusion").val());
        mapDetallesF1.get(detalleSelect.ci).finca = $("input#supFinca").val();
        mapDetallesF1.get(detalleSelect.ci).cultivo = $("input#supCultivo").val();
        mapDetallesF1.get(detalleSelect.ci).contratados = $("input#totalContratados").val();
        mapDetallesF1.get(detalleSelect.ci).bovinos = $("input#bovinos").val();
        mapDetallesF1.get(detalleSelect.ci).porcinos = $("input#porcinos").val();
        mapDetallesF1.get(detalleSelect.ci).aves = $("input#aves").val();
        mapDetallesF1.get(detalleSelect.ci).exclusion = $("input#exclusion").val();
    }
    
</script>
