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
      <?php $isEdit = (!empty($this->request->data['Category']['id']))?1:0; ?>
				<?php echo $this->Form->create('Category',array('type'=>'file','id'=>'AddEditCategory'));?>
        <div class="box-body">
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Select Store</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('store_id', array('label'=>false,'class'=>(!empty($isEdit)?'form-control':'form-control chosen-select'),'options'=>$stores,'multiple'=>(!empty($isEdit)?'false':'true'))); ?>
           </div>
         </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Category Name</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('name', array('label'=>false,'class'=>'form-control','title'=>'Please enter category name.')); ?>
           </div>
         </div>
         <div class="form-group col-sm-6 fl-right">
      <label class="col-sm-12 control-label" for="inputPassword3">Short Description</label>
      <div class="col-sm-12">
       <?php echo $this->Form->input('short_description', array('label'=>false,'class'=>'form-control','rows'=>'6', 'maxlength'=>100,'title'=>'Maximum 100 characters are allow.','after'=>'(Maximum 100 characters allowed)')); ?>
     </div>
    </div>
    <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label" for="inputPassword3">Image</label>
        <div class="col-sm-9">
         <?php echo $this->Form->file('image', array('label'=>false)); ?>
       </div>
     </div>
    <div class="form-group col-sm-6 fl-left">
      <label class="col-sm-3 control-label" for="inputPassword3">Sort Order</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('sort_order', array('label'=>false,'options'=>SortLimit(),'class'=>'form-control')); ?>
     </div>
    </div>
    
    <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label" for="inputPassword3">SEO Title</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('slug', array('label'=>false,'class'=>'form-control')); ?>
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