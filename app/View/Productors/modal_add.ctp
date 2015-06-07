<script type="text/javascript">
  $('document').ready(function(){
      $('#source-modal').hide();
      $('#b-aproductor').click(function(){
        $('#source-modal').fadeIn(200);
      });
      $('.close, .cerrar').click(function(){
        $('#source-modal').fadeOut(200);
      });
  }); 
</script>
<!-- <div id="source-modal" class="modal fade in" aria-hidden="false" style="display: block;"> -->
  <div class="modal-dialog">
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
        <button type="button" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
<!-- </div> -->
