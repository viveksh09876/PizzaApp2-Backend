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
				<?php echo $this->Form->create('Deal',array('type'=>'file','id'=>'AddEditDeal'));?>
        <div class="box-body">
          <div id="add-deal-sec">
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('title', array('label'=>'Title','class'=>'form-control','title'=>'Please enter title.','required'=>true,'placeholder'=>'Title')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('image_text', array('label'=>'Image Text','class'=>'form-control','title'=>'Please enter image text.','placeholder'=>'Image Text')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('code', array('label'=>'Code','class'=>'form-control','title'=>'Please enter code.','required'=>true,'placeholder'=>'Code')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php echo $this->Form->input('price', array('label'=>'Overall Price','class'=>'form-control','title'=>'Please enter deal overall price.','placeholder'=>'Overall Price')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <label>List Image</label>
              <?php echo $this->Form->file('thumbnail', array('title'=>'Please upload list image.')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <label>Details Image</label>
              <?php echo $this->Form->file('image', array('title'=>'Please upload details image.')); ?>
            </div>
          </div>
          <div class="form-group col-sm-4 clear">
            <div class="col-sm-12">
              <?php echo $this->Form->input('status', array('label'=>'Status','options'=>ActiveInactive(),'class'=>'form-control')); ?>
            </div>
          </div>
          <div class="form-group col-sm-12">
            <div class="col-sm-12">
              <?php echo $this->Form->input('description', array('label'=>'Description','class'=>'form-control','title'=>'Please enter description.','required'=>true,'placeholder'=>'Description')); ?>
            </div>
          </div>
          
        </div>
          <?php  //pr($pageVar); ?>
        <?php 
          foreach ($pageVar['dealItems'] as $k => $dealI) {
        ?>
          <div class="col-sm-12">
              <?php
                echo $this->Form->input('id',array('type'=>'hidden','value'=>$dealI['DealItem']['id']));
                echo $this->Form->input('category',array('options'=>$categories,'class'=>'form-control col-sm-6','empty'=>'Select Category','selected'=>$dealI['DealItem']['cat_id'],'title'=>'Please select category','label'=>'Select Category','onchange88'=>'getProducts(this.value)','required'=>true));
                echo $this->Form->input('cat_text',array('class'=>'form-control col-sm-6','label'=>'Category Text','placeholder'=>'Category text','value'=>$dealI['DealItem']['cat_text']));

                echo '<div id="sizeSec" class="clear col-sm-12 ">';
                $attributes = array(
                    'legend' => false,
                );

                $i = 1;
                foreach ($sizes as $key => $value) {
                    echo $this->Form->input('size.', array(
                      'type'=>'checkbox',
                      'value'=>$key,
                      'label'=>$value,
                      'hiddenField'=>false,
                      'id'=>'',
                      'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
                    ) ); 
                    $i++;
                }

                echo '</div>';

                echo '<div id="crustSec" class="clear  col-sm-12">';
                $i = 1;
                foreach ($crusts as $key => $value) {
                    echo $this->Form->input('crust.', array(
                      'type'=>'checkbox',
                      'value'=>$key,
                      'label'=>$value,
                      'hiddenField'=>false,
                      'id'=>'',
                      'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
                    ) ); 
                    $i++;
                }
                echo '</div>';

                // pr($value);     
                echo $this->Form->input('product',array('options'=>array(),'class'=>'form-control col-sm-6','multiple'=>true,'label'=>'Select Product', 'empty'=>'Select Product','div'=>array('id'=>'productSec')));
                echo $this->Form->input('quantity',array('placeholder'=>'Product Quantity','class'=>'form-control col-sm-6','value'=>$dealI['DealItem']['quantity']));
                echo $this->Form->input('condition',array('label'=>'Select Condition', 'empty'=>'Select Condition','class'=>'form-control col-sm-6','options'=>conditions(),'selected'=>$dealI['DealItem']['item_condition']));
                echo $this->Form->input('status', array('label'=>'Status','class'=>'form-control col-sm-6','options'=>ActiveInactive(),'class'=>'form-control','selected'=>$dealI['DealItem']['status'])); 
              ?>
            </div>
          </hr>
        <?php
          }
        ?>
          
        <div class="form-group col-sm-4">
            <div class="col-sm-12">
              <?php  
              $options = array(
                'class'=>'btn btn-info'
              );
              echo $this->Form->submit('Continue',$options);
              echo $this->Form->end();
              ?>
            </div>
          </div>
        </div><!-- /.box-body -->
        <?php // echo $this->Form->end();?>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
    function dealValidate(){
      var validator = $( "#AddEditDeal" ).validate();
      if(validator.element( "#DealTitle") && validator.element( "#DealDescription") && validator.element( "#DealCode")){
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
      alert('fff');
      $('#DealItemProduct, #DealItemSize, #DealItemModifier, #sizeSec, #crustSec').val(''); 
      $('#modifierSec, #sizeSec, #productSec, #crustSec').hide();
      if(catId==1){
        $('#sizeSec').show();
        $('#crustSec').show();
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
          // $('#DealItemProduct').append($('<option value="">Select Product</option>'));
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

      $('.deal_id').val(dealId);
      $('#manage-requirment').hide();
      $('.addItemNotification').show();

      $('#DealItemCategory, #DealItemProduct, #DealItemSize, #DealItemModifier').val(''); 
      // $.ajax({
      //   url:'<?php // echo WEBROOT ?>deals/getDealItemList/'+dealId,
      //   method:'GET',
      //   beforeSend:function(){
      //     $.loadingBlockShow({
      //       imgPath: '<?=IMG?>icon.gif',
      //       text: 'Please Wait Loading ...',
      //       style: {
      //           position: 'fixed',
      //           width: '100%',
      //           height: '100%',
      //           background: 'rgba(0, 0, 0, .8)',
      //           left: 0,
      //           top: 0,
      //           zIndex: 10000
      //       }
      //     });
      //   },
      //   success:function(response){
      //     $('.deal_id').val(dealId);
      //     $('#group-items').html(response);
      //     $('#manage-requirment').hide();
      //     $('.addItemNotification').show();
      //    // $('#manage-group').show();
      //     $.loadingBlockHide();
      //   }

      // });
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