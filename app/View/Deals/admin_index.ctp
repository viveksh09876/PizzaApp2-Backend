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
			<?php echo $this->Session->flash(); ?>
			<div class="box box-primary">
			<?php if(!empty($Deals)){?>
			<table class="table table-hover">
				<tr><th><?php echo $this->Paginator->sort('title');?></th><th><?php echo $this->Paginator->sort('code');?></th><th><?php echo $this->Paginator->sort('status');?></th><th class="pull-right"><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($Deals as $Deal):
				?>
				<tr>
					<td><?php echo $Deal['Deal']['title']; ?></td>
					<td><?php echo $Deal['Deal']['code']; ?></td>
					<td><?php echo getActiveInactive($Deal['Deal']['status']); ?></td>
					<td class="pull-right">
						<?php echo $this->Html->link(__('Add more requirments', true), array('action' => 'add', $Deal['Deal']['id']),array('class'=>'btn btn-default btn-sm btn-info')); ?>
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $Deal['Deal']['id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
						<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $Deal['Deal']['id']),array('class'=>'btn btn-default btn-sm btn-danger','onclick'=>'return confirm("Are you sure want to delete?")')); ?>
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
