<div class="paging">
		<ul class="pagination pagination-sm">
			<?php echo $this->Paginator->prev('<< ', array(), null, array('class'=>'disabled'));?>
		  	<?php echo $this->Paginator->numbers();?>
			<?php echo $this->Paginator->next(' >>', array(), null, array('class' => 'disabled'));?>
		</ul>
		<br />
		<?php echo $this->Paginator->counter(array(
		    		'format' => '<small>Pagina %page% de %pages%, mostrando %current% registros de
		             %count%, comenzado en el %start%, terminando en %end%</small>'
		)); ?>
</div>