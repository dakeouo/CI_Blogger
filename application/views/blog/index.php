<!-- Banner -->
<section id="banner">
	<div class="inner">
		<h2><?php echo $this->config->item('blog_name');?></h2>
		<p><?php echo $subtitle; ?></p>
	</div>
</section>
<section id="main" class="wrapper style1">
	<div class="container">
		<div class="row" style="margin-top: -2.5em;">
			<div class="9u">
			<?php foreach($Article_list as $row){
				echo '<section class="box">';
				echo '<h3 style="margin: 0; font-weight: 600;">';
				if($row->category != "無分類") echo "[".$row->category."]";
				echo $row->title.'</h3>';
				echo '<div style="margin-bottom: 0.5em;">';
				echo '<i class="fas fa-clock"></i>&nbsp;'.date("Y/m/d H:i", strtotime($row->publishTime)).'&nbsp;<br />';
				echo '<i class="fas fa-tag"></i>';
				if($row->tags){
					$newTag = explode(',', $row->tags);
					foreach($newTag as $t){echo '&nbsp;<a href="'.base_url("blog/tag/".trim($t)."/0").'">'.$t.'</a>';}
				}else echo '&nbsp;無&nbsp;';
				echo '</i><br />';
				echo '<i class="fas fa-comments"></i>&nbsp;<a href="'.base_url("blog/article/".$row->id).'#disqus_thread">Comments</a>';
				echo '</div>';
				echo '<p>'.$row->above.'...</p>';
				echo '<ul class="actions" style="margin-top: -1.5em;">';
				echo '<li><a href="'.base_url("blog/article/".$row->id).'" class="button special small">';
				echo 'Learn More</a></li></ul>';
				echo '</section>';
			} 
			if(!$Article_list) echo "<div>目前無文章。</div>";
			?>
			<!-- Pagination -->
	        <div class="pagination-wrapper">
	            <ul class="pagination justify-content-center"><?php 
	            	if($Article_count["back"] != -1) echo '<li><a href="'.base_url("blog/".$Article_count["back"]).'">較新的文章</a></li>';
	            	else echo '<li class="disabled"><a href="#">較新的文章</a></li>';
	            	if($Article_count["next"] != -1) echo '<li><a href="'.base_url("blog/".$Article_count["next"]).'">較舊的文章</a></li>';
	            	else echo '<li class="disabled"><a href="#">較舊的文章</a></li>';
	            ?></ul>
	        </div>
			</div>
			