<?php

 ?>
<section class="content">
<a href="<?php echo $this->webroot;?>admin/reports/repeatedUser">Back</a>
<div>
<h3>Total Orders Details by <?php echo $out['repeatedUserOrdersDetail'][0]['Ecuser']['FirstName'].' '.$out['repeatedUserOrdersDetail'][0]['Ecuser']['LastName'];?></h3>
<h4>Total Orders : <?php echo count($out['repeatedUserOrdersDetail']);?></h4>
<h4>Orders Details</h4>
<table class="table">
<thead class="thead-light">
<tr><th>#</th><th>Store Name</th><th>Used coupon</th><!--<th>Coupon Discount</th>--><th>Deal Id</th><th>Discount</th> <th>Total Price</th><th>Order Date</th></tr>
</thead>
<?php $i=1; foreach($out['repeatedUserOrdersDetail'] as $order){ ?>
<tr><td><?php echo $i;?></td><td><?php echo $order['NewOrderhistory']['storeId'];?></td>
<?php if(strpos($order['NewOrderhistory']['coupon'], 'NKDSCOT') !== false){?>
<td>NKDSCOT</td>
<?php }else{?>
<td><?php echo $order['NewOrderhistory']['coupon']?$order['NewOrderhistory']['coupon']:'NA';?></td>
<?php }?>
<!--
<td><?php //echo $order['NewOrderhistory']['couponDiscount']?$order['NewOrderhistory']['couponDiscount']:'NA';?></td>
-->
<td><?php echo $order['NewOrderhistory']['dealId']?$order['NewOrderhistory']['dealId']:'NA';?></td><td><?php echo $order['NewOrderhistory']['discount'];?></td><td><?php echo $order['NewOrderhistory']['total_price'];?></td><td><?php echo $this->Time->format('F jS, Y h:i A',$order['NewOrderhistory']['Created_data']);?></td></tr>
<?php $i++;}?>
</table>
</div>
</section>
<div class="clearfix"></div>
    

      

 