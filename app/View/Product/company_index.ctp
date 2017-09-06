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
				echo $this->Form->create('Search',array('url'=>array('controller'=>'product','action'=>'index'),'type'=>'GET')); 
				echo $this->Form->input('store_id',array('options'=>$stores,'label'=>false,'class'=>'fl-left form-control','div'=>array('class'=>'col-md-3','style'=>'padding-left:0px;'),'empty'=>'All'));
				echo $this->Form->input('name',array('label'=>false,'class'=>'fl-left form-control','placeholder'=>'Product Name','div'=>array('class'=>'col-md-3')));
				echo $this->Form->submit(
				    'Search', 
				    array('div' => false,'class' => 'btn btn-primary', 'title' => 'Filter')
				);
				echo $this->Form->end();
			?>
			<hr>
			<div class="box box-primary">
			<?php if(!empty($Products)){?>
			<table class="table table-hover">
				<tr><th><?php  echo $this->Paginator->sort('store_id','Store Name');?></th><th><?php  echo $this->Paginator->sort('titel','Item Name');?></th><th><?php echo $this->Paginator->sort('plu_code','PLU Code');?></th><th><?php echo $this->Paginator->sort('short_description');?></th><th><?php echo $this->Paginator->sort('image');?></th><th><?php echo $this->Paginator->sort('sort_order');?></th><th><?php echo $this->Paginator->sort('status');?></th><th class="pull-right"><?php echo __('Actions');?></th></tr>
				<?php
				foreach ($Products as $Product):
				?>
				<tr>
					<td><?php echo $this->General->getStoreNameById($Product['Product']['store_id']); ?></td> 
					<td><?php echo $Product['Product']['title']; ?></td>
					<td><?php echo $Product['Product']['plu_code']; ?></td>
					<td><?php echo $Product['Product']['short_description']; ?></td>
					<td>
					<?php if(!empty($Product['Product']['image'])){ ?>
						<img src="<?=WEBROOT.$Product['Product']['image']; ?>" height="50" width="50" >
					<?php } ?>
					</td>
					<td>
					<?php if(!empty($Product['Product']['image'])){ ?>
						<img src="<?=WEBROOT.$Product['Product']['thumb_image']; ?>" height="50" width="50" >
					<?php } ?>
					</td>
					<td><?php echo $Product['Product']['sort_order']; ?></td>
					<td><?php echo getActiveInactive($Product['Product']['status']); ?></td>
					<td class="pull-right">
						<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $Product['Product']['id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?>
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
