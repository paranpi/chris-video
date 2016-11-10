<div class="container right-content">
	<div class="row">
		<?php foreach($file_list as $value) { ?>
			<div class="col-md-4">
				<video class="video-js vjs-default-skin vjs-16-9" controls preload="none" data-setup="{}">
					<source src="/content/<?php echo $value["url"]?>" type="video/mp4">
					<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that 
						<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
					</p>
				</video>
				<div class="video-title"><?php echo ellipsize($value["name"],60)?></div>
			</div>			
		<?php } ?>			
	</div>
</div><!-- /.container -->