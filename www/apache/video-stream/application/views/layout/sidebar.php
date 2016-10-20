<a class="sidebar-open btn btn-info"><span class="glyphicon glyphicon-list" onclick="openSideBar()"></span></a>
<div id="sidebar" class="col-sm-3 col-md-2 sidebar">	
	<ul class="nav nav-sidebar">
		<li class="sidebar-close" onclick="closeSideBar()">
			<a href="#">
				<span class="glyphicon glyphicon-remove"></span>
			</a>
		</li>
		<?php				 
		foreach($sidebar_menu_list as $value) {
			echo '<li>';
			printf('<a href="%s?menu=%s">%s</a>',$page,$value,$value);
			echo '</li>';					
		}?>		
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

