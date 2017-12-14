<?php extract($pageVar); ?>
<section class="content-header">
  	<h1>
		<?=$title;?>
		<small><?=$sub_title;?></small>
	</h1>
	<ol class="breadcrumb">
		<?=$breadcrumb;?>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<?php echo $this->Form->create('EmailTemplate',array('type'=>'file'));?>
				<div class="box-body">
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label">Template Name</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('template_name', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label">Template Key</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('template_key', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label">From Name</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('from_name', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label">From Email</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('from_email', array('type'=>'email','label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label">Email Subject</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('email_subject', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Template Status</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('template_status', array('label'=>false,'options'=>array('Active'=>'Active','Inactive'=>'Inactive'),'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-12">
						<label class="col-sm-12 control-label" for="inputPassword3">Email Body</label>
						<div class="col-sm-12">
							<?php 
							echo $this->Form->input('email_body', array('label'=>false,'class'=>'form-control ckeditor')); 
							echo $this->Form->input('template_id',array('type'=>'hidden'));
							?>
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
  $(function () {
    CKEDITOR.replace('.ckeditor');
  });
</script>