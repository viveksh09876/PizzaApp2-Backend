<div class="col-md-3"></div>
<div class="col-md-6">
<div class="box box-info admin-login">
    <!-- form start -->
    <div id="sign_in">
	    <div class="box-header with-border">
	      <h3 class="box-title"><i class="fa fa-fw fa-lock"></i> Admin Login</h3>
	    </div><!-- /.box-header -->
	    <?php echo $this->Form->create('Login',array('url'=>'/admin/logins/login','class'=>'form-horizontal'));?>
	      <div class="box-body">
	        <div class="form-group">
	          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
	          <div class="col-sm-10">
	          	<?php echo $this->Form->input('email',array('type'=>'email','class'=>'form-control','placeholder'=>'Email','label'=>false));?>
	          </div>
	        </div>
	        <div class="form-group">
	          <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
	          <div class="col-sm-10">
	          	<?php echo $this->Form->input('password',array('type'=>'password','class'=>'form-control','placeholder'=>'Password','label'=>false));?>
	          </div>
	        </div>
	        <div class="form-group">
	          <div class="col-sm-offset-2 col-sm-10">
	            <div class="checkbox">
	              <label>
	                <input type="checkbox"> Remember me
	              </label>
	            </div>
	          </div>
	          <div class="col-sm-offset-2 col-sm-10">
	          	<a href="javascript:void(0);" onclick="javascript:$('#sign_in').hide();$('#forgot_pass').show();">Forgot Password?</a>
	          </div>

	        </div>
	      </div><!-- /.box-body -->
	      <div class="box-footer">
	      <?php echo $this->Html->link('Cancel',array('controller'=>'home','action'=>'index','admin'=>false),array('class'=>'btn btn-default')); ?>
	        <?php echo $this->Form->submit('Sign In',array('class'=>'btn btn-info pull-right','div'=>false)); ?>
	      </div><!-- /.box-footer -->
	    <?php echo $this->Form->end();?>
		<?php $this->validationErrors['Login']='';?>
	</div>
	<div id="forgot_pass" style="display:none;">
		<div class="box-header with-border">
	      <h3 class="box-title"><i class="fa fa-fw fa-lock"></i> Forgot Password</h3>
	    </div><!-- /.box-header -->

		<?php echo $this->Form->create('Login',array('action'=>'forgot_password', 'default' => false));?>
		<div class="box-body">
	        <div class="form-group">
	          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
	          <div class="col-sm-10">
	          	<?php echo $this->Form->input('email',array('type'=>'email','class'=>'form-control','placeholder'=>'Email','label'=>false));?>
	          </div>
	        </div>
	        <div class="form-group">
	          <div class="col-sm-offset-2 col-sm-10">
	          	<a href="javascript:void(0);" onclick="javascript:$('#forgot_pass').hide();$('#sign_in').show();">Click here to login</a>
	          </div>
	        </div>
	      </div><!-- /.box-body -->
	      <div class="box-footer">
	      <?php echo $this->Html->link('Cancel',array('controller'=>'home','action'=>'index','admin'=>false),array('class'=>'btn btn-default')); ?>
	       <?php echo $this->Js->submit('Submit',
		 	array('url'=>'/admin/logins/forgot_password',
		 		'class'=>'btn btn-info pull-right',
		 		'div'=>false,
		 	'update' => '#commentStatus',
		 	'before' => $this->Js->get('#loader')->effect('show', array('buffer' => false)),
			'complete' => $this->Js->get('#loader')->effect('hide', array('buffer' => false))
		 	));
			?>
			<?php echo $this->Form->end();
			echo $this->Html->image('admin/loading_small.gif', array('id'=>'loader','style="display:none"'));
			echo $this->Js->writeBuffer();
			?>
	      </div><!-- /.box-footer -->
	</div>
  </div><!-- /.box -->
  </div>
  <div class="col-md-3"></div>
