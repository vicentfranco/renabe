<div class="container" style="margin-top:40px">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong> Renabe</strong>
					</div>
					<div class="panel-body">
						<?php echo $this->Form->create('User', array('class'=>'horizontal-form')); ?>
							<fieldset>
								<div class="row">
									<div class="center-block">
										<img class="profile-img"
											src="../img/login.png" alt="">
									</div>
								</div>
								<?php if($this->Session->check('Message.flash')){ ?>
									<div class="alert alert-dismissible alert-danger">
									  <?php echo $this->Session->flash('auth'); ?>
									</div>
								<?php } ?>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										 <?php 
										 		echo '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>';
										 		echo $this->Form->input('username', array( 'class'=>'form-control', 'placeholder'=>'Usuario', 'type'=>'text', 'aoutofocus'=>true, 'label'=>false));
										 		echo '</div></br>';
										 		echo '<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>';
        										echo $this->Form->input('password', array('class'=>'form-control', 'placeholder'=>'Password', 'type'=>'password', 'label'=>false)); 
        										echo '</div></br>';
        								?>
										<input type="submit" value="Ingresar" class="center-block btn btn-primary">
									</div>
								</div>
							</fieldset>
					</div>
                </div>
			</div>
		</div>
	</div>