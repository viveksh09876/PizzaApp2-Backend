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
        <?php $isEdit = (!empty($this->request->data['Option']['id']))?1:0; ?>
				<?php echo $this->Form->create('Option',array('type'=>'file','id'=>'AddEditOption'));?>
        <div class="box-body">
          <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label required" for="inputPassword3">Select Store</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('store_id', array('label'=>false,'class'=>(!empty($isEdit)?'form-control':'form-control chosen-select'),'options'=>$stores,'multiple'=>(!empty($isEdit)?'false':'true'))); ?>
           </div>
         </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label" for="inputPassword3">Modifier Name</label>
          <div class="col-sm-9">
           <?php echo $this->Form->input('name', array('label'=>false,'class'=>'form-control required','title'=>'Please enter modifier name.')); ?>
         </div>
       </div>
       <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label" for="inputPassword3">PLU Code</label>
          <div class="col-sm-9">
           <?php echo $this->Form->input('plu_code', array('label'=>false,'class'=>'form-control required','title'=>'Please enter PLU code.')); ?>
         </div>
       </div>
 <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Image</label>
  <div class="col-sm-9">
   <?php  echo $this->Form->file('image', array('label'=>false)); ?>
 </div>
</div>

<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Sort Order</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('sort_order', array('label'=>false,'options'=>SortLimit(),'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Dependent Modifier Group</label>
  <div class="col-sm-9">
   <?php 
    echo $this->Form->input('dependent_modifier_id', array('label'=>false,'options'=>$modifiers,'class'=>'form-control','empty'=>'Select Dependent Modifier Group','onchange'=>'getModifierOption(this);','data-option'=>0)); ?>
 </div>
</div>
<div class="form-group col-sm-6 ">
  <label class="col-sm-3 control-label" for="inputPassword3">Dependent Modifier</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('dependent_modifier_option_id', array('label'=>false,'options'=>array(),'class'=>'form-control','empty'=>'Select Dependent Modifier')); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Dependent Modifier Count</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('dependent_modifier_count', array('label'=>false,'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6 ">
  <label class="col-sm-3 control-label" for="inputPassword3">Status</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('status', array('label'=>false,'options'=>ActiveInactive(),'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6 clear">
  <label class="col-sm-3 control-label" for="inputPassword3">No Modifier</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('no_modifier', array('label'=>false,'options'=>YesNo(),'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-12">
  <div class="col-sm-9">
    <a onclick="getSubOptions();" href="javascript:void(0)" class="btn btn-primary" id="addBtn"><i class="fa fa-plus"></i> Add Choices</a><br><b>(Use CTR for multiple choice selection)</b>
 </div>
</div>
<div class="form-group col-sm-12" id="optionsDropdown">
  <div class="col-sm-9">
    <?php echo $this->Form->input('sub_options',array('options'=>array(),'label'=>false,'class'=>'form-control','multiple'=>true)); ?>
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
<script type="text/javascript">
  $(document).ready(function(){
      $('#OptionDependentModifierId').change();
  });
  function getModifierOption(obj){
    var modifierId = $(obj).val();
    var PostUrl = '<?php echo WEBROOT ?>modifier/get_modifier_options';
    if(modifierId>0){
      $.ajax({
        url:PostUrl,
        method:'POST',
        data:{'modifier_id':modifierId},
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
          var alreadySet = '<?php echo (isset($this->request->data["Option"]["dependent_modifier_option_id"]))?$this->request->data["Option"]["dependent_modifier_option_id"]:0; ?>';
          
          $('#OptionDependentModifierOptionId').html('<option value="">Select Dependent Modifier Option</option>');
          $.each(data, function(key, value){
            var selected = (alreadySet===key)?'selected=selected':'';
              $('#OptionDependentModifierOptionId').append($('<option '+selected+' value='+key+'>').text(value));
          });
          $.loadingBlockHide();
        }
      });
    }
  }

  function getSubOptions(){
    var PostUrl = '<?php echo WEBROOT ?>modifier/get_sub_options';
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
          
          if(data.length === 0){
            alert('Sorry! no record founds.');
            $.loadingBlockHide();
            return false;
          }

          var alreadySet = '<?php echo json_encode((!empty($this->request->data["Option"]["sub_options"]))?$this->request->data["Option"]["sub_options"]:array()); ?>';
          alreadySet = $.parseJSON(alreadySet);
      
          $('#OptionSubOptions').html('');
          $.each(data, function(key, value){
            var isExist = $.inArray(key, alreadySet);
            var selected = (isExist!=-1)?'selected=selected':'';
             $('#OptionSubOptions').append($('<option '+selected+' value='+key+'>').text(value));
          });
          $('#optionsDropdown').show();
          $.loadingBlockHide();
        }
      });
    
  }
</script>


<script type="text/javascript">
$(document).ready(function(){
  var isEdit = '<?php echo (!empty($this->request->data["Option"]["id"]))?$this->request->data["Option"]["id"]:0; ?>';
  if(isEdit>0){
    $('#addBtn').hide();
    getSubOptions();
  }
});


</script>