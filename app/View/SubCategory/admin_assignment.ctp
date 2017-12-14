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
				<?php echo $this->Form->create('CategorySubcategory',array('type'=>'file','id'=>'AddEditCategorySubcategory'));?>
        <div class="box-body">
          <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label" for="inputPassword3">Language</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('lang_id', array('label'=>false,'options'=>$languages,'class'=>'form-control')); ?>
           </div>
         </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Category</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('category_id', array('label'=>false,'class'=>'form-control','options'=>$categories)); ?>
           </div>
         </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label" for="inputPassword3">Sub Category</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('subcategory_id', array('label'=>false,'class'=>'form-control','options'=>$subcategories)); ?>
           </div>
         </div>
   <div class="form-group col-sm-6">
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