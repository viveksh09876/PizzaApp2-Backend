<?php 
//pr($out['guestRepeatedUser']);
 ?>
 <?php extract($pageVar); ?>
<div class="col-md-12" style="margin-bottom:5%;">
	<section class="content-header">
		<h1><?=$title?></h1>
		<ol class="breadcrumb">
			<?=$breadcrumb?>
		</ol>
	</section>
</div>
<section class="content">
<div>
<a class="btn btn-primary" href="<?php echo $this->webroot;?>admin/reports/users">Show Registered Users</a>
<a class="btn btn-primary" href="<?php echo $this->webroot;?>admin/reports/guestUsers">Show Guest Users</a>
<a id="synBtn" class="btn btn-primary pull-right" href="javascript:void(0)" onClick="synData()">Synchronize Data</a>
</div>
<div class="col">
<h3>Total Orders</h3>
<canvas id="total_ord">hello</canvas>
</div>
<div class="col">
<h3>Total Placed Orders By Store</h3>
<canvas id="total_ord_store"></canvas>
<?php foreach($out['placedOrderByStore'] as $coup){ 
$label[]=$coup['NewOrderhistory']['storeId'];
$data[]=$coup['NewOrderhistory']['count'];
?>
<?php }?>
</div>
<div class="col">
<h3>Used Coupons By Store</h3>
<?php foreach($out['totleUseCoupon'] as $key=>$val){ $count=0;?>
<h4>Store Id : <?php echo $key;?></h4>
<?php foreach($val as $coup){
	if(strpos($coup['coupon'], 'NKDSCOT') !== false){
		$count += $coup['count'];
	?>
<!--<span style='width:100%;display: inline-block;' ><?php //echo 'NKDSCOT';?> : <strong><?php //echo $count;?></strong></span>	-->
<?php }else{
	$couponLab[]=$coup['coupon'];
	$couponCount[]=$coup['count'];
?>
<!--<span style='width:100%;display: inline-block;' ><?php //echo $coup['coupon'];?> : <strong><?php //echo $coup['count'];?></strong></span>-->
<?php }
}
if($count>0){
$couponLab[]='NKDSCOT';
$couponCount[]=$count;
}
$couponData[$key]['label']=$couponLab;
$couponData[$key]['count']=$couponCount;
//pr($couponLab);
//pr($couponData);
 ?>
 <canvas id="<?php echo $key;?>"></canvas>
<?php } ?>
</div>
<div class="col">
<h3>Repeated Users</h3>
<canvas id="reg_user"></canvas>
<h4><a class="btn btn-primary pull-right" href="<?php echo $this->webroot;?>admin/reports/repeatedUser">Show</a></h4>
</div>

<div class="col">
<h3>Repeated Users By Store</h3>
<?php foreach($out['repeatedUserbyStore'] as $key=>$users){?>
<h4>Store Id : <?php echo $key;?></h4>
<canvas id="reg_user_<?php echo $key;?>"></canvas>
<h4><a href="<?php echo $this->webroot;?>admin/reports/repeatedUser/<?php echo $key;?>" class="btn btn-primary pull-right">Show</a></h4>
<?php }?>
</div>
</section>
<div class="clearfix"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
<script>
window.chartColors = {
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)',
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)'
};
var chColor=['rgb(75, 192, 192)','rgb(54, 162, 235)','rgb(153, 102, 255)','rgb(201, 203, 207)','rgb(255, 99, 132)','rgb(255, 159, 64)','rgb(255, 205, 86)'];
jQuery(function(){
	var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [<?php echo $out['startedOrder']; ?>,<?php echo $out['placedOrder']; ?>],
                backgroundColor: chColor,
                label: 'Dataset 1'
            }],
            labels: ["Started Orders :<?php echo $out['startedOrder']; ?>","Placed Orders :<?php echo $out['placedOrder']; ?>"]
        },
        options: {
            responsive: true
        }
    };
 var ctx = document.getElementById("total_ord");
 window.myPie = new Chart(ctx, config);
  
  var config1 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: <?php echo json_encode($data);?>,
                backgroundColor: chColor,
                label: 'Dataset 1'
            }],
            labels: <?php echo json_encode($label);?>
        },
        options: {
            responsive: true
        }
    };
 var ctx1 = document.getElementById("total_ord_store");
 window.myPie = new Chart(ctx1, config1);
 
  var config2 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [<?php echo $out['repeatedUser']['count'];?>,<?php echo $out['repeatedUser2']['count'];?>],
                backgroundColor: chColor,
                label: 'Dataset 1'
            }],
            labels:['Registered','Guest']
        },
        options: {
            responsive: true
        }
    };
 var ctx2 = document.getElementById("reg_user");
 window.myPie = new Chart(ctx2, config2);
 
<?php foreach($couponData as $key=>$data){?>
var id='<?php echo $key;?>';
var barChartData = {
            labels: <?php echo json_encode($data['label']);?>,
            datasets: [{
                label: id,
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data:<?php echo json_encode($data['count']);?>
            }]

        };
barChartGen(barChartData,id);
<?php }?>
<?php foreach($out['repeatedUserbyStore'] as $key=>$users){?>
var u_data=[<?php echo count($users);?>,<?php echo count($out['guestRepeatedUser'][$key]);?>];
var chId='reg_user_<?php echo $key;?>';
var u_label=['Registered','Guest'];
piChartGen(u_data,chId,u_label);
<?php }?>

});
 var color = Chart.helpers.color;
function barChartGen(data,cid){
	var ctx2 = document.getElementById(cid);
            window.myBar = new Chart(ctx2, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    }
                }
            });
}

function piChartGen(data,id,labels){
		var config_dy = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: data,
                backgroundColor: chColor,
                label: 'Dataset 1'
            }],
            labels: labels
        },
        options: {
            responsive: true
        }
    };
 var ctx_dy = document.getElementById(id);
 window.myPie = new Chart(ctx_dy, config_dy);
}




function synData(){
	var data='';
$.ajax({
		method:'POST',
		url:'<?php echo $this->webroot;?>admin/reports/importOrderHistory',
		data:data,
		beforeSend:function(){
			$('#synBtn').html('Please Wait...');
		},
		success:function(res){
				$('#synBtn').html(res);
		},
		error: function (error) {
			alert('Error:A internal error, please try again.');
			$('#synBtn').html('Synchronize Data');
		}
	});
}
</script>
<style>
.col{width:50%;float:left}

</style>

      

 