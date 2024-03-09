<?php

// BASE
function base_style()
{
	$url = '';
	$url .= '
	<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/css/AdminLTE.min.css" />
	<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/css/skins/_all-skins.min.css" />
	<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/css/google.css" />';

	return $url;
}

function base_js()
{
	$url = '';
	$url .= '
	<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="' . BASE_URL . 'assets/js/adminlte.min.js"></script>
	<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/jquery-ui/jquery-ui.min.js"></script> 
	
	<!--[if IE 9]>
		<link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
	<![endif]-->
	<!--[if lte IE 8]>
		<link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
	<![endif]-->
	<!--[if IE 9]>
		<script src="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/js/bootstrap-ie9.min.js"></script>
	<![endif]-->
	<!--[if lte IE 8]>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/js/bootstrap-ie8.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
	<![endif]-->

	<!--[if lt IE 9]>
	  <script src="' . BASE_URL . 'assets/js/html5shiv.js"></script>
	  <script src="' . BASE_URL . 'assets/js/respond.min.js"></script>
	  <script src="' . BASE_URL . 'assets/vendors/szimek/css/ie9.css"></script>
	<![endif]-->
	';

	return $url;
}

// VENDORS
function base_style_vendors($opsi = null)
{
	$url = '';
	
	if($opsi == null)
	{
		$url .= '
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/pace/center-simple.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datatables.net-bs/css/fixedHeader.dataTables.min.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datatables.net-bs/css/buttons.dataTables.min.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datatables.net-bs/css/rowGroup.dataTables.min.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datatables.net-bs/css/fixedColumns.bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datatables.net-bs/css/responsive.dataTables.min.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/nestable/nestable.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/select2/dist/css/select2.min.css">
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datetimepicker/bootstrap-datepicker/dist/datepicker.min.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/datetimepicker/bootstrap-daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/szimek/css/signature-pad.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/toastr/toastr.css" />';
	}
	else{
		$url .= '
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/pace/center-simple.css" />
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/select2/dist/css/select2.min.css">
		<link rel="stylesheet" type="text/css" href="' . BASE_URL . 'assets/vendors/toastr/toastr.css" />';
	}

	return $url;
}

function base_js_vendors($opsi = null)
{
	$url = '';
	
	if($opsi == null)
	{
		$url .= '
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/fastclick/lib/fastclick.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/eModal/eModal.2.67.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/pace/pace.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/dataTables.fixedHeader.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/dataTables.fixedColumns.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/dataTables.rowGroup.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/dataTables.colvis.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/jszip.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/pdfmake.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/vfs_fonts.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/print.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datatables.net-bs/js/average().js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/nestable/jquery.nestable.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/select2/dist/js/select2.full.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/moment/min/moment.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datetimepicker/bootstrap-datepicker/dist/datepicker.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/datetimepicker/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/autosize/autosize.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/szimek/js/signature_pad.umd.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/zoom/jquery.zoom.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/lazyload/lazyload.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/multiselect/multiselect.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/toastr/toastr.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/js/jquery.form.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/js/printThis.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/js/demo.js"></script>';
	}
	else{
		$url .= '
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/pace/pace.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/select2/dist/js/select2.full.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/vendors/toastr/toastr.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/js/jquery.form.min.js"></script>
		<script type="text/javascript" src="' . BASE_URL . 'assets/js/demo.js"></script>';
	}

	return $url;
}