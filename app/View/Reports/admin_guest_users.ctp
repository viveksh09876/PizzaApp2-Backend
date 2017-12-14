<?php 

//pr($out['users']);
$pages= $this->Paginator->counter('{:pages}');
$page= $this->Paginator->counter('{:page}');
$limit=$this->Paginator->params();
//print_r($this->request->params['pass'][0]);
$fields=array('Email'=>'Email','Phone'=>'Phone','DOB'=>'DOB','Address'=>'Address','PostalCode'=>'Postal Code','FavLocation'=>'Favorite Location');

 ?>
<section class="content">
<div class="">
<label>Show</label>
<select id="show" onChange="changePage();" name="limit">
<option value="25" <?php if($this->request->params['pass'][0]==25){ echo 'selected="selected"';}?>>25</option>
<option value="50" <?php if($this->request->params['pass'][0]==50){ echo 'selected="selected"';}?>>50</option>
<option value="100" <?php if($this->request->params['pass'][0]==100){ echo 'selected="selected"';}?>>100</option>
<option value="all" <?php if($this->request->params['pass'][0]=='all'){ echo 'selected="selected"';}?>>All</option>
</select>
</div>
<a class="btn btn-primary" href="<?php echo $this->webroot;?>admin/reports">Back</a>
<button class="btn btn-primary" type="button" onclick="tableToExcel('table', 'Guest Users')">Export in Excel</button>

<h3>All Users </h3>
<table class="table" id="table">

<thead class="thead-light">
<tr><th>#</th><th>Phone</th><th>Email</th><th>Address</th></tr>
</thead>
<?php $i=1;foreach($out['users'] as $user){ ?>
<tr><td><?php echo (($page-1)*$limit['limit'])+$i; ?></td>
<td><?php echo $user['NewOrderhistory']['phone'];?></td>
<td><?php echo $user['NewOrderhistory']['email'];?></td>
<td>
<?php $address=json_decode($user['NewOrderhistory']['address'],true);
	echo $address['apartment']?'<span><strong>Apartment - </strong>'.$address['apartment'].'</span> ':'';
	echo $address['street_no']?'<span><strong>Street No - </strong>'.$address['street_no'].'</span> ':'';
	echo $address['street']?'<span><strong>Street - </strong>'.$address['street'].'</span> ':'';
	echo $address['city']?'<span><strong>City - </strong>'.$address['city'].'</span> ':'';
	echo $address['state']?'<span><strong>State - </strong>'.$address['state'].'</span> ':'';
	echo $address['postal_code']?'<span><strong>Postal Code - </strong>'.$address['postal_code'].'</span> ':'';
?>

</td>
</tr>
<?php $i++;}?>
</table>
<?php if($pages>1){?>
<ul class="pagination">
<li><?php echo $this->Paginator->first('<< First');?></li>
<?php echo $this->Paginator->numbers(array('tag'=>'li','separator'=>'','currentTag'=>'span'));?>
<li><?php echo $this->Paginator->last('Last >>');?></li>
</ul>
<?php } ?>
</section>
<div class="clearfix"></div>
<style>
td span{ width:100%;display: block;}
td.defaultAdd{border:1px solid #7a994a !important;}
</style>
<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()

function changePage(){
var val=jQuery('#show').val();
window.location.href='<?php echo $this->webroot;?>admin/reports/guestUsers/'+val;
}

</script>   

 