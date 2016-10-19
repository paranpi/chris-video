<div class="container right-content">
	<div class="row">
		<?php				 
		foreach($file_list as $value) {
			echo '<div class="col-md-4">';
			echo '<video class="video-js vjs-default-skin vjs-16-9" controls data-setup="{}">';
			printf('<source src="/content/%s" type="video/mp4">',$value);
			echo '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>';
			echo '</video>';
			echo '</div>';					
		}?>			
	</div>
</div><!-- /.container -->
</div>