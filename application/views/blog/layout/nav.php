<!-- <div id="preview" style="position: fixed; width: 100%; height: 100%; z-index: 200;">
	<div style="position: relative; width: 5em; margin: 1em auto; border-radius: 0.5em; background-color: #666; padding: 0 0.5em; text-align: center; z-index: 300;">
		<i class="fas fa-eye fa-2x" style="padding: 0.1em; color: white;"></i>
		<h3 style=" color: white; ">預覽</h3>
	</div>
</div> -->
<div id="curve_chart" style="position: fixed; width: 100%; height: 100%; text-align: center; z-index: 100; background-color: white;">
	<div style="position: relative; top: 40%;">
		<img src="<?php echo base_url("asset/blog/img/ajax-loader.gif"); ?>"><br />Loading...
	</div>
</div>
<header id="header" class="skel-layers-fixed">
	<h1><a href="<?php echo base_url("blog"); ?>"><?php echo $this->config->item('blog_name');?></a></h1>
	<nav id="nav">
		<ul>
			<li><a href="<?php echo base_url("blog"); ?>">Home</a></li>
			<li><a href="<?php echo base_url("blog/cpe"); ?>">CPE Basic</a></li>
			<li><a href="<?php echo base_url("blog/about"); ?>">About Me</a></li>
		</ul>
	</nav>
</header>