<?php
App::uses('String', 'Utility');
?>
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
				<?php if(!empty($contents)){?>
				<table class="table table-hover">
					<tr>
						<th><?php echo $this->Paginator->sort('page_title'); ?></th>
						<th width="50%"><?php echo $this->Paginator->sort('page_content'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
					    <th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php
					foreach ($contents as $content): ?>
					<tr>
						<td width="300px"><?php echo h($content['Content']['page_title']); ?>&nbsp;</td>
						<td><?php echo String::truncate($content['Content']['page_content'],200,array('ellipsis' => '...','exact' => true,'html' => false));?>&nbsp;</td>
						<td><?php echo h($content['Content']['status']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link(__('View', true), array('action' => 'view', $content['Content']['page_id']),array('class'=>'btn btn-default btn-sm btn-info')); ?>
							<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $content['Content']['page_id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
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