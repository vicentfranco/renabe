<script type="text/javascript">
  $(document).ready(function(){
    $('#modal-edit-div').hide();
  });
  
  function loadForm(item){
    $('input#idDetail').val(item.id);
    $('input#supFinca').val(item.finca);
    $('input#supCultivo').val(item.cultivo);
    $('input#totalContratados').val(item.contratados);
    $('input#bovinos').val(item.bovinos);
    $('input#porcinos').val(item.porcinos);
    $('input#aves').val(item.aves);
    $('input#exclusion').val(item.exclusion);
  }

  
</script>

<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h4 class="modal-title"> Editar Detalle </h4>
    </div>
    <div class="modal-body">
      <?php echo $this->Form->create('FormularioF1Detalle', array('class'=>'horizontal-form')); ?>
        <fieldset>
          <?php 
          echo $this->Form->input('id', array('type'=>'hidden', 'name'=>'data[FormularioF1Detalle][id]', 'id'=>'idDetail'));
          echo $this->Form->input('sup_finca', array('type'=>'text', 'name'=>'data[FormularioF1Detalle][superficie_finca]', 'label'=>'Sup. Finca', 'id'=>'supFinca'));
          echo $this->Form->input('sup_cultivo', array('type'=>'text', 'name'=>'data[FormularioF1Detalle][superficie_cultivo]', 'label'=>'Sup. Cultivo', 'id'=>'supCultivo'));
          echo $this->Form->input('total_contratados', array('type'=>'text', 'name'=>'data[FormularioF1Detalle][total_contratados]', 'label'=>'Total Contratados', 'id'=>'totalContratados'));
          echo $this->Form->input('bovinos', array('type'=>'text', 'name'=>'data[FormularioF1Detalle][bovinos]', 'label'=>'Bovinos', 'id'=>'bovinos'));
          echo $this->Form->input('porcinos', array('type'=>'text', 'name'=>'data[FormularioF1Detalle][porcinos]', 'label'=>'Porcinos', 'id'=>'porcinos'));
          echo $this->Form->input('aves', array('type'=>'text', 'name'=>'data[FormularioF1Detalle][porcinos]', 'label'=>'Aves', 'id'=>'aves'));
          echo $this->Form->input('codigo', array('type'=>'text', 'name'=>'data[FormularioF1Detalle][codigo_exclusion]', 'label'=>'Codigo de Exclusion', 'id'=>'exclusion'));
          ?>
        </fieldset>
    </div>
    <div class="modal-footer">
      <div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong> Verifique los datos y vuelva a intentarlo
      </div>
      <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
      <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
