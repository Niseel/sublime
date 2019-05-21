
	<div class="clearfix">
		<div class="pull-right">
			<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">
				<ul class="pagination">
					<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="#">Previous</a> </li>
					<?php
						for ($i = 1; $i <= $total_page; $i++){
							$pos = ($i - 1) * $limit;
					?>
						<li class="pagination-item <?php echo ($i==1) ? 'is-active' : '' ?>"> <a class="pagination-link" onclick="getProduct(<?php echo $pos ?>,<?php echo $i ?>,<?php echo $limit ?>,<?php echo $category_id ?>)"><?php echo $i?></a> </li>
					<?php
						}
					?>
					<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a> </li>
				</ul>
			</div>
		</div>
	</div>