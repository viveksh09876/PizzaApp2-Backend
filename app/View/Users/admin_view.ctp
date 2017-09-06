<section class="content-header">
  <h1>
    <?php echo __('User Details');?>
    <small>Details of register user</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=ADMIN_WEBROOT;?>home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo __('User Details');?></li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-4">
			<ul class="list-unstyled view-action">
				<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $User['User']['user_id']),array('class'=>'btn btn-default btn-sm btn-primary')); ?> </li>
				<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $User['User']['user_id']), array('class'=>'btn btn-default btn-sm btn-danger'), sprintf(__('Are you sure you want to delete # %s?', true), $User['User']['user_id'])); ?> </li>
				<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'),array('class'=>'btn btn-default btn-sm btn-info')); ?> </li>
				<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add'),array('class'=>'btn btn-default btn-sm btn-success')); ?> </li>
			</ul>
		</div>
		<div class="col-xs-12">
			<div class="box box-primary">
			<table class="table table-bordered">
				<tr><td>First Name : </td><td><?php echo $User['User']['first_name']; ?></td><td>Last Name : </td><td><?php echo $User['User']['last_name']; ?></td><td>Email : </td><td><?php echo $User['User']['email']; ?></td><td>Phone : </td><td><?php echo $User['User']['phone']; ?></td></tr>
				<tr><td>Address : </td><td><?php echo $User['User']['address']; ?></td><td>City : </td><td><?php echo $User['User']['city']; ?></td><td>State : </td><td><?php echo $User['User']['state']; ?></td><td>Country : </td><td><?php echo $User['Country']['country_name']; ?></td></tr>
				<tr><td>Zip code : </td><td><?php echo $User['User']['zip_code']; ?></td><td>Description : </td><td><?php echo $User['User']['user_description']; ?></td><td>User Added Date : </td><td><?php echo $User['User']['user_added_date']; ?></td><td>User Modified Date : </td><td><?php echo $User['User']['user_modified_date']; ?></td></tr>
				<tr><td>User Status : </td><td><?php echo $User['User']['user_status']; ?></td><td>Last Login Date : </td><td><?php echo $User['User']['last_login_date']; ?></td><td>Last Login IP : </td><td><?php echo $User['User']['last_login_ip']; ?></td><td>User Role : </td><td><?php echo $User['UserRole']['user_role_name']; ?></td></tr>
			</table>

			</div>
		</div>
	</div>
</section>
