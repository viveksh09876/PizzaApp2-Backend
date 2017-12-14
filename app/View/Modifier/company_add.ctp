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
       <?php $isEdit = (!empty($this->request->data['Modifier']['id']))?1:0; ?>
				<?php echo $this->Form->create('Modifier',array('type'=>'file','id'=>'AddEditProduct'));?>
        <div class="box-body">
        <div class="form-group col-sm-6 fl-left">
          <label class="col-sm-3 control-label required" for="inputPassword3">Select Store</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('store_id', array('label'=>false,'class'=>(!empty($isEdit)?'form-control':'form-control chosen-select'),'options'=>$stores,'multiple'=>(!empty($isEdit)?'false':'true'))); ?>
           </div>
         </div>
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label" for="inputPassword3">Modifier Group</label>
          <div class="col-sm-9">
           <?php echo $this->Form->input('title', array('label'=>false,'class'=>'form-control required','title'=>'Please enter title.')); ?>
         </div>
       </div>
 <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Image</label>
  <div class="col-sm-9">
   <?php  echo $this->Form->file('image', array('label'=>false)); ?>
 </div>
</div>

<div class="form-group col-sm-6 clear">
  <label class="col-sm-3 control-label" for="inputPassword3">Sort Order</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('sort_order', array('label'=>false,'options'=>SortLimit(),'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-6">
  <label class="col-sm-3 control-label" for="inputPassword3">Status</label>
  <div class="col-sm-9">
   <?php echo $this->Form->input('status', array('label'=>false,'options'=>ActiveInactive(),'class'=>'form-control')); ?>
 </div>
</div>
<div class="form-group col-sm-12 clear">
  <label class="col-sm-12 control-label" for="inputPassword3">Short Description</label>
  <div class="col-sm-12">
   <?php echo $this->Form->input('short_description', array('label'=>false,'class'=>'form-control','maxlength'=>100,'rows'=>10,'after'=>'(Maximum 100 characters allowed)')); ?>
 </div>
</div>
<div class="form-group col-sm-12">
  <div class="col-sm-9">
    <a onclick="getOptions();" href="javascript:void(0)" class="btn btn-primary" id="addBtn" ><i class="fa fa-plus"></i> Add Modifiers</a><br><b>(Use CTR for multiple modifiers selection)</b>
 </div>
</div>
<div class="form-group col-sm-12" id="optionsDropdown">
  <div class="col-sm-9">
    <?php echo $this->Form->input('options',array('options'=>array(),'label'=>false,'class'=>'form-control','multiple'=>true)); ?>
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
  var isEdit = '<?php echo (!empty($this->request->data["Modifier"]["id"]))?$this->request->data["Modifier"]["id"]:0; ?>';
  if(isEdit>0){
    $('#addBtn').hide();
    getOptions();
  }
});

  function getOptions(){
    var PostUrl = '<?php echo WEBROOT ?>modifier/get_modifier_options';
    
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

          var alreadySet = '<?php echo json_encode((!empty($this->request->data["Modifier"]["option"]))?$this->request->data["Modifier"]["option"]:array()); ?>';
          alreadySet = $.parseJSON(alreadySet);

          $('#ModifierOptions').html('');
          $.each(data, function(key, value){
            var isExist = $.inArray(key, alreadySet);
            var selected = (isExist!=-1)?'selected=selected':'';
             $('#ModifierOptions').append($('<option '+selected+' value='+key+'>').text(value));
          });
          $('#optionsDropdown').show();
          $.loadingBlockHide();
        }
      });
    
  }
</script>