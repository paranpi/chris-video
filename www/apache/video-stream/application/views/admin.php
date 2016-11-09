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
		<div id="browser-root" class="file-browser">
			<h2>파일브라우저</h2>
			<div id="cur-path"><?php echo $path;?></div>
			<table>
				<thead>
					<tr>
						<th>타입</th>
						<th>파일이름</th>
						<th>메뉴</th>
						<th>추가</th>
					</tr>
				</thead>			
				<tbody>	
				<?php foreach($files as $file) {
					$this->load->view('layout/file_browser',$file);
				}
				?>					
				</tbody>
			</table>
		</div>	
		<div class="top-menu">
			<h2>상단메뉴</h2>
			<div class="input-menu">
			<input type="text" id="menu-value"> <button id="menu-add" onclick="addMenu()">추가</button>
			</div>
			<table>
				<thead>
					<tr>
						<th class="row-id">ID</th>
						<th class="row-name">이름</th>
						<th class="row-display">표시</th>
						<th class="row-delete">삭제</th>
					</tr>
				</thead>
				<tbody id="menu-root">				    						
					<?php foreach ($menus as $menu) {
						$this->load->view('layout/menu_list',$menu);
					}
					?>	
				</tbody>
			</table>			
		</div>			
	</body>
</html>