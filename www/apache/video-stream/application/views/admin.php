<!DOCTYPE html>
<html lang="ko">
	<head>
		<script src="<?php echo base_url()?>assets/js/helper.js"></script>
		<script src="<?php echo base_url()?>assets/js/admin.js"></script>
		<link href="<?php echo base_url()?>assets/css/admin.css" rel="stylesheet">
		<title>관리페이지</title>
	</head>
	<body>
		<div><a href="<?php echo base_url()?>admin/">HOME</a></div>
		<?php $this->load->view('layout/menu_list');?>	
		<?php $this->load->view('layout/file_browser');?>	
	</body>
</html>
