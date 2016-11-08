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
				<!-- <tr>
    				<td class="menu-id">1</td>
    				<td class="menu-name"><span onclick="clickMenu(this)">예능</span><input type="text" value="예능" class="hidden" onblur="blurMenu(this)"></td>
    				<td class="menu-hidden"><label><input type="checkbox" %s onclick="changeState(this)">숨김</label></td>
    				<td class="menu-delete"><button onclick="delMenu(this)">삭제</button></td>
    			</tr>
    			<tr>
    				<td colspan="4">
    					<table>
    						<tbody>
    							<tr>
    								<td>디렉토리1</td>
    								<td>삭제</td>
    							</tr>
    						</tbody>
    					</table>
    				</td>
    			</tr>    			 -->
    			<?php foreach ($menus as $menu) {
    				echo "<tr>";
    				printf('<td class="menu-id">%s</td>', $menu['id']);
    				echo '<td class="menu-name">';
    				printf('<span onclick="clickMenu(this)">%s</span>', $menu['name']);
    				printf('<input type="text" value="%s" class="hidden" onblur="blurMenu(this)">', $menu['name']);
    				echo '</td>';
    				printf('<td class="menu-hidden"><label><input type="checkbox" %s onclick="changeState(this)">숨김</label></td>', $menu['publish'] ? "checked" : "");
    				echo '<td class="menu-delete"><button onclick="delMenu(this)">삭제</button></td>';
    				echo "</tr>";
    			}
    			?>				
				</tbody>
			</table>			
		</div>