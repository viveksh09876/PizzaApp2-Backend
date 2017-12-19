<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php __('Welcome : '); ?> <?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css(array('admin/bootstrap.min','admin/jquery-jvectormap-1.2.2','admin/AdminLTE','admin/_all-skins.min','admin/style','admin/chosen.min'));
			echo $this->Html->script(array('admin/jQuery-2.1.4.min','admin/bootstrap.min','admin/app.min','admin/jquery.validate.min','admin/index','admin/jquery.loading.block','admin/chosen.jquery.min'));
			echo $scripts_for_layout;
		?>

		<!-- Font Awesome -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    	<!-- Ionicons -->
    	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

	</head>
	<body class="skin-blue sidebar-mini">
		<div class="wrapper">
			<?php echo $this->element('company-top-header'); ?>
			<?php echo $this->element('company-left-sidebar'); ?>
			<div class="content-wrapper">
				<section class="content-header">
					<?php echo $this->Session->flash(); ?>
				</section>
				
				<?php echo $content_for_layout; ?>
			</div>
			<?php echo $this->element('admin-footer'); ?>
	   	</div><!-- ./wrapper -->
	</body>
</html>

