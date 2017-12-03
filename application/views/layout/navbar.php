<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php foreach($menu_list as $index=>$menu) {?>
					<li class="<?php echo $index == $id ? "active" : "" ?>">
						<a href="<?php echo $index?>"><?php echo $menu['name']?></a>
					</li>
				<?php }?>

				<?php if(!isset($this->session->userdata['logged_in'])) {?>
					<li><a href="login">설정</a></li>
				<?php } else { ?>
					<li><a href="logout">로그아웃</a></li>
				<?php } ?>

			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
