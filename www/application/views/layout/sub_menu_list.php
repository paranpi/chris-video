<tr>
	<td colspan="5">
		<table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>이름</td>
                    <td>다운로드 검색어</td>
                    <td>게시판코드</td>
                    <td>자동 다운로드</td>
                    <td>삭제</td>
                </tr>
            </thead>
			<tbody>
				<tr data-path="<?php echo $path?>">
					<td class="sub-menu-id"><?php echo $id ?></td>
					<td class="sub-menu-name"><?php echo $name ?></td>
					<td><input class="download-filename" type="text" value="<?php echo $filename?>" ></td>
					<td>
						<select class="board">
							<option value="torrent_movie"<?php echo $board == "torrent_movie" ? "selected" : "" ?> >영화</option>
							<option value="torrent_tv" <?php echo $board == "torrent_tv" ? "selected" : "" ?> >드라마</option>
							<option value="torrent_variety" <?php echo $board == "torrent_variety" ? "selected" : "" ?> >예능</option>
							<option value="torrent_docu" <?php echo $board == "torrent_docu" ? "selected" : "" ?> >다큐/시사</option>
							<option value="torrent_mid" <?php echo $board == "torrent_mid" ? "selected" : "" ?> >해외TV(미드)</option>
							<option value="torrent_child" <?php echo $board == "torrent_child" ? "selected" : "" ?> >어린이</option>
						</select>
					</td>
                    <td><input type="checkbox" onclick="changeDownloadState(this)" <?php echo $filename ? "checked" : "" ?>></td>
                    <td><button onclick="delSubMenu(this)">삭제</button></td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>