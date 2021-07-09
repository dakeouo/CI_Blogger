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