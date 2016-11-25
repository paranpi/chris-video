<tr>
	<td class="file-type"><?php echo $type?> </td>
	<td>		
		<?php if($type == "dir") {?>	
		<a class="file-name" href="?dir=<?php echo realpath($path.$name)?>"><?php echo $name ?></a>
		<?php }else {?>
		<span><?php echo $name ?></span>
		<?php } ?>
	</td>
	<td>
	<?php if($type =='dir' && $name != '.' && $name != '..') { ?>
		<select class="menu-id">
			<?php foreach($menus as $menu) {?>
				<option value="<?php echo $menu['id'] ?>"><?php echo $menu['name'] ?></option>
			<?php } ?>
		</select>
	<?php }?>
	</td>
	<td>
		<?php if($type =='dir' && $name != '.' && $name != '..') { ?>
			<button onclick="insertSubMenu(this)">추가</button>
		<?php }?>
	</td>
</tr>