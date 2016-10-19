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
				<?php				 
				foreach($menu_list as $key => $value) {
					echo '<li class="active">';
					printf('<a href="%s">%s</a>',$value,$key) ;
					echo '</li>';					
				}?>							
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>