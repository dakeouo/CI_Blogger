<section id="banner">
	<div class="inner">
		<h2><?php echo $title; ?></h2>
	</div>
</section>
<section id="main" class="wrapper style1">
	<div class="container">
		<div class="row" style="margin-top: -2.5em;">
			<div class="12u">
				<section>
					<table class="table-wrapper">
						<thead>
							<th>No.</th>
							<th>題目</th>
							<th>題號</th>
							<th>完成日期</th>
							<th>連結</th>
						</tr></thead>
						<tbody><?php
							foreach($cpe_list as $row){
								echo "<tr>";
								echo "<td>".$row->no."</td>";
								echo "<td>[".$row->category."]&nbsp;".$row->topic."</td>";
								echo "<td>UVA".$row->uva."</td>";
								if($row->finishTime){
									echo "<td>".$row->finishTime."</td>";
									echo "<td><a href=\"".base_url("blog/cpe/view/".$row->uva)."\" class=\"button small\">連結</a></td>";
								}else{
									echo "<td>NULL</td>";
									echo "<td><a href=\"#\" class=\"button disabled small\">連結</a></td>";
								}
								echo "</tr>";
							}	
						?></tbody>
					</table>
				</section>
			</div>
		</div>
		<div style="padding: 1em;"></div>
	</div>
</section>