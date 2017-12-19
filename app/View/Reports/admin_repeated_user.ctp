<?php 
//pr($out['repeatedUserOrdersDetail']);
 ?>
<section class="content">
<a href="<?php echo $this->webroot;?>admin/reports">Back</a>
<h3>All Repeated Users <?php if($out['store']){?>By Store <?php echo $out['store'];?><?php }?></h3>
<table class="table">
<thead class="thead-light">
<tr><th>#</th><th>User Name</th><th>Total Orders</th></tr>
</thead>
<?php $i=1;foreach($out['repeatedUser'] as $rUser){?>
<tr>
<td><?php echo $i;?></td>
	<td><a href="<?php echo $this->webroot;?>admin/reports/ordersDetail/<?php echo $rUser['NewOrderhistory']['UserId'];?>"><?php echo $rUser['Ecuser']['FirstName'].' '.$rUser['Ecuser']['LastName'];?></a> </td><td><strong><?php echo $rUser['NewOrderhistory']['count'];?></strong></td>
	</tr>
<?php $i++;}?>
</table>
</section>
<div class="clearfix"></div>
    

      

 