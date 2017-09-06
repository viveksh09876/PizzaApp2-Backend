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
				<?php echo $this->Form->create('SubOption',array('type'=>'file','id'=>'AddEditSubOption'));?>
        <div class="box-body">
         <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label" for="inputPassword3">Choice Name</label>
          <div class="col-sm-9">
           <?php echo $this->Form->input('name', array('label'=>false,'class'=>'form-control required','title'=>'Please enter choice name.')); ?>
         </div>
       </div>
<div class="form-group col-sm-6 fl-right">
  <label class="col-sm-12 control-label" for="inputPassword3">Short Description</label>
  <div class="col-sm-12">
   <?php echo $this->Form->input('short_description', array('label'=>false,'class'=>'form-control','maxlength'=>100,'rows'=>4,'after'=>'(Maximum 100 characters allowed)')); ?>
 </div>
</div>
<div class="form-group col-sm-6 fl-left">
  <label class="col-sm-3 control-label" for="inputPassword3">Sort Order</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('sort_order', array('label'=>false,'options'=>SortLimit(),'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6 fl-left">
  <label class="col-sm-3 control-label" for="inputPassword3">Status</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('status', array('label'=>false,'options'=>ActiveInactive(),'class'=>'form-control')); ?>
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