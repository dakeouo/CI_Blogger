<!-- Banner -->
<section id="banner">
	<div class="inner">
		<?php if($article->category != "無分類") echo "<h3>[".$article->category."]</h3>"; ?>
		<h2><?php echo $article->title; ?></h2>
		<h5>
			<i class="fas fa-clock"></i>&nbsp;<?php echo date("Y/m/d h:i", strtotime($article->publishTime)); ?>&nbsp;&nbsp;
			<!-- <i class="fas fa-eye"></i>&nbsp;0&nbsp; -->
			<br /><i class="fas fa-tag"></i><?php 
			if($article->tags){
				$newTag = explode(',', $article->tags);
				foreach($newTag as $t){
					echo '&nbsp;<a href="'.base_url("blog/tag/".trim($t)."/0").'">'.$t.'</a>';
				}
			}else echo '&nbsp;無&nbsp;'; ?>
			<br /><i class="fas fa-comments"></i><?php
				echo '&nbsp;<a href="'.base_url("blog/article/".$article->id).'#disqus_thread">Comments</a>';
			?>
		</h5>
	</div>
</section>
<section id="main" class="wrapper style1">
	<div class="container">
		<div class="row" style="margin-top: -2.5em;">
			<div class="9u">
				<section class="ion-article">
				<?php include_once $this->config->item('content_url').$article->id.".html";  ?>
				<br />
				<div id="disqus_thread"></div>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
				</section>
				<!-- Pagination -->
		        <div class="pagination-wrapper">
		            <ul class="pagination justify-content-center">
		            <?php
		            if($article->next_id){
		            	echo "<li><a href=\"";
		            	echo base_url("blog/article/".$article->next_id);
		            	echo "\">較新的文章</a></li>";
		            }else echo "<li class=\"disabled\"><a href=\"#\">較新的文章</a></li>";
		            echo "<li class=\"active\"><a href=\"".base_url("blog")."\">返回</a></li>";
		            if($article->back_id){
		            	echo "<li><a href=\"";
		            	echo base_url("blog/article/".$article->back_id);
		            	echo "\">較舊的文章</a></li>";
		            }else echo "<li class=\"disabled\"><a href=\"#\">較舊的文章</a></li>";
		            ?>
		            </ul>
		        </div>
			</div>
			