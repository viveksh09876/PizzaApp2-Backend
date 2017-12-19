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
         <?php $isEdit = (!empty($this->request->data['Coupon']['id']))?1:0; ?>
				<?php echo $this->Form->create('Coupon',array('type'=>'file','id'=>'AddEditCoupon'));?>
        <div class="box-body">
        <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label required" for="inputPassword3">Select Store</label>
          <div class="col-sm-9">
            <?php echo $this->Form->input('store_id', array('label'=>false,'class'=>(!empty($isEdit)?'form-control':'form-control chosen-select'),'options'=>$stores,'multiple'=>(!empty($isEdit)?'false':'true'))); ?>
           </div>
        </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Coupon Name</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('coupon_name', array('label'=>false,'class'=>'form-control','title'=>'Please enter coupon name.')); ?>
           </div>
         </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Coupon Code</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('coupon_code', array('label'=>false,'class'=>'form-control','title'=>'Please enter coupon code.')); ?>
           </div>
         </div>
         <div class="form-group col-sm-6 fl-right">
      <label class="col-sm-3 control-label" for="inputPassword3">Application</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('application', array('label'=>false,'class'=>'form-control','rows'=>'6', 'maxlength'=>500,'title'=>'Maximum 100 characters are allow.','after'=>'(Maximum 500 characters allowed)')); ?>
     </div>
    </div>
     <div class="form-group col-sm-6 fl-right">
      <label class="col-sm-3 control-label" for="inputPassword3">Description</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('description', array('label'=>false,'class'=>'form-control','rows'=>'6', 'maxlength'=>500,'title'=>'Maximum 100 characters are allow.','after'=>'(Maximum 500 characters allowed)')); ?>
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