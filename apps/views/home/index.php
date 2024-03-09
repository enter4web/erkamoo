<?php include('apps/views/header.php'); ?>

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo $data['kotak']; ?></h1>
		<?php echo $data['breadcrumb']; ?>
	</section>

	<!-- Main content -->
	<section class="content">				
		<div class="row">
			<div class="col-md-12">
				<div class="row">
				<?php
				if(!empty($homeMenu))
				{
					foreach($homeMenu as $homeMenu)
					{
						$bg = "green";
						$styl = '';
						
						// SETTING
						if($homeMenu->menuId == 1){
							$bg = "yellow";
							$styl = 'style="animation: pulse 1s infinite;"';
						}
					?>
					<div class="col-lg-3 col-xs-12">
						<!-- small box -->
						<div class="small-box bg-<?php echo $bg; ?>" <?php echo $styl; ?>>
							<div class="inner" style="height:100px;">
								<p><?php echo $homeMenu->menuName;?></p>
							</div>
							<div class="icon">
								<i class="<?php echo $homeMenu->menuIcon; ?>"></i>
							</div>
							<a href="<?php echo BASE_URL; ?><?php echo $homeMenu->menuLink; ?>" class="small-box-footer">Open Link Menu <i class="fa fa-angle-double-right"></i></a>
						</div>
					</div>
					<?php
					}
				}
				?>
				</div>
			</div>
		</div>
	</section>
</div>

<?php echo $data['js']; ?>
	
<?php include('apps/views/footer.php'); ?>