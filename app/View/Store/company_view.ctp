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
        <div class="box-body">
         <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store ID : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_id']?>
       </div>
     </div>
       <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Name : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_name']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Address : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_address']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store IP Address : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_ip_address']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Open Port : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_open_port']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Connection Certification : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_connection_certificate']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Phone : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_phone']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Email : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['store_email']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store City : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['city']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store State : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['state']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Country : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['country']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Latitude : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['latitude']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Logitude : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['longitude']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Delivery Radius : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['delivery_radius']?>
       </div>
     </div>
     <div class="form-group col-sm-6">
        <label class="col-sm-6 control-label">Store Notification Email : </label>
        <div class="col-sm-6">
          <?=$storeData['Store']['notification_email']?>
       </div>
     </div>
    <div class="form-group col-sm-6">
      <label class="col-sm-6 control-label">POS Type : </label>
      <div class="col-sm-6">
        <?=$storeData['Store']['pos_type']?>
     </div>
    </div>
    
    <div class="form-group col-sm-6 clear">
      <label class="col-sm-6 control-label">Link : </label>
      <div class="col-sm-6">
        <?=$storeData['Store']['link']?>
     </div>
   </div>
   <div class="form-group col-sm-6">
      <label class="col-sm-6 control-label">Status : </label>
      <div class="col-sm-6">
        <?=getActiveInactive($storeData['Store']['status'])?>
     </div>
    </div>

</div><!-- /.box-body -->
</div>
</div>
</div>
</section>