<?php 

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
<form action="<?php echo $this->here;?>" method="get">
<?php foreach($fields as $key=>$field){?>
<label><input type="checkbox" name="<?php echo $key;?>" <?php if($this->request->query[$key]=='on'){echo 'checked="checked"';}?> /> <?php echo $field;?></label>
<?php }?>
<button class="btn btn-primary" type="submit">Submit</button>
</form>
<a class="btn btn-primary" href="<?php echo $this->webroot;?>admin/reports">Back</a>
<button class="btn btn-primary" type="button" onclick="tableToExcel('table', 'Users')">Export in Excel</button>

<h3>All Users </h3>
<table class="table" id="table">
<?php if($selectedFields=$this->request->query){?>
<thead class="thead-light">
<tr>
<th>#</th>
<th>First Name</th>
<th>Last Name</th>
<?php foreach($selectedFields as $sfiels=>$val){?>
<?php if($sfiels=='Address'){ ?>
<th>Address 1</th>
<th>Address 2</th>
<th>Address 3</th>
<?php }else{?>
<th><?php echo $fields[$sfiels];?></th>
<?php }?>
<?php }?>
</tr>
<?php $i=1;foreach($out['users'] as $user){  //$user['Ecuser']['Id'];?>
<tr>
<td><?php echo (($page-1)*$limit['limit'])+$i; ?></td>
<td><?php echo $user['Ecuser']['FirstName'];?></td>
<td><?php echo $user['Ecuser']['LastName'];?></td>
<?php foreach($selectedFields as $sfiels=>$val){?>
<?php if($sfiels=='Address'){
	$addr1=json_decode($user['Ecuser']['Address1'],true);
	$addr2=json_decode($user['Ecuser']['Address2'],true);
	$addr3=json_decode($user['Ecuser']['Address3'],true);
?>
<td <?php if($addr1['is_default']==1){echo 'class="defaultAdd"';}?>><?php 
//print_r($addr1);
			echo $addr1['address_type']?'<span><strong>Address Type - </strong>'.$addr1['address_type'].'</span> ':'';
			echo $addr1['apartment']?'<span><strong>Apartment - </strong>'.$addr1['apartment'].'</span> ':'';
			echo $addr1['streetNo']?'<span><strong>Street No - </strong>'.$addr1['streetNo'].'</span> ':'';
			echo $addr1['street']?'<span><strong>Street - </strong>'.$addr1['street'].'</span> ':'';
			echo $addr1['city']?'<span><strong>City - </strong>'.$addr1['city'].'</span> ':'';
			echo $addr1['state']?'<span><strong>State - </strong>'.$addr1['state'].'</span> ':'';
?></td>
<td <?php if($addr2['is_default']==1){echo 'class="defaultAdd"';}?>>
<?php 
			echo $addr2['address_type']?'<span><strong>Address Type - </strong>'.$addr2['address_type'].'</span> ':'';
			echo $addr2['apartment']?'<span><strong>Apartment - </strong>'.$addr2['apartment'].'</span> ':'';
			echo $addr2['streetNo']?'<span><strong>Street No - </strong>'.$addr2['streetNo'].'</span> ':'';
			echo $addr2['street']?'<span><strong>Street - </strong>'.$addr2['street'].'</span> ':'';
			echo $addr2['city']?'<span><strong>City - </strong>'.$addr2['city'].'</span> ':'';
			echo $addr2['state']?'<span><strong>State - </strong>'.$addr2['state'].'</span> ':'';
?></td>
<td <?php if($addr3['is_default']==1){echo 'class="defaultAdd"';}?>>
<?php 
//pr($addr3);
			echo $addr3['address_type']?'<span><strong>Address Type - </strong>'.$addr3['address_type'].'</span> ':'';
			echo $addr3['apartment']?'<span><strong>Apartment - </strong>'.$addr3['apartment'].'</span> ':'';
			echo $addr3['streetNo']?'<span><strong>Street No - </strong>'.$addr3['streetNo'].'</span> ':'';
			echo $addr3['street']?'<span><strong>Street - </strong>'.$addr3['street'].'</span> ':'';
			echo $addr3['city']?'<span><strong>City - </strong>'.$addr3['city'].'</span> ':'';
			echo $addr3['state']?'<span><strong>State - </strong>'.$addr3['state'].'</span> ':'';
?></td>
<?php }else{?>
<td><?php echo $user['Ecuser'][$sfiels]?$user['Ecuser'][$sfiels]:'NA';?></td>
<?php }?>
<?php }?>
</tr>
<?php $i++;}?>
</thead>
<?php }else{?>
<thead class="thead-light">
<tr><th>#</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th></tr>
</thead>
<?php $i=1;foreach($out['users'] as $user){ ?>
<tr><td><?php echo (($page-1)*$limit['limit'])+$i; ?></td>
<td><?php echo $user['Ecuser']['FirstName'];?></td>
<td><?php echo $user['Ecuser']['LastName'];?></td>
<td><?php echo $user['Ecuser']['Email'];?></td>
<td><?php echo $user['Ecuser']['Phone'];?></td>

</tr>
<?php $i++;}?>
<?php } ?>
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
window.location.href='<?php echo $this->webroot;?>admin/reports/users/'+val;
}

</script>   

 