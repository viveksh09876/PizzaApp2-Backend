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
			<?php if(!empty($Stores)){?>
			<table class="table table-hover">
				<tr><th><?php echo $this->Paginator->sort('store_id', 'Store ID');?></th><th><?php echo $this->Paginator->sort('store_name');?></th><th><?php echo $this->Paginator->sort('store_address');?></th><th><?php echo $this->Paginator->sort('store_phone');?></th><th><?php echo $this->Paginator->sort('store_email');?></th><th><?php echo $this->Paginator->sort('status');?></th><th class="pull-right"><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($Stores as $Store):
				?>
				<tr>
					<td><?php echo $Store['Store']['store_id']; ?></td>
					<td><?php echo $Store['Store']['store_name']; ?></td>
					<td><?php echo $Store['Store']['store_address']; ?></td>
					<td><?php echo $Store['Store']['store_phone']; ?></td>
					<td><?php echo $Store['Store']['store_email']; ?></td>
					<td><?php echo getActiveInactive($Store['Store']['status']); ?></td>
					<td class="pull-right">
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $Store['Store']['id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
						<?php echo $this->Html->link(__('view', true), array('action' => 'view', $Store['Store']['id']),array('class'=>'btn btn-primary btn-sm')); ?>
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
