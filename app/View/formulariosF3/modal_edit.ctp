<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close cerrar" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"> Editar Detalle </h4>
        </div>
        
        <div class="modal-body" id="editing">
            <form id="f-edit-detalle">
                <fieldset>
                    <input type="hidden" name="data[FormulariosF3Detalle][id]" id="idDetail" class="form-control" >
                    <label for="supFinca">Sup. Finca</label>
                    <input type="text" name="data[FormulariosF3Detalle][superficie_finca]" id="supFinca" class="form-control" >
                    <label for="exclusion">Cod. Exclusion</label>
                    <input type="text" name="data[FormulariosF3Detalle][codigo_exclusion]" id="exclusion" class="form-control" >
                    <input type="hidden" id="ci-det" class="form-control">    
                    <label for="s-edit-actividad">Actividad que desarrolla</label>
                    <select id="s-edit-actividad" class="form-control" name="data[FormularioF3Detalle][actividad_id]">      
                    </select>
                </fieldset>
                
            </form>    
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
        
        $("#s-edit-actividad option").remove();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "<?php echo $this->Html->url(array("controller" => "actividades", "action" => "index")) ?>",
            success: function (data) {
                $("#s-edit-actividad").append("<option></option>");
                for (var i in data) {
                    var acti = data[i];
                    var option =
                            String.format("<option value={0}>{1}</option>", acti.id, acti.nombre);
                    $("#s-edit-actividad").append(option);
                }
            }
        });
        
        
        bindSaveEditing();
        $('#modal-edit-div').hide();
        $('.medit').hide();
        $('.cerrar').click(function () {
            $('#modal-edit-div').fadeOut(300);
        });
    });

    function loadForm(item) {
        $('input#idDetail').val(item.id);
        $('input#supFinca').val(item.finca);
        $('input#exclusion').val(item.exclusion);
        $('select#s-edit-actividad option:eq('+ item.actividad+')');
        detalleSelect.ci = item.ci;
    }

    function bindSaveEditing() {
        $('.medit').fadeOut(300);
        $('button.b-edit').click(function () {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo $this->Html->url(array('controller' => 'formulariosF3', 'action' => 'addDetail')) ?>",
                data: $('#editing').find('input', 'select').serialize(),
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

        var b = tablatr.find('td[rel="finca"]').html($("input#supFinca").val()).html();
        tablatr.find('td[rel="actividad"]').html($("select#s-edit-actividad").val());
        tablatr.find('td[rel="exclusion"]').html($("input#exclusion").val());
        mapDetallesF3.get(detalleSelect.ci).finca = $("input#supFinca").val();
      
        mapDetallesF3.get(detalleSelect.ci).actividad = $("select#s-edit-actividad").val();
        mapDetallesF3.get(detalleSelect.ci).exclusion = $("input#exclusion").val();
    }
    
</script>
