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
			<div class="box box-primary">
			<?php if(!empty($Categories)){?>
			<table class="table table-hover">
				<tr><!-- <th><?php // echo $this->Paginator->sort('lang_id','Language');?></th> --><th><?php echo $this->Paginator->sort('name','Category Name');?></th><th><?php echo $this->Paginator->sort('short_description');?></th><th><?php echo $this->Paginator->sort('image');?></th><th><?php echo $this->Paginator->sort('sort_order');?></th><th><?php echo $this->Paginator->sort('status');?></th><th class="pull-right"><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($Categories as $category):
				?>
				<tr>
					<!-- <td><?php // echo $category['Language']['name']; ?></td> -->
					<td><?php echo $category['Category']['name']; ?></td>
					<td><?php echo $category['Category']['short_description']; ?></td>
					<td>
					<?php if(!empty($category['Category']['image'])){ ?>
						<img src="<?=IMG_ADMIN.'categories/'.$category['Category']['image']; ?>" height="50" width="50" >
					<?php } ?>
					</td>
					<td><?php echo $category['Category']['sort_order']; ?></td>
					<td><?php echo getActiveInactive($category['Category']['status']); ?></td>
					<td class="pull-right">
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $category['Category']['id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
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
