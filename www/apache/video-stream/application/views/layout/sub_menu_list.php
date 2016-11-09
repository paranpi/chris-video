<tr>
	<td colspan="4">
		<table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>이름</td>
                    <td>다운로드</td>
                    <td>삭제</td>
                </tr>
            </thead>
			<tbody>
				<tr>
					<td class="sub-menu-id"><?php echo $id ?></td>
					<td class="sub-menu-name"><?php echo $name ?></td>
                    <td><input class="sub-menu-download" type="checkbox"></td>
                    <td><button onclick="delSubMenu(this)">삭제</button></td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>