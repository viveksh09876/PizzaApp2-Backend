<?php 
extract($pageVar); //pr($pageVar); 

if(!empty($dealCombinations)){
	$dealName = '';
	foreach ($dealCombinations as $key => $value) {
		$DealGroup1Item1 = $this->General->getProductName($value['DealGroup1Item1']['product_plu']);
		$DealGroup1Item2 = $this->General->getProductName($value['DealGroup1Item2']['product_plu']);
		$DealGroup2Item1 = $this->General->getProductName($value['DealGroup2Item1']['product_plu']);
		$DealGroup2Item2 = $this->General->getProductName($value['DealGroup2Item2']['product_plu']);
		$DealItem1 = $this->General->getProductName($value['DealItem1']['product_plu']);
		$DealItem2 = $this->General->getProductName($value['DealItem2']['product_plu']);
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
	<input type="checkbox" name="data[DealGroup][deal_combination_id][]" value="<?php echo $value['DealCombination']['id']; ?>"><?php echo '('.$dealName.')'; ?><br> 	
<?php	# code...
	}
}

if(!empty($dealGroups)){
	foreach ($dealGroups as $key => $value) {
		$dealitem1 = $this->General->getProductName($value['DealItem1']['product_plu']);
		$dealitem2 = $this->General->getProductName($value['DealItem2']['product_plu']);
		$cond = $value['DealGroup']['cond'];
?>
	<input type="checkbox" name="data[DealGroup][deal_group_id][]" value="<?php echo $value['DealGroup']['id']; ?>"><?php echo '('.$dealitem1 .' '.$cond.' '.$dealitem2.')'; ?><br> 	
<?php	# code...
	}
}

if(!empty($dealItems)){
	foreach ($dealItems as $key => $value) {
		$itemName = $this->General->getProductName($value['DealItem']['product_plu']);
	?>
		<input type="checkbox" name="data[DealGroup][deal_item_id][]" value="<?php echo $value['DealItem']['id']; ?>"><?php echo $itemName; ?><br>	
	<?php
	}
}
?>