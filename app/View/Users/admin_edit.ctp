<section class="content-header">
  <h1>
    <?php echo __('Edit User');?>
    <small>Edit user details</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN_WEBROOT;?>home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo __('Edit User');?></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<?php echo $this->Form->create('User',array('type'=>'file'));?>
				<?php $roles=array();
				if(isset($Roles)){
					foreach($Roles as $Rolesx){
						$roles[$Rolesx['UserRole']['user_role_id']]=$Rolesx['UserRole']['user_role_name'];
					}
				}
				?>
                  <div class="box-body">
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputEmail3">User Role</label>
                      <div class="col-sm-9">
                        <?php echo $this->Form->input('user_role_id', array('label'=>false,'options'=>$roles,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Email</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('email', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Password</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('password', array('type'=>'password','label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">First Name</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('first_name', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Last Name</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('last_name', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">User Status</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('user_status', array('label'=>false,'options'=>array('Active'=>'Active','Inactive'=>'Inactive'),'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Phone</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('phone', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Address</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('address', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">City</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('city', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">State</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('state', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Country</label>
                      <div class="col-sm-9">
                      	<?php 
                      	$country=array(0=>'');
						if(isset($Country)){
							foreach($Country as $Countryx){
								$country[$Countryx['Country']['country_id']]=$Countryx['Country']['country_name'];
							}
						}
                      	echo $this->Form->input('address', array('label'=>false,'options'=>$country,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Zipcode</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('zip_code', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="col-sm-12 control-label" for="inputPassword3">Description</label>
                      <div class="col-sm-12">
                      	<?php echo $this->Form->input('user_description', array('label'=>false,'class'=>'form-control ckeditor')); ?>
                      	<?php echo $this->Form->input('user_id', array('type'=>'hidden')); ?>
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
               	<?php echo $this->Form->end();?>
               	</div>
               	</div>
               	</div>
               	</section>

<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
  jQuery(function () {
    CKEDITOR.replace('.ckeditor');
  });
</script>