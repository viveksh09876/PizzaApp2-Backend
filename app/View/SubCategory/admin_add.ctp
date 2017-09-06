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
				<?php echo $this->Form->create('SubCategory',array('type'=>'file','id'=>'AddEditSubCategory'));?>
        <div class="box-body">
          <!-- <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label" for="inputPassword3">Language</label>
            <div class="col-sm-9">
             <?php // echo $this->Form->input('lang_id', array('label'=>false,'options'=>$languages,'class'=>'form-control')); ?>
           </div>
         </div> -->
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Sub Category Name</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('name', array('label'=>false,'class'=>'form-control','title'=>'Please enter sub category name.')); ?>
           </div>
         </div>

         
         <div class="form-group col-sm-6 fl-right">
      <label class="col-sm-3 control-label" for="inputPassword3">Price Title</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('short_description', array('label'=>false,'class'=>'form-control','type'=>'text')); ?>
     </div>
    </div>
    <div class="form-group col-sm-6 fl-left clear">
          <label class="col-sm-3 control-label required" for="inputPassword3">Main Category</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('cat_id', array('label'=>false,'required'=>true,'class'=>'form-control','options'=>$categories,'empty'=>'Select Main Category','title'=>'Please select main category.')); ?>
           </div>
         </div>
         <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label" for="inputPassword3">SEO Title</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('slug', array('label'=>false,'class'=>'form-control')); ?>
           </div>
         </div>
       <!-- <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label" for="inputPassword3">Image</label>
        <div class="col-sm-9">
         <?php // echo $this->Form->file('image', array('label'=>false)); ?>
       </div>
     </div> -->
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