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
				<?php echo $this->Form->create('Language',array('type'=>'file','id'=>'AddEditLanguage'));?>
        <div class="box-body">
          <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Name</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('name', array('label'=>false,'class'=>'form-control required','title'=>'Please enter language name.')); ?>
           </div>
         </div>
   <div class="form-group col-sm-3">
      <label class="col-sm-3 control-label" for="inputPassword3">Status</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('status', array('label'=>false,'options'=>ActiveInactive(),'class'=>'form-control')); ?>
     </div>
    </div>
<div class="col-sm-2">
  <button class="btn btn-info pull-right" type="submit">Save</button>
</div><!-- /.box-footer -->
</div><!-- /.box-body -->

<?php echo $this->Form->end();?>
</div>
</div>
</div>
</section>