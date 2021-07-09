<section id="banner">
	<div class="inner">
		<h2><?php echo $title; ?></h2>
		<p><?php echo $subtitle; ?></p>
	</div>
</section>
<section id="main" class="wrapper style1">
	<div class="container">
		<div class="row" style="margin-top: -2.5em;">
			<div class="3u">
				<section class="special">
					<img src="<?php echo base_url("asset/default/users/".$author->photo);?>" width="50%" class="image" />
					<h3 style="margin: 0; font-weight: 600;"><?php echo $author->username; ?></h3>
					<p ><?php echo $author->slogan; ?></p>
					<ul class="icons" style="margin-top: -1em;">
						<?php foreach($app_link as $row){
							echo '<li><a href="'.$row->link.'" class="icon '.$row->icon_id.'">';
							echo '<span class="label">'.$row->app.'</span></a></li>';
						} ?>
					</ul>
				</section>
			</div>
			<div class="9u">
				<?php include_once $this->config->item('content_url')."99992020010100.html";  ?>
			</div>
			<div style="padding: 1em;"></div>
		</div>
	</div>
</section>