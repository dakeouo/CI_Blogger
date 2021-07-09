<script>
	$(document).ready(function() {
		setTimeout(function(){$('#skel-layers-visibleWrapper').hide()},0);
	});
</script>
<div id="preview" style="position: fixed; width: 100%; height: 100%; z-index: 200;">
	<div style="position: relative; width: 5em; margin: 1em auto; border-radius: 0.5em; background-color: #666; padding: 0 0.5em; text-align: center; z-index: 300;">
		<i class="fas fa-eye fa-2x" style="padding: 0.1em; color: white;"></i>
		<h3 style=" color: white; ">預覽</h3>
	</div>
</div>
<div id="curve_chart" style="position: fixed; width: 100%; height: 100%; text-align: center; z-index: 100; background-color: white;">
	<div style="position: relative; top: 40%;">
		<img src="<?php echo base_url("asset/blog/img/ajax-loader.gif"); ?>"><br />Loading...
	</div>
</div>
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
				foreach($newTag as $t){echo '&nbsp;<a href="#">'.$t.'</a>';}
			}else echo '&nbsp;無&nbsp;'; ?>
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
				</section>
				<!-- Pagination -->
		        <div class="pagination-wrapper">
		            <ul class="pagination justify-content-center">
		            <?php
		            if($article->back_id){
		            	echo "<li><a href=\"";
		            	echo base_url("blog/article/".$article->back_id);
		            	echo "\">較舊的文章</a></li>";
		            }else echo "<li class=\"disabled\"><a href=\"#\">較舊的文章</a></li>";
		            echo "<li class=\"active\"><a href=\"".base_url("blog")."\">返回</a></li>";
		            if($article->next_id){
		            	echo "<li><a href=\"";
		            	echo base_url("blog/article/".$article->next_id);
		            	echo "\">較新的文章</a></li>";
		            }else echo "<li class=\"disabled\"><a href=\"#\">較新的文章</a></li>";
		            ?>
		            </ul>
		        </div>
			</div>
			