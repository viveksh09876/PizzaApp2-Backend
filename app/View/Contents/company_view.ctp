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
		<div class="col-xs-4">
			<ul class="list-unstyled view-action">
				<li><?php echo $this->Html->link(__('Edit Page', true), array('action' => 'edit', $Content['Content']['page_id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?> </li>
				<li><?php echo $this->Html->link(__('List Pages', true), array('action' => 'index'),array('class'=>'btn btn-default btn-sm btn-info')); ?> </li>
			</ul>
		</div>
		<div class="col-xs-12">
			<div class="box box-primary">
			<table class="table table-bordered">
				<tr><td>Page Title : </td><td><?php echo $Content['Content']['page_title']; ?></td></tr>
				<tr><td>Page Slug : </td><td><?php echo $Content['Content']['page_slug']; ?></td></tr>
				<tr><td>Page Sub Title : </td><td><?php echo $Content['Content']['page_sub_title']; ?></td></tr>
				<tr><td>Page Content : </td><td><?php echo $Content['Content']['page_content']; ?></td></tr>
				<tr><td>Status : </td><td><?php echo $Content['Content']['status']; ?></td></tr>
				<tr><td>Page Added Date : </td><td><?php echo $Content['Content']['page_added_date']; ?></td></tr>
				<tr><td>Page Modified Date : </td><td><?php echo $Content['Content']['page_modified_date']; ?></td></tr>
			</table>
			</div>
		</div>
	</div>
</section>
