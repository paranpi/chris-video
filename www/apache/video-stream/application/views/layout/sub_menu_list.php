<tr>
	<td colspan="5">
		<table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>이름</td>
                    <td>다운로드 검색어</td>
                    <td>자동 다운로드</td>
                    <td>삭제</td>
                </tr>
            </thead>
			<tbody>
				<tr>
					<td class="sub-menu-id"><?php echo $id ?></td>
					<td class="sub-menu-name"><?php echo $name ?></td>
					<td><input class="download-filename" type="text" value="<?php echo $filename?>" ></td>
                    <td><input type="checkbox" onclick="changeDownloadState(this)" <?php echo $filename ? "checked" : "" ?>></td>
                    <td><button onclick="delSubMenu(this)">삭제</button></td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>