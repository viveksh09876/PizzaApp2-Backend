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
			<?php if(isset($EmailTemplate)){?>
			<table class="table table-hover">
				<tr><th><?php echo $this->Paginator->sort('template_name');?></th><th><?php echo $this->Paginator->sort('template_key');?></th><th><?php echo $this->Paginator->sort('email_subject');?></th><th><?php echo $this->Paginator->sort('email_body');?></th><th width="16%"><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($EmailTemplate as $et):
				?>
				<tr>
					<td><?php echo $et['EmailTemplate']['template_name']; ?></td>
					<td><?php echo $et['EmailTemplate']['template_key']; ?></td>
					<td><?php echo $et['EmailTemplate']['email_subject']; ?></td>
					<td><?php echo $et['EmailTemplate']['email_body']; ?></td>
					<td><?php echo $this->Html->link(__('View', true), array('action' => 'view', $et['EmailTemplate']['template_id']),array('class'=>'btn btn-default btn-sm btn-info')); ?>
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $et['EmailTemplate']['template_id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
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
