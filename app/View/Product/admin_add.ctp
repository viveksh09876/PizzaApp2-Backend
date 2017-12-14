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
				<?php echo $this->Form->create('Product',array('type'=>'file','id'=>'AddEditProduct'));?>
        <div class="box-body">
        <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label" for="inputPassword3">Category</label>
          <div class="col-sm-9">
           <?php echo $this->Form->input('category_id', array('label'=>false,'options'=>$categories,'class'=>'form-control required','title'=>'Please select category','empty'=>'Select Category','onchange'=>'getSubCategories(this)')); ?>
         </div>
        </div>
        <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label" for="inputPassword3">Sub Category</label>
          <div class="col-sm-9">
           <?php echo $this->Form->input('sub_category_id', array('label'=>false,'options'=>SortLimit(),'class'=>'form-control','empty'=>'Select Sub Category')); ?>
         </div>
        </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label" for="inputPassword3">PLU Code</label>
          <div class="col-sm-9">
           <?php echo $this->Form->input('plu_code', array('label'=>false,'class'=>'form-control required','title'=>'Please enter PLU code.')); ?>
         </div>
       </div>
       <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label " for="inputPassword3">Item Name</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('title', array('label'=>false,'class'=>'form-control required','title'=>'Please enter product title.')); ?>
       </div>
     </div>
    <!--  <div class="form-group col-sm-6">
      <label class="col-sm-3 control-label" for="inputPassword3">Price</label>
      <div class="col-sm-9">
       <?php // echo $this->Form->input('price', array('label'=>false,'class'=>'form-control')); ?>
     </div>
   </div> -->
   <div class="form-group col-sm-6">
    <label class="col-sm-3 control-label" for="inputPassword3">Price Title</label>
    <div class="col-sm-9">
     <?php echo $this->Form->input('price_title', array('label'=>false,'class'=>'form-control','title'=>'Please enter PLU code.')); ?>
   </div>
 </div>
<div class="form-group col-sm-6 fl-left">
  <label class="col-sm-3 control-label" for="inputPassword3">Sort Order</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('sort_order', array('label'=>false,'options'=>SortLimit(),'class'=>'form-control')); ?>
 </div>
</div>
 <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Image</label>
  <div class="col-sm-9">
   <?php  echo $this->Form->file('image', array('label'=>false)); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Thumbnail Image</label>
  <div class="col-sm-9">
   <?php  echo $this->Form->file('thumb_image', array('label'=>false)); ?>
 </div>
</div>

