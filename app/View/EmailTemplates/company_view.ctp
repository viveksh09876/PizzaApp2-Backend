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
			<ul class="list-unstyled view-action">
				<li><?php echo $this->Html->link(__('Edit Template', true), array('action' => 'edit', $EmailTemplate['EmailTemplate']['template_id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?> </li>
				<li><?php echo $this->Html->link(__('List Templates', true), array('action' => 'index'),array('class'=>'btn btn-default btn-sm btn-info')); ?> </li>
				<li><?php echo $this->Html->link(__('New Template', true), array('action' => 'add'),array('class'=>'btn btn-default btn-sm btn-success')); ?> </li>
			</ul>
		</div>
		<div class="col-xs-12">
			<div class="box box-primary">
			<table class="table table-bordered">
				<tr><td>Template Name : </td><td><?php echo $EmailTemplate['EmailTemplate']['template_name']; ?></td><td>Template Key : </td><td><?php echo $EmailTemplate['EmailTemplate']['template_key']; ?></td><td>From Name : </td><td><?php echo $EmailTemplate['EmailTemplate']['from_name']; ?></td><td>From Email : </td><td><?php echo $EmailTemplate['EmailTemplate']['from_email']; ?></td></tr>
				<tr><td>Email Subject : </td><td><?php echo $EmailTemplate['EmailTemplate']['email_subject']; ?></td><td>Template Status : </td><td><?php echo $EmailTemplate['EmailTemplate']['template_status']; ?></td><td>Template Added Date : </td><td><?php echo $EmailTemplate['EmailTemplate']['template_added_date']; ?></td><td>Template Modified Date : </td><td><?php echo $EmailTemplate['EmailTemplate']['template_modified_date']; ?></td></tr>
				<tr><td>Email Body : </td><td colspan="7"><?php echo $EmailTemplate['EmailTemplate']['email_body']; ?></td></tr>
			</table>

			</div>
		</div>
	</div>
</section>