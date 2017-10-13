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
				<?php echo $this->Form->create('Slide',array('type'=>'file','id'=>'AddEditSlide'));?>
        <div class="box-body">
          <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Slide Title</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('slide_title', array('label'=>false,'class'=>'form-control','title'=>'Please enter slide title.')); ?>
           </div>
         </div>
       <div class="form-group col-sm-6 fl-left">
        <label class="col-sm-3 control-label" for="inputPassword3">Background Image</label>
        <div class="col-sm-9">
         <?php echo $this->Form->file('image', array('label'=>false,'required'=>(!empty($this->request->data['Slide']['id']))?false:true,'title'=>'Please upload image')); ?>
         <?php if(!empty($this->request->data['Slide']['id'])&&!empty($this->request->data['Slide']['image'])){ ?>
          <?php $image = $this->request->data['Slide']['image']; ?>
          <img width="100" height="100" id="oldtext_image" src="<?=IMG_ADMIN.'slides/'.$image?>">
          <?php 
          }
          ?>
       </div>
     </div>
     <div class="form-group col-sm-6 fl-right">
        <label class="col-sm-3 control-label" for="inputPassword3">Foreground Image</label>
        <div class="col-sm-9">
          <?php echo $this->Form->file('text_image', array('label'=>false)); ?>
          <?php if(!empty($this->request->data['Slide']['id'])&&!empty($this->request->data['Slide']['text_image'])){ ?>
          <?php $text_image = $this->request->data['Slide']['text_image']; ?>
          <img width="100" height="100" id="oldtext_image" src="<?=IMG_ADMIN.'slides/'.$text_image?>">
          <br>
          <a href="javascript:void(0)" onclick="removeImage()">Remove Image</a>
          <?php echo $this->Form->hidden('oldtext_image', array('label'=>false,'value'=>$this->request->data['Slide']['text_image'])); 
          }
          ?>
       </div>
     </div>
    <div class="form-group col-sm-6">
      <label class="col-sm-4 control-label" for="inputPassword3">Coupon Applicable </label>
      <div class="col-sm-8">
       <?php 

        $attributes = array(
            'legend' => false,
            'value' => (!empty($this->request->data['Slide']['coupon_applicable']))?$this->request->data['Slide']['coupon_applicable']:0,
            'class' => 'coupon-applicable'
        );

        echo $this->Form->radio('coupon_applicable', YesNo(), $attributes);
       ?>
     </div>
    </div>
    <div <?php echo (!empty($this->request->data['Slide']['coupon_code']))?'style="display:block;"':''; ?> class="form-group coupon-code col-sm-6">
      <label class="col-sm-3 control-label" for="inputPassword3">Coupon Code</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('coupon_code', array('label'=>false,'class'=>'form-control','title'=>'Please enter coupon code.')); ?>
     </div>
    </div>
   <div class="form-group col-sm-6">
      <label class="col-sm-3 control-label" for="inputPassword3">Link </label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('slide_link', array('label'=>false,'class'=>'form-control','after'=>'(i.e http://www.domainname.com)')); ?>
     </div>
   </div>
   <div class="form-group col-sm-6">
      <label class="col-sm-3 control-label" for="inputPassword3">Status</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('status', array('label'=>false,'options'=>array('Active'=>'Active','Inactive'=>'Inactive'),'class'=>'form-control')); ?>
     </div>
    </div>
   <!--  <div class="form-group col-sm-12">
      <label class="col-sm-12 control-label" for="inputPassword3">Slide Description</label>
      <div class="col-sm-12">
       <?php // echo $this->Form->input('slide_description', array('label'=>false,'class'=>'form-control','maxlength'=>100,'rows'=>10,'after'=>'(Maximum 100 characters allowed)')); ?>
     </div>
    </div> -->

</div><!-- /.box-body -->
<div class="box-footer">
  <button class="btn btn-info pull-right" type="submit">Save</button>
</div><!-- /.box-footer -->
<?php echo $this->Form->end();?>
</div>
</div>
</div>
</section>
<script type="text/javascript">
  function removeImage(){
    var res = confirm('Are you sure want to remove image?');
    if(res){
      $('#oldtext_image').remove();
      $('#SlideOldtextImage').val('');
    }
  }
</script>