<?php extract($pageVar); //pr($Categories); ?>
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
			<h4>Filter Records : </h4>
			<?php 
				echo $this->Form->create('Search',array('url'=>array('controller'=>'coupons','action'=>'index'),'type'=>'GET')); 
				echo $this->Form->input('store_id',array('options'=>$stores,'label'=>false,'class'=>'fl-left form-control','div'=>array('class'=>'col-md-3','style'=>'padding-left:0px;'),'empty'=>'All'));
				echo $this->Form->input('coupon_code',array('label'=>false,'class'=>'fl-left form-control','placeholder'=>'Coupon Code','div'=>array('class'=>'col-md-3')));
				echo $this->Form->button('<i class="fa fa-search"></i>', array(
				    'type' => 'submit', 
				    'class' => 'btn btn-primary', 
				    'escape' => false
				));
				echo $this->Form->end();
			?>
			<hr>
			<div class="box box-primary">
			<?php if(!empty($Coupons)){?>
			<table class="table table-hover">
				<tr><th><?php echo $this->Paginator->sort('store_id','Store Name');?></th><th><?php echo $this->Paginator->sort('coupon_name');?></th><th><?php echo $this->Paginator->sort('coupon_code');?></th><th><?php echo $this->Paginator->sort('application');?></th><th><?php echo $this->Paginator->sort('description');?></th><th><?php echo $this->Paginator->sort('status');?></th><th class="pull-right"><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($Coupons as $Coupon):
				?>
				<tr>
					<td><?php echo $this->General->getStoreNameById($Coupon['Coupon']['store_id']); ?></td>
					<td><?php echo $Coupon['Coupon']['coupon_name']; ?></td>
					<td><?php echo $Coupon['Coupon']['coupon_code']; ?></td>
					<td><?php echo $Coupon['Coupon']['application']; ?></td>
					<td><?php echo $Coupon['Coupon']['description']; ?></td>
					<td><?php echo getActiveInactive($Coupon['Coupon']['status']); ?></td>
					<td class="pull-right">
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $Coupon['Coupon']['id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<div class="pull-left">
				<p>
				<?php
				echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
				));
				?>	
				</p>
			</div>
			<div class="paging pull-right">
				<?php echo $this->Paginator->prev('<< ' . __('previous', true), array('class'=>'btn btn-primary'), null, array('class'=>'disabled btn btn-default'));?>
			 | 	<?php echo $this->Paginator->numbers();?>
		 	 |	<?php echo $this->Paginator->next(__('next', true) . ' >>', array('class'=>'btn btn-primary'), null, array('class' => 'disabled  btn btn-default'));?>
			</div>
			<?php }else{ ?>
				<div class="alert alert-danger">Records not found.</div>
			<?php	} ?>
			</div>
		</div>
	</div>
</section>
