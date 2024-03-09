<!DOCTYPE html>
<html lang="en">
  <head>
	<title><?php echo $title;?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="description" content="<?php echo $param[1]->param_value;?>">
	<meta name="keyword" content="<?php echo $param[2]->param_value;?>" >
	<meta name="author" content="garden_erka">

	<link rel="icon" href="<?php echo BASE_URL; ?>assets/images/favicon/favicon.ico" type="image/x-icon">
	<?php echo base_style(); ?>
	<?php echo base_style_vendors(1); ?>
	<?php echo base_js(); ?>
	
	<?php echo base_js_vendors(1); ?>
</head>

<body class="hold-transition login-page">

	<div class="login-box">
		<!-- /.login-logo -->
		<div class="box box-widget widget-user-2">
			<div class="widget-user-header bg-primary" style="background: url('<?php echo BASE_URL; ?>assets/images/backgrounds/bkgd.jpg') center center;">
				<div class="widget-user-image">
					<img class="lockscreen-image" src="<?php echo BASE_URL; ?>assets/images/avatar.png" alt="User Avatar">
				</div>
				<!-- /.widget-user-image -->
				<h2 class="widget-user-username" style="padding:30px;">&nbsp;</h2>
			</div>
			
			<div class="login-box-body">
				<form action="" method="post" id="runLogin">
					<div class="form-group has-feedback">
						<input type="text" class="form-control username" name="username" placeholder="Username" autocomplete="off">
						<span class="fa fa-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback pass_show">
						<input type="password" class="form-control password" name="password" placeholder="Password">
						<!-- icon in load.js -->
					</div>
					<div class="row">
						<div class="col-xs-4 pull-right">
							<input type="submit" class="btn btn-primary btn-block btn-flat signIn" value="Sign In">
						</div>
					</div>
				</form>

			</div>
			<!-- /.login-box-body -->
		</div>
	</div>
	
	<!-- jQuery -->
	<?php echo $data['js']; ?>
	
</body>
</html>