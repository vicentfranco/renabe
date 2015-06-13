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
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								 			<input name="data[User][username]" class="form-control" placeholder="Usuario" aoutofocus="1" type="text" id="UserUsername" required="required">
								 		</div>
									 	</br>
									 	<div class="input-group">
									 		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    										<input name="data[User][password]" class="form-control" placeholder="Password" type="password" id="UserPassword" required="required">
    									</div>
    									</br>
										<input type="submit" value="Ingresar" class="center-block btn btn-primary">
									</div>
								</div>
							</fieldset>
					</div>
                </div>
			</div>
		</div>
	</div>