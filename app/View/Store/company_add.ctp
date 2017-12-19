<?php extract($pageVar); // pr($this->request->data); ?>
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
				<?php echo $this->Form->create('Store',array('type'=>'file','id'=>'AddEditStore'));?>
        <div class="box-body">
          <div class="form-group col-sm-6">
          <label class="col-sm-3 control-label required">Store ID</label>
            <div class="col-sm-9">
             <?php echo $this->Form->input('store_id', array('label'=>false,'type'=>'text','class'=>'form-control required','title'=>'Please enter store id.')); ?>
           </div>
         </div>
       <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Name</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_name', array('label'=>false,'class'=>'form-control required','title'=>'Please enter store name.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Address</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_address', array('label'=>false,'class'=>'form-control required','title'=>'Please enter store address.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store IP Address</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_ip_address', array('label'=>false,'class'=>'form-control','placeholder'=>'127.000.000.001','title'=>'Please enter valid ip address.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Open Port</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_open_port', array('label'=>false,'class'=>'form-control')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Connection Certification</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_connection_certificate', array('type'=>'file','label'=>false)); ?>
         <?php if(!empty($this->request->data['Store']['store_connection_certificate'])){ ?>
          <br><a href="<?php echo WEBROOT.$this->request->data['Store']['store_connection_certificate']; ?>"><i class="fa fa-download"></i> Download File</a>
         <?php } ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Image</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_image', array('type'=>'file','label'=>false)); ?>
         <?php if(!empty($this->request->data['Store']['store_image'])){ ?>
          <br><img src="<?php echo WEBROOT.$this->request->data['Store']['store_image']; ?>" style="width: 50px; height: 50px;">
         <?php } ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Phone</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_phone', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid phone.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Email</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('store_email', array('label'=>false,'class'=>'form-control required','title'=>'Please enter valid email.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store City</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('city', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid city.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store State</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('state', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid state.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Country</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('country', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid country.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Zipcode</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('zip', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid zipcode.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6 ">
        <label class="col-sm-3 control-label">Store Latitude</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('latitude', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid latitude.')); ?>
       </div>
     </div>
      <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Longitude</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('longitude', array('label'=>false,'class'=>'form-control','title'=>'Please enter valid longitude.')); ?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Delivery Radius</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('delivery_radius', array('label'=>false,'class'=>'form-control')); ?>
       </div>
     </div>
    <div class="form-group col-sm-6 clear">
      <label class="col-sm-3 control-label">POS Type </label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('pos_type', array('label'=>false,'class'=>'form-control')); ?>
     </div>
    </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-3 control-label">Store Notification Email</label>
        <div class="col-sm-9">
         <?php echo $this->Form->input('notification_email', array('label'=>false,'class'=>'form-control')); ?>
       </div>
     </div>
    
    <div class="form-group col-sm-6">
      <label class="col-sm-3 control-label">Link </label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('link', array('label'=>false,'class'=>'form-control','placeholder'=>'Http://www.demo.com','title'=>'Please enter valid url.')); ?>
     </div>
   </div>
   <div class="form-group col-sm-6">
      <label class="col-sm-3 control-label">Status</label>
      <div class="col-sm-9">
       <?php echo $this->Form->input('status', array('label'=>false,'options'=>ActiveInactive(),'class'=>'form-control')); ?>
     </div>
    </div>

   <div class="form-group col-sm-6 clear">
   <label class="col-sm-5 control-label">Add Business Hours : </label>
      <div class="col-sm-7">
       <a onclick="getTimeSlots(this);" data-block="<?php echo isset($blockCount)?$blockCount:0 ?>" href="javascript:void(0)" class="btn btn-primary" id="addedBtn" ><i class="fa fa-plus"></i> Add Time Slot </a>
     </div>
    </div>
  <div id="timeSlotBlock"></div>
   
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
  $('body').on('click','.remove',function(){
    var Block = $(this).attr('data-block');
    if(confirm('Are you sure want to remove block?')){
      $('#block'+Block).remove();
    }
  });

   var isEdit = '<?php echo (!empty($this->request->data["Store"]["id"]))?$this->request->data["Store"]["id"]:0; ?>';
    if(isEdit>0){
      renderTimeSlot(isEdit);
    }
});

function renderTimeSlot(storeId){
    var PostUrl = '<?php echo WEBROOT ?>store/render_time_slots';
    $.ajax({
        url:PostUrl,
        method:'POST',
        data:{'store_id':storeId},
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
          $('#timeSlotBlock').append(response);
          $.loadingBlockHide();
        }
    });
}



function getTimeSlots(obj){
    var PostUrl = '<?php echo WEBROOT ?>store/get_time_slots';
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
          $('#timeSlotBlock').append(response);
          $.loadingBlockHide();
        }
    });
}



</script>