<div class="form-group col-sm-6 fl-left">
  <label class="col-sm-3 control-label" for="inputPassword3">SEO Title</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('slug', array('label'=>false,'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Status</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('status', array('label'=>false,'options'=>ActiveInactive(),'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Tax</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('tax', array('label'=>false,'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Group</label>
  <div class="col-sm-9">
  <?php 
  echo $this->Form->input('Product.groupv', array('type' => 'checkbox','label'=>'V')); 
  echo $this->Form->input('Product.grouph', array('type' => 'checkbox','label'=>'H')); 
  echo $this->Form->input('Product.groupvh', array('type' => 'checkbox','label'=>'GF')); 
  ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-12 control-label" for="inputPassword3">Short Description</label>
  <div class="col-sm-12">
   <?php echo $this->Form->input('short_description', array('label'=>false,'class'=>'form-control','maxlength'=>300,'rows'=>10,'after'=>'(Maximum 300 characters allowed)')); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-12 control-label" for="inputPassword3">Special Instruction</label>
  <div class="col-sm-12">
   <?php echo $this->Form->input('special_instruction', array('label'=>false,'class'=>'form-control','maxlength'=>300,'rows'=>10,'after'=>'(Maximum 300 characters allowed)')); ?>
 </div>
</div>
<div class="form-group col-sm-12">
  <div class="col-sm-9">
    <a onclick="getIncludedModifier();" href="javascript:void(0)" class="btn btn-primary" id="includedBtn" ><i class="fa fa-plus"></i> Included Modifiers</a>
    <strong class="editLabel">Included Modifiers : </strong>
    <br><small>(Use CTR for multiple selection)</small>
 </div>
</div>
<div class="form-group col-sm-12" id="includedDropdown"></div>
<div class="form-group col-sm-12">
  <div class="col-sm-9">
    <a onclick="getAddedModifiers();" href="javascript:void(0)" class="btn btn-primary" id="addedBtn" ><i class="fa fa-plus"></i> Add Modifiers </a>
    <strong class="editLabel">Added Modifiers : </strong>
    <br><small>(Use CTR for multiple selection)</small>
 </div>
</div>
<div class="form-group col-sm-12" id="addedDropdown">
  <div class="col-sm-9">
    <?php echo $this->Form->input('added_modifier',array('options'=>array(),'label'=>false,'class'=>'form-control','multiple'=>true,'onchange'=>'getAdditionalInfo(this)')); ?>
 </div>
</div>
<div class="form-group col-sm-12" id="additionFields"></div>
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
$(document).ready(function(){
    $('.editLabel').hide();
    var isEdit = '<?php echo (!empty($this->request->data["Product"]["id"]))?$this->request->data["Product"]["id"]:0; ?>';
    if(isEdit>0){
      $('.editLabel').show();
      var obj = $('#ProductCategoryId');
      getSubCategories(obj);
      
      $('#includedBtn').hide();
      getIncludedModifier();

      $('#addedBtn').hide();
      getAddedModifiers();
    }
});

function getIncludedModifier(){
  var alreadySet = '<?php echo json_encode((!empty($this->request->data["Product"]["ProductIncludedModifier"]))?$this->request->data["Product"]["ProductIncludedModifier"]:array()); ?>';
  var PostUrl = '<?php echo WEBROOT ?>modifier/get_included_modifiers';
  $.ajax({
      url:PostUrl,
      method:'POST',
      data:{'alreadySet':alreadySet},
      beforeSend:function(){
        $.loadingBlockShow({
          imgPath: '<?=IMG?>icon.gif',
          text: 'Please Wait Loading ...',
          style: {
              position: 'fixed',
              width: '100%',
              height: '100%',
              background: 'rgba(0, 0, 0, .8)',
              left: 0,
              top: 0,
              zIndex: 10000
          }
        });
      },
      success:function(response){
        $('#includedDropdown').html(response);
        $.loadingBlockHide();
      }
  });
}



  function getAddedModifiers(){
      var isEdit = '<?php echo (!empty($this->request->data["Product"]["id"]))?$this->request->data["Product"]["id"]:0; ?>';
      var PostUrl = '<?php echo WEBROOT ?>modifier/get_modifiers';
    
      $.ajax({
        url:PostUrl,
        method:'POST',
        data:{},
        beforeSend:function(){
          $.loadingBlockShow({
            imgPath: '<?=IMG?>icon.gif',
            text: 'Please Wait Loading ...',
            style: {
                position: 'fixed',
                width: '100%',
                height: '100%',
                background: 'rgba(0, 0, 0, .8)',
                left: 0,
                top: 0,
                zIndex: 10000
            }
          });
        },
        success(response){
          var data = $.parseJSON(response);

          var alreadySet = '<?php echo json_encode((!empty($this->request->data["Product"]["ProductModifier"]))?$this->request->data["Product"]["ProductModifier"]:array()); ?>';
          alreadySet = $.parseJSON(alreadySet);

         // $('#ProductAddedModifier').html('<option value="">Select Modifiers</options>');
          
          $.each(data, function(key, value){
            var isExist = $.inArray(key, alreadySet);
            var selected = (isExist!=-1)?'selected=selected':'';
            $('#ProductAddedModifier').append($('<option '+selected+' value='+key+'>').text(value));
            
            if(isEdit>0){                
                var PostUrl = '<?php echo WEBROOT ?>modifier/get_addtional_info';
                $.ajax({
                  url:PostUrl,
                  method:'POST',
                  data:{'product_id':isEdit},
                  beforeSend:function(){
                    $.loadingBlockShow({
                      imgPath: '<?=IMG?>icon.gif',
                      text: 'Please Wait Loading ...',
                      style: {
                          position: 'fixed',
                          width: '100%',
                          height: '100%',
                          background: 'rgba(0, 0, 0, .8)',
                          left: 0,
                          top: 0,
                          zIndex: 10000
                      }
                    });
                  },
                  success:function(response){
                    $('#additionFields').html(response);
                   $.loadingBlockHide();
                  }
                });
            }
            $('#addedDropdown').show();
            $('#ProductAddedModifier').show();
          });
         $.loadingBlockHide();
        }
      });
    
  }

  function getAdditionalInfo(obj){
    var isEdit = '<?php echo (!empty($this->request->data["Product"]["id"]))?$this->request->data["Product"]["id"]:0; ?>';
    var ModifierId = $(obj).val();
    if(ModifierId=='' || ModifierId==null){
      $('#additionFields').html('');
      return false;
    }
    var PostUrl = '<?php echo WEBROOT ?>modifier/get_addtional_info';
      $.ajax({
        url:PostUrl,
        method:'POST',
        data:{'modifier_id':ModifierId,'product_id':isEdit},
        beforeSend:function(){
          $.loadingBlockShow({
            imgPath: '<?=IMG?>icon.gif',
            text: 'Please Wait Loading ...',
            style: {
                position: 'fixed',
                width: '100%',
                height: '100%',
                background: 'rgba(0, 0, 0, .8)',
                left: 0,
                top: 0,
                zIndex: 10000
            }
          });
        },
        success:function(response){
          $('#additionFields').html(response);
          $.loadingBlockHide();
        }
      });
  }


  function getSubCategories(obj){
    var categoryId = $(obj).val();
    if(categoryId==''){
      return false;
    }
    
    var PostUrl = '<?php echo WEBROOT ?>category/get_sub_categories';
      $.ajax({
        url:PostUrl,
        method:'POST',
        data:{'category_id':categoryId},
        beforeSend:function(){
          $.loadingBlockShow({
            imgPath: '<?=IMG?>icon.gif',
            text: 'Please Wait Loading ...',
            style: {
                position: 'fixed',
                width: '100%',
                height: '100%',
                background: 'rgba(0, 0, 0, .8)',
                left: 0,
                top: 0,
                zIndex: 10000
            }
          });
        },
        success:function(response){
          var data = $.parseJSON(response);
          var alreadySet = '<?php echo (!empty($this->request->data["Product"]["sub_category_id"]))?$this->request->data["Product"]["sub_category_id"]:0; ?>';
          
          $('#ProductSubCategoryId').html('<option value="">Select Sub Category</option>');
          $.each(data, function(key, value){
            var selected = (alreadySet===key)?'selected=selected':'';
            $('#ProductSubCategoryId').append($('<option '+selected+' value='+key+'>').text(value));
          });
         $.loadingBlockHide();
        }
      });
  }
</script>