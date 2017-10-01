<?php 
extract($pageVar); //pr($pageVar); 

if(!empty($dealCombinations)){
	$dealName = '';
	foreach ($dealCombinations as $key => $value) {
		if(!empty($value['DealGroup1Item1']['product_plu'])){
			$DealGroup1Item1 = $this->General->getProductName($value['DealGroup1Item1']['product_plu']);
		}else{
			$catId = $value['DealGroup1Item1']['cat_id'];
			$size = $value['DealGroup1Item1']['size'];
			switch ($catId) {
				case '1':
					$DealGroup1Item1 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealGroup1Item1']['cat_id']);
					break;
				
				default:
					$DealGroup1Item1 = $this->General->getCategoryNameById($value['DealGroup1Item1']['cat_id']);
					break;
			}	
		}


		if(!empty($value['DealGroup1Item2']['product_plu'])){
			$DealGroup1Item2 = $this->General->getProductName($value['DealGroup1Item2']['product_plu']);
		}else{
			$catId = $value['DealGroup1Item2']['cat_id'];
			$size = $value['DealGroup1Item2']['size'];
			switch ($catId) {
				case '1':
					$DealGroup1Item2 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealGroup1Item2']['cat_id']);
					break;
				
				default:
					$DealGroup1Item2 = $this->General->getCategoryNameById($value['DealGroup1Item2']['cat_id']);
					break;
			}	
		}

		if(!empty($value['DealGroup2Item1']['product_plu'])){
			$DealGroup2Item1 = $this->General->getProductName($value['DealGroup2Item1']['product_plu']);
		}else{
			$catId = $value['DealGroup2Item1']['cat_id'];
			$size = $value['DealGroup2Item1']['size'];
			switch ($catId) {
				case '1':
					$DealGroup2Item1 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealGroup2Item1']['cat_id']);
					break;
				
				default:
					$DealGroup2Item1 = $this->General->getCategoryNameById($value['DealGroup2Item1']['cat_id']);
					break;
			}	
		}

		if(!empty($value['DealGroup2Item2']['product_plu'])){
			$DealGroup2Item2 = $this->General->getProductName($value['DealGroup2Item2']['product_plu']);
		}else{
			$catId = $value['DealGroup2Item2']['cat_id'];
			$size = $value['DealGroup2Item2']['size'];
			switch ($catId) {
				case '1':
					$DealGroup2Item2 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealGroup2Item2']['cat_id']);
					break;
				
				default:
					$DealGroup2Item2 = $this->General->getCategoryNameById($value['DealGroup2Item2']['cat_id']);
					break;
			}	
		}

		if(!empty($value['DealItem1']['product_plu'])){
			$DealItem1 = $this->General->getProductName($value['DealItem1']['product_plu']);
		}else{
			$catId = $value['DealItem1']['cat_id'];
			$size = $value['DealItem1']['size'];
			switch ($catId) {
				case '1':
					$DealItem1 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealItem1']['cat_id']);
					break;
				
				default:
					$DealItem1 = $this->General->getCategoryNameById($value['DealItem1']['cat_id']);
					break;
			}	
		}

		if(!empty($value['DealItem2']['product_plu'])){
			$DealItem2 = $this->General->getProductName($value['DealItem2']['product_plu']);
		}else{
			$catId = $value['DealItem2']['cat_id'];
			$size = $value['DealItem2']['size'];
			switch ($catId) {
				case '1':
					$DealItem2 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealItem2']['cat_id']);
					break;
				
				default:
					$DealItem2 = $this->General->getCategoryNameById($value['DealItem2']['cat_id']);
					break;
			}	
		}

		$group1cond = $value['DealGroup1']['cond'];
		$group2cond = $value['DealGroup2']['cond'];
		$combinationCond =  $value['DealCombination']['cond'];
		
		if(!empty($value['DealCombination']['group1']) && !empty($value['DealCombination']['group2'])){
			$dealName = '('.$DealGroup1Item1.' '.$group1cond.' '.$DealGroup1Item2.')'.' '.$combinationCond.' ('.$DealGroup2Item1.' '.$group2cond.' '.$DealGroup2Item2.')';
		}elseif(!empty($value['DealCombination']['group1'])){
			if(!empty($DealItem1)){
				$dealName = '('.$DealGroup1Item1.' '.$group1cond.' '.$DealGroup1Item2.')'.' '.$combinationCond.' ('.$DealItem1.')';
			}
			if(!empty($DealItem2)){
				$dealName = '('.$DealGroup1Item1.' '.$group1cond.' '.$DealGroup1Item2.')'.' '.$combinationCond.' ('.$DealItem2.')';

			}
		}elseif(!empty($value['DealCombination']['group2'])){
			if(!empty($DealItem1)){
				$dealName = '('.$DealGroup2Item1.' '.$group2cond.' '.$DealGroup2Item2.')'.' '.$combinationCond.' ('.$DealItem1.')';
			}
			if(!empty($DealItem2)){
				$dealName = '('.$DealGroup2Item1.' '.$group2cond.' '.$DealGroup2Item2.')'.' '.$combinationCond.' ('.$DealItem2.')';

			}
		}
?>
	<input type="checkbox" class="deal-item-group-comb" name="data[DealGroup][deal_combination_id][]" value="<?php echo $value['DealCombination']['id']; ?>"><?php echo '('.$dealName.')'; ?><br> 	
<?php	# code...
	}
}

