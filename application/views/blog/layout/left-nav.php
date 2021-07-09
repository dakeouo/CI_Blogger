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
		<ul class="actions" style="margin-top: -1.5em;">
			<li><a href="<?php echo base_url("blog/about");?>" class="button small">About Me</a></li>
		</ul>
	</section>
	<section>
		<h3>Categorys</h3>
		<ul class="alt">
			<?php foreach($cate_list as $row){
				echo '<li><a href="'.base_url("blog/category/".$row->name."/0").'">'.$row->name.'</a>&nbsp;('.$row->times.')</li>';
			} 
			if(!$cate_list) echo "<div>目前無分類。</div>";
			?>
		</ul>
	</section>
	<section>
		<h3>Tags</h3>
		<div class="tags-list" style="display: block;">
			<?php foreach($tags_list as $row){
				echo '<label><a href="'.base_url("blog/tag/".trim($row->name)."/0").'">'.$row->name.'</a>('.$row->times.')</label>&nbsp;';
			} 
			if(!$tags_list) echo "<div>目前無標籤。</div>";
			?>
		</div>
	</section>
	<div style="padding: 1em;"></div>
</div>
</div>
</div>
</section>