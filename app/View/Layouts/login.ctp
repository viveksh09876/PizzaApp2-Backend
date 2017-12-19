<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php __('Welcome : '); ?> <?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css(array('admin/bootstrap.min','admin/jquery-jvectormap-1.2.2','admin/AdminLTE','admin/_all-skins.min','admin/style'));
			echo $this->Html->script(array('admin/jQuery-2.1.4.min','admin/bootstrap.min','admin/fastclick.min','admin/app.min','admin/jquery.sparkline.min','admin/jquery-jvectormap-1.2.2.min','admin/jquery-jvectormap-world-mill-en','admin/jquery.slimscroll.min','admin/Chart.min','admin/demo'));
			echo $scripts_for_layout;
		?>

		<!-- Font Awesome -->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    	<!-- Ionicons -->
    	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

	</head>
	<body class="skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
  				<a href="<?=ADMIN_WEBROOT?>home" class="logo">
				    <!-- mini logo for sidebar mini 50x50 pixels -->
				    <span class="logo-mini">KND</span>
				    <!-- logo for regular state and mobile devices -->
				    <img src="<?=IMG_ADMIN?>logo.svg" alt="NKD Pizza" height="34" style="margin:10px 0 0 0;"></img>
				</a>
		        <!-- Header Navbar: style can be found in header.less -->
		        <nav class="navbar navbar-static-top" role="navigation">
		          
		        </nav>
      		</header>
			<div style="margin-left: 0px;" class="content-wrapper">
				<?php echo $content_for_layout; ?>
			</div>
	   	</div><!-- ./wrapper -->
	</body>
</html>