if(!empty($dealGroups)){
	foreach ($dealGroups as $key => $value) {
		if(!empty($value['DealItem1']['product_plu'])){
			$dealitem1 = $this->General->getProductName($value['DealItem1']['product_plu']);
		}else{
			$catId = $value['DealItem1']['cat_id'];
			$size = $value['DealItem1']['size'];
			switch ($catId) {
				case '1':
					$dealitem1 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealItem1']['cat_id']);
					break;
				
				default:
					$dealitem1 = $this->General->getCategoryNameById($value['DealItem1']['cat_id']);
					break;
			}
		}

		if(!empty($value['DealItem2']['product_plu'])){
			$dealitem2 = $this->General->getProductName($value['DealItem2']['product_plu']);
		}else{
			$catId = $value['DealItem2']['cat_id'];
			$size = $value['DealItem2']['size'];
			switch ($catId) {
				case '1':
					$dealitem2 = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealItem2']['cat_id']);
					break;
				
				default:
					$dealitem2 = $this->General->getCategoryNameById($value['DealItem2']['cat_id']);
					break;
			}	
		}
		$cond = $value['DealGroup']['cond'];
?>
	<input type="checkbox" class="deal-item-group-comb" name="data[DealGroup][deal_group_id][]" value="<?php echo $value['DealGroup']['id']; ?>"><?php echo '('.$dealitem1 .' '.$cond.' '.$dealitem2.')'; ?><br> 	
<?php	# code...
	}
}

if(!empty($dealItems)){
	foreach ($dealItems as $key => $value) {
		if(!empty($value['DealItem']['product_plu'])){
			$itemName = $this->General->getProductName($value['DealItem']['product_plu']);
		}else{
			$catId = $value['DealItem']['cat_id'];
			$size = $value['DealItem']['size'];
			switch ($catId) {
				case '1':
					$itemName = getPizzaSize($size).' '.$this->General->getCategoryNameById($value['DealItem']['cat_id']);
					break;
				
				default:
					$itemName = $this->General->getCategoryNameById($value['DealItem']['cat_id']);
					break;
			}
		}
	?>
		<input type="checkbox" class="deal-item-group-comb" name="data[DealGroup][deal_item_id][]" value="<?php echo $value['DealItem']['id']; ?>"><?php echo $itemName; ?><br>	
	<?php
	}
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#DealGroupAdminAddForm input[type="submit"]').prop("disabled", true);
		var limit = 2;
		$('.deal-item-group-comb').on('change', function(evt) {
			var checkedLn = $(this).siblings(':checked').length;
			if(checkedLn==1){
				$('#DealGroupAdminAddForm input[type="submit"]').prop("disabled", false);
			}else{
				$('#DealGroupAdminAddForm input[type="submit"]').prop("disabled", true);
			}

		   	if(checkedLn >= limit) {
		   		$('#DealGroupAdminAddForm input[type="submit"]').prop("disabled", false);
		       	this.checked = false;
		       	alert('Allow only ' +limit+ ' items.');
		   }
		});
	});
	
</script>