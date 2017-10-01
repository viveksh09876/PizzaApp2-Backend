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
			<div class="box box-primary" style="min-height: 400px;">
				<?php echo $this->Form->create('Deal',array('id'=>'AddEditDeal','preventDefault'=>true));?>
        <div class="box-body">
          <div id="add-deal-sec">
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('title', array('label'=>'Deal Title','class'=>'form-control','title'=>'Please enter deal title.','required'=>true,'placeholder'=>'Deal Title')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('image_text', array('label'=>'Image Text','class'=>'form-control','title'=>'Please enter image text.','required'=>true,'placeholder'=>'Image Text')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('description', array('label'=>'Deal Description','class'=>'form-control','title'=>'Please enter deal description.','required'=>true,'placeholder'=>'Deal Description')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('code', array('label'=>'Deal Code','class'=>'form-control','title'=>'Please enter deal code.','required'=>true,'placeholder'=>'Deal Code')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('status', array('label'=>'Status','options'=>ActiveInactive(),'class'=>'form-control')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php  
              echo $this->Js->submit(
                'Continue >>',
                array(
                  'url'=>array('controller'=>'deals','action'=>'add'),
                  'success'=>'dealResponse(data,textStatus)',
                  'before'=>'return dealValidate()',
                  'complete' => $this->Js->get('#loader')->effect('hide', array('buffer' => false)),
                  'div'=>false,
                  'class'=>'btn btn-info pull-right',
                  'style'=>'float: left !important; margin-top: 8%;',
                  'id'=>'addDealSbt'
                ) 
              );
              echo $this->Form->end();
              echo $this->Js->writeBuffer();
              ?>
              <?php  echo $this->Html->image('loading_medium.gif', array('id'=>'loader')); ?>
            </div>
          </div>
        </div>
          <div id="add-req-sec" class="col-sm-12">
            <div class="col-sm-12"><a href="javascript:$('#manage-requirment').toggle();" class="btn btn-info"><i class="fa fa-plus"></i> Addd Requirments</a></div>
          </div>
          <div id="manage-requirment" class="col-sm-12">
            <div class="col-sm-12">
              <?php
                echo $this->Form->create('DealItem');
                echo $this->Form->input('deal_id',array('type'=>'hidden'));
                echo $this->Form->input('category',array('options'=>$categories,'class'=>'form-control col-sm-6','empty'=>'Select Category','title'=>'Please select category','label'=>'Select Category','onchange'=>'getProducts(this.value)','required'=>true));
                echo $this->Form->input('size',array('options'=>$sizes,'class'=>'form-control col-sm-6','label'=>'Select Size', 'div'=>array('id'=>'sizeSec')));
                echo $this->Form->input('product',array('options'=>array(),'class'=>'form-control col-sm-6','multiple'=>false,'label'=>'Select Product', 'empty'=>'Select Product','onchange'=>'getModifiers(this)','div'=>array('id'=>'productSec')));
                echo $this->Form->input('modifier',array('options'=>array(),'class'=>'form-control col-sm-6','label'=>'Select Modifier', 'empty'=>'Select Modifier','div'=>array('id'=>'modifierSec')));
                echo $this->Form->input('quantity',array('placeholder'=>'Product Quantity','class'=>'form-control col-sm-6'));
                echo $this->Form->input('price',array('placeholder'=>'Product Price','class'=>'form-control col-sm-6','style'=>'margin-bottom:2%'));

                echo $this->Js->submit(
                  'Add',
                  array(
                    'url'=>array('controller'=>'deals','action'=>'add_item'),
                    'success'=>'addItemResponse(data,textStatus)',
                    'before'=>'return itemValidate()',
                    'complete' => $this->Js->get('#loader')->effect('hide', array('buffer' => false)),
                    'div'=>false,
                    'class'=>'btn btn-info'
                  ) 
                );

                echo $this->Form->end();
                echo $this->Js->writeBuffer();
              ?>
            </div>
          </div>
          <div id="manage-group" class="col-sm-12">
            <div class="col-sm-12">
                <?php echo $this->Form->create('DealGroup'); ?>
                  <fieldset>
                    <legend>Make Group:</legend>
                    <div id="group-items">

                    </div>
                   </fieldset>
                <?php 
                echo $this->Form->input('deal_id',array('type'=>'hidden','class'=>'deal_id'));
                echo $this->Form->input('condition',array('options'=>conditions()));
                echo $this->Js->submit(
                  'Make Group',
                  array(
                    'url'=>array('controller'=>'deals','action'=>'make_group'),
                    'success'=>'makegGroupResponse(data,textStatus)',
                    'before'=>$this->Js->get('#loader')->effect('show', array('buffer' => false)),
                    'complete' => $this->Js->get('#loader')->effect('hide', array('buffer' => false)),
                    'div'=>false,
                    'disabled'=>true,
                    'class'=>'btn btn-info'
                  ) 
                );
                echo $this->Js->submit(
                  'Save Deal',
                  array(
                    'url'=>array('controller'=>'deals','action'=>'save_deal'),
                    'success'=>'saveDealResponse(data,textStatus)',
                    'before'=>$this->Js->get('#loader')->effect('show', array('buffer' => false)),
                    'complete' => $this->Js->get('#loader')->effect('hide', array('buffer' => false)),
                    'div'=>false,
                    'disabled'=>true,
                    'class'=>'btn btn-info'
                  ) 
                );
                echo $this->Form->end();
                echo $this->Js->writeBuffer();
                ?>
               
            </div>
          </div>
        </div><!-- /.box-body -->
        <?php echo $this->Form->end();?>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
    function dealValidate(){
      var validator = $( "#AddEditDeal" ).validate();
      if(validator.element( "#DealTitle") && validator.element( "#DealImageText") && validator.element( "#DealDescription") && validator.element( "#DealCode")){
        $('#loader').show();
        return true;
      }else{
        return false;
      }
    }

    function itemValidate(){
      var validator = $( "#DealItemAdminAddForm" ).validate();
      if(validator.element( "#DealItemCategory")){
        $('#loader').show();
        return true;
      }else{
        return false;
      }
    }

    function getProducts(catId){
      $('#DealItemProduct, #DealItemSize, #DealItemModifier').val(''); 
      $('#modifierSec, #sizeSec, #productSec').hide();
      if(catId==1){
        $('#sizeSec').show();
      }

      $.ajax({
        url:'<?php echo WEBROOT ?>deals/getProductList/'+catId,
        method:'GET',
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
          var data =  $.parseJSON(response);
          $('#DealItemProduct').html('');
          $('#DealItemProduct').append($('<option value="">Select Product</option>'));
          $.each(data, function(key, value){
            $('#DealItemProduct').append($('<option data-id="'+key+'" value='+Object.keys(value)+'>').text(Object.values(value)));
          });
          $('#productSec').show();
          $.loadingBlockHide();
        }

      });
    }

  function getModifiers(obj){
    var catId = $('#DealItemCategory').val();
    if(catId!=1){
      return false;
    }

    var productId = $(obj).find(':selected').attr('data-id');
     $.ajax({
        url:'<?php echo WEBROOT ?>deals/getModifierList/'+productId,
        method:'GET',
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
          var data =  $.parseJSON(response);
          $('#DealItemModifier').html('');
          $('#DealItemModifier').append($('<option value="">Select Modifier</option>'));
          $.each(data, function(key, value){
            $('#DealItemModifier').append($('<option value='+key+'>').text(value));
          });
          $('#modifierSec').show();
          $.loadingBlockHide();
        }

      });
  }

  function dealResponse(data,textStatus){
    $('#DealItemDealId').val(data);
    $('#AddEditDeal #addDealSbt').prop("disabled", true);
    // $('#add-deal-sec').hide();
    $('#add-req-sec').show();
  }

  function addItemResponse(data,textStatus){
    var response =  $.parseJSON(data);
    var dealId = response.deal_id;
    if(response.success){
      $('#DealItemCategory, #DealItemProduct, #DealItemSize, #DealItemModifier').val(''); 
      $.ajax({
        url:'<?php echo WEBROOT ?>deals/getDealItemList/'+dealId,
        method:'GET',
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
          $('.deal_id').val(dealId);
          $('#group-items').html(response);
          $('#manage-requirment').hide();
          $('#manage-group').show();
          $.loadingBlockHide();
        }

      });
    }
  }

  function makegGroupResponse(data,textStatus){
    var data = $.parseJSON(data);
    var dealId = data.deal_id;
    if(data.success){
        $.ajax({
        url:'<?php echo WEBROOT ?>deals/getDealItemList/'+dealId,
        method:'GET',
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
          $('.deal_id').val(dealId);
          $('#group-items').html(response);
          $('#manage-requirment').hide();
          $.loadingBlockHide();
        }

      });
    }
  }

  function saveDealResponse(data,textStatus){
    var data = $.parseJSON(data);
    if(data.isSuccess){
      alert('Thanks, Deal added successfully.');
      window.location.href = 'index';
    }
  }


</script>