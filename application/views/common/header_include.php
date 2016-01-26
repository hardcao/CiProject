
<?php

    $CI=&get_instance();
	$CI->load->library('session');
	//$uid = $CI->session->userdata('username');
	
	//$CI->session->set_userdata('username', 'yanglei');
	$uid = $CI->session->userdata('username');

	if ($uid) {
		//echo "<script type='text/javascript'> $('#login').text('欢迎');</script>";
	}
	else
	{
		redirect('home/index/login');
	}
?>

<link rel="stylesheet"  type="text/css" href="<?php echo site_url('application/views/common/css/public.css')?>" />
<link rel="stylesheet"  type="text/css" href="<?php echo site_url('application/views/common/css/index.css')?>" />
<link rel="stylesheet"  type="text/css" href="<?php echo site_url('application/views/common/css/font-dincond.css')?>" />
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/common/js/public.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/common/js/index.js')?>"></script>
