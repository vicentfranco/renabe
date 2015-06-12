<script type="text/javascript">
  $('document').ready(function(){
      $('#source-modal, #b-eproductor').hide();
      $('.alert').hide();
      $('#b-aproductor').click(function(){
        $('#source-modal').fadeIn(200);
      });
      $('#b-eproductor').click(function(){
        $('#source-modal').fadeIn(200);
        rellenarCampos();
      });
      $('.close, .cerrar').click(function(){
        $('#source-modal').fadeOut(200);
      });

      bindGuardar();
  }); 

  function bindGuardar(){
    $('#guardar').click(function(){
      $('alert').hide();
      $.ajax({
        type: 'POST',
        dataType: 'json',
        data: $('#ProductorAddForm').serialize(),
        url: '<?php echo $this->Html->url(array('controller'=>'productores', 'action'=>'addProductor')); ?>',
        success: function(data){
          if(data.status = 'ok'){
            $('#source-modal').fadeOut(200);
          }else{
            $('alert').show();
          }
        }
      })
    });
  }

  function rellenarCampos(){
    $('#ProductorCedula').val(productor['cedula']);
    $('#ProductorNombre').val(productor['nombre']);
    $('#ProductorTotalFamiliares').val(productor['cantFamilia']);
    var input = '<input type ="hidden" name="data[Productor][id]" value="'+productor['id']+'">';
    $('#ProductorCedula').before(input);
  }
</script>
<!-- <div id="source-modal" class="modal fade in" aria-hidden="false" style="display: block;"> -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Agregar Productor</h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create('Productor', array('class'=>'horizontal-form')); ?>
          <fieldset>
            <?php 
            echo $this->Form->input('cedula', array('type'=>'text', 'name'=>'data[Productor][cedula]', 'label'=>'Cedula'));
            echo $this->Form->input('nombre', array('type'=>'text', 'name'=>'data[Productor][nombre]', 'label'=>'Nombre'));
            echo $this->Form->input('total_familiares', array('type'=>'text', 'name'=>'data[Productor][total_familiares]', 'label'=>'Total de Familiares'));
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
<!-- </div> -->
