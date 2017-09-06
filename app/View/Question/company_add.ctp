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
      <div class="errorContainer"><ol></ol></div>
				<?php echo $this->Form->create('Question',array('type'=>'file','id'=>'AddEditQuestion'));?>
        <div class="box-body">
         <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required" for="inputPassword3">Question</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('question', array('label'=>false,'class'=>'form-control','title'=>'Please enter question.')); ?>
           </div>
         </div>
    <div class="form-group col-sm-6 fl-left">
      <label class="col-sm-3 control-label" for="inputPassword3">Sort Order</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('sort_order', array('label'=>false,'options'=>SortLimit(),'class'=>'form-control')); ?>
     </div>
    </div>
    <div class="form-group col-sm-6 fl-left">
      <label class="col-sm-3 control-label" for="inputPassword3">Is Multi Checked?</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('is_multiple', array('label'=>false,'options'=>YesNo(),'class'=>'form-control')); ?>
     </div>
    </div>
         <div class="form-group col-sm-6 fl-left">
      <label class="col-sm-3 control-label" for="inputPassword3">Status</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('status', array('label'=>false,'options'=>ActiveInactive(),'class'=>'form-control')); ?>
     </div>
    </div>
    <div class="form-group col-sm-6 clear">
   <label class="col-sm-5 control-label">Add Options : </label>
      <div class="col-sm-7">
       <a onclick="getAnswer(this);" data-block="<?php echo isset($blockCount)?($blockCount):0; ?>" href="javascript:void(0)" class="btn btn-primary" id="addedBtn" ><i class="fa fa-plus"></i> Add Option </a>
     </div>
    </div>
  <div id="answerBlock"></div>

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
    var container = $('div.errorContainer');
    var v = $('#AddEditQuestion').validate({
      errorContainer:container,
      errorLabelContainer:$("ol",container),wrapper:'li'
    });

    $('body').on('click','.remove',function(){
      var Block = $(this).attr('data-block');
      if(confirm('Are you sure want to remove block?')){
        $('#block'+Block).remove();
      }
    });

    var isEdit = '<?php echo (!empty($this->request->data["Question"]["id"]))?$this->request->data["Question"]["id"]:0; ?>';
    if(isEdit>0){
      renderAnswers(isEdit);
    }
  });

  function renderAnswers(Questionid){
    var PostUrl = '<?php echo WEBROOT ?>question/render_answers';
    $.ajax({
        url:PostUrl,
        method:'POST',
        data:{'question_id':Questionid},
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
          $('#answerBlock').append(response);
          $.loadingBlockHide();
        }
    });
}

  function getAnswer(obj){
    var PostUrl = '<?php echo WEBROOT ?>question/get_answers';
    var previousBlock = $(obj).attr('data-block');
    var nextBlock = parseInt(previousBlock) + 1;
    $.ajax({
        url:PostUrl,
        method:'POST',
        data:{'block':previousBlock},
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
          $(obj).attr('data-block',nextBlock);
          $('#answerBlock').append(response);
          $.loadingBlockHide();
        }
    });
}



</script>