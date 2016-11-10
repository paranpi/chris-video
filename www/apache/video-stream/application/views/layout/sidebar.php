<a class="sidebar-open btn btn-info"><span class="glyphicon glyphicon-list" onclick="openSideBar()"></span></a>
<div id="sidebar" class="col-sm-3 col-md-2 sidebar">	
	<ul class="nav nav-sidebar">
		<li class="sidebar-close" onclick="closeSideBar()">
			<a href="#">
				<span class="glyphicon glyphicon-remove"></span>
			</a>
		</li>
		<?php foreach($sidebar_menu_list as $sub_menu) { ?>
		<li class="<?php echo $sub_menu_id == $sub_menu['id'] ? "active":"" ?>">
		<a href="?menu=<?php echo $sub_menu['id']?>"><?php echo $sub_menu['name']?></a>
		</li>			
		<?php }?>		
	</ul>	
</div>
<script>
function openSideBar() {
    document.getElementById("sidebar").style.left = "0%";
}

function closeSideBar() {
    document.getElementById("sidebar").style.left = "-40%";
}
</script>

