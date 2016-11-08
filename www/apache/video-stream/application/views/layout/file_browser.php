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
				<?php 
				foreach($files as $file) {
					echo '<tr>';
					echo '<td class="file-type">'.$file['type'].'</td>';
					echo '<td>';
					if($file['name'] =='.') {
						printf('<a href="">%s</a>',$file['name']);
					}
					else if($file['name'] =='..') {
						printf('<a class="file-name" href="?dir=%s">%s</a>',dirname($path),$file['name']);
					}
					else if($file['type'] == "dir") {
						printf('<a class="file-name" href="?dir=%s%s">%s</a>',$path,$file['name'],$file['name']);
					}else {
						printf('<span>%s</span>',$file['name']);
					}
					echo '</td>';
					echo '<td>';
					if($file['type'] == 'dir' && $file['name'] != '.' && $file['name'] != '..') {
						echo '<select class="menu-id">';
						foreach($menus as $menu) {
							printf('<option value="%s">%s</option>',$menu['id'],$menu['name']);
						}
						echo '</select>';
					}					
					echo '</td>';
					echo '<td>';
					if($file['type'] == 'dir' && $file['name'] != '.' && $file['name'] != '..') {
						echo '<button onclick="insertSubmenu(this)">추가</button>';
					}
					echo '</td>';					
					echo '</tr>';							

				}
				?>					
				</tbody>
			</table>
		</div>