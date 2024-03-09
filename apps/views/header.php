<?php global $config; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="<?php echo $param[0]->param_value;?>">
	<meta name="keyword" content="<?php echo $param[1]->param_value;?>" >
	<meta name="author" content="garden_erka">

	<link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon/favicon.ico" type="image/x-icon">
	<?php echo base_style(); ?>
	<?php echo base_style_vendors(); ?>
	<?php echo base_js(); ?>
	
	<?php echo base_js_vendors(); ?>
</head>
<!--skin-blue-->
<body class="hold-transition skin-green-light fixed sidebar-mini">
    
    <div class="wrapper">
		<?php include "nav_top.php"; ?>
		<?php include "nav_left.php"; ?>
