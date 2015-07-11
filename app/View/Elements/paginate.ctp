<div class="paging">
		<ul class="pagination">
			<?php echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));?>
		  	<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));?>
			<?php echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));?>
		</ul>
		<br />
		<?php echo $this->Paginator->counter(array(
		    		'format' => '<small>Pagina %page% de %pages%, mostrando %current% registros de
		             %count%, comenzado en el %start%, terminando en %end%</small>'
		)); ?>
</div>