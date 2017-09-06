<section class="content-header">
  <h1>
    <?php echo __('Users');?>
    <small>List of register users</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN_WEBROOT;?>home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo __('Users');?></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
			<?php if(isset($Users)){?>
			<table class="table table-hover">
				<tr><th><?php echo $this->Paginator->sort('first_name');?></th><th><?php echo $this->Paginator->sort('last_name');?></th><th><?php echo $this->Paginator->sort('email');?></th><th><?php echo $this->Paginator->sort('user_role_id','User Role');?></th><th><?php echo $this->Paginator->sort('user_status');?></th><th><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($Users as $user):
				?>
				<tr>
					<td><?php echo $user['User']['first_name']; ?></td>
					<td><?php echo $user['User']['last_name']; ?></td>
					<td><?php echo $user['User']['email']; ?></td>
					<td><?php echo $user['UserRole']['user_role_name']; ?></td>
					<td><?php echo $user['User']['user_status']; ?></td>
					<td><?php echo $this->Html->link(__('View', true), array('action' => 'view', $user['User']['user_id']),array('class'=>'btn btn-default btn-sm btn-info')); ?>
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $user['User']['user_id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
						<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['user_id']), array('class'=>'btn btn-default btn-sm btn-danger'), sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['user_id'])); ?>
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
