<tr>
    <td class="menu-id"><?php echo $id ?></td>
    <td class="menu-name">
        <span onclick="clickMenu(this)"><?php echo $name?></span>
        <input type="text" value="<?php echo $name ?>" class="hidden" onblur="blurMenu(this)">
    </td>
    <td class="menu-hidden">
    <label><input type="checkbox" <?php echo $publish ? "checked" : "" ?> onclick="changeState(this)">공개</label>
    </td>
    <td class="menu-delete"><button onclick="delMenu(this)">삭제</button></td>
</tr>
<?php foreach ($sub_menus as $sub_menu) {
    $this->load->view('layout/sub_menu_list',$sub_menu);
}?>
