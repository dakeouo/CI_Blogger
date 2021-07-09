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
		<h5><?php echo $cpe->category; ?></h5>
		<h2><?php echo $cpe->topic; ?></h2>
		<h4><?php echo "UVA".$cpe->uva; ?></h4>
	</div>
</section>
<section id="main" class="wrapper style1">
	<div class="container">
		<div class="row" style="margin-top: -3em;">
			<div class="12u">
				<?php echo '<section style="margin-top:-1em; padding: 0.5em;"><a href="'.base_url("blog/cpe/").'" class="button small">返回</a></section>'; ?>
				<section>
					<h3>程式碼：</h3>
					<pre><code class="c" style='font-size: 1em; font-family: "Lucida Console", Monaco, monospace;'>
<?php include_once "application/CPE/UVA".$cpe->uva.".cpp"; ?>
					</code></pre>
				</section>
			</div>
		</div>
		<div style="padding: 1em;"></div>
	</div>
</section>