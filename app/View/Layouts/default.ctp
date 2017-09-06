<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
		<?php echo $this->Html->charset(); ?>
		<title><?php __('Welcome : '); ?> <?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css(array('frontend/bootstrap','frontend/fonts','frontend/font-awesome','frontend/style','frontend/responsive','frontend/validationEngine.jquery'));
			echo $this->Html->script(array('frontend/jquery-1.11.3','frontend/bootstrap','frontend/index','frontend/jquery.validationEngine','frontend/jquery.validationEngine-en'));
			echo $scripts_for_layout;
		?>
	</head>
	<body>
		<?php echo $this->element('frontend-top-header'); ?>
		<div id="body_container">
			<?php echo $this->element('frontend-important-links'); ?>
			<?php echo $content_for_layout; ?>
	   	</div><!-- ./wrapper -->
		<?php echo $this->element('frontend-footer'); ?>
	</body>
</html>


