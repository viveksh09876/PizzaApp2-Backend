<section class="content-header">
	<h1>
	<?php echo __('Update Contact Information');?>
	<small>Contact information for users</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=PRACTITIONER_WEBROOT;?>home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?php echo __('Update Contact Information');?></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<?php echo $this->Form->create('ContactInformation');	?>
				<div class="box-body">
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Email</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('email', array('type'=>'email','label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Contact Number</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('contact', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Fax</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('fax', array('type'=>'text','label'=>false,'class'=>'form-control')); ?>
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
							echo $this->Form->input('country_id', array('label'=>false,'options'=>$country,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Zipcode</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('zipcode', array('label'=>false,'class'=>'form-control')); ?>
							<?php echo $this->Form->input('id', array('type'=>'hidden')); ?>
						</div>
					</div>

				</div><!-- /.box-body -->
				<div class="box-footer">
					<button class="btn btn-info pull-right" type="submit">Update</button>
				</div><!-- /.box-footer -->
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
</section>
