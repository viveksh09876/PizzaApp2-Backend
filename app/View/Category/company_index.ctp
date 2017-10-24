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
		<h4>Filter Records : </h4>
		<?php 
			echo $this->Form->create('Search',array('url'=>array('controller'=>'category','action'=>'index'),'type'=>'GET')); 
			echo $this->Form->input('store_id',array('options'=>$stores,'label'=>false,'class'=>'fl-left form-control','div'=>array('class'=>'col-md-3','style'=>'padding-left:0px;'),'empty'=>'All'));
			echo $this->Form->input('category_name',array('label'=>false,'class'=>'fl-left form-control','placeholder'=>'Category Name','div'=>array('class'=>'col-md-3')));
			echo $this->Form->submit(
			    'Search', 
			    array('div' => false,'class' => 'btn btn-primary', 'title' => 'Filter')
			);
			echo $this->Form->end();

			?>
			<hr>
			<div class="box box-primary clear">
			<?php if(!empty($Categories)){?>
			
			<table class="table table-hover">
				<tr><th><?php echo $this->Paginator->sort('store_id','Store Name');?></th><th><?php echo $this->Paginator->sort('name','Category Name');?></th><th><?php echo $this->Paginator->sort('short_description');?></th><th><?php echo $this->Paginator->sort('image');?></th><th><?php echo $this->Paginator->sort('sort_order');?></th><th><?php echo $this->Paginator->sort('status');?></th><th class="pull-right"><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($Categories as $category):
				?>
				<tr>
					<td><?php echo $this->General->getStoreNameById($category['Category']['store_id']); ?></td>
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
