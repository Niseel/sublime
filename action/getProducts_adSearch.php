<?php
	require_once('../core/init.php');
	error_reporting(0);
	$sortBy = $_POST['sortBy'];
	$category_id = $_POST['category'];
	$brand_id = $_POST['brand'];
	$start_price = $_POST['start'];
	$end_price = intval($_POST['end']);
	//echo $num. '</br>';
	//echo $id;
?>

<?php

	$sql = "SELECT * FROM product WHERE category_id = '$category_id' AND status = '1' AND brand_id LIKE '$brand_id'";
	if($start_price != ''){
		$sql .= " AND price >= '$start_price'";
	}
	if($end_price != ''){
		$sql .= " AND price <= '$end_price'";
	}
	if($sortBy != ''){
		$sql .=  " ORDER BY $sortBy";
	}
	$sql_tmp = $sql;
	$_SESSION['query'] = $sql_tmp;
	//$sql .= ";";
	//echo $sql;
	$result = $db->query($sql, true);

	// Tổng số Record trả về
	$total_record = count($result);
	// Tìm Current page
	$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
	// Set LIMIT
	$limit = 2;
	//Tính Total_page
	$total_page = ceil($total_record / $limit);
	if($current_page > $total_page){
		$current_page = $total_page;
	}
	if($current_page < 1){
		$current_page = 1;
	}
	// Thuật toán tính Start (mốc sản phẩm bắt đầu load của mỗi trang)
	$start = ($current_page - 1 ) * $limit;

	$sql .= "  LIMIT $start, $limit";
	$sql .= ";";
	//echo $sql;
	// $value = $db->query($sql);
	// _debug($value); check data
	$numRow = $db->numRow($sql);
	if($numRow == 0){
		echo '<div style="font-size:24px; color: #000">';
		echo 'Sorry, No items are available for sale :(';
		echo '</div>';
	}else{
	$result = $db->query($sql);
	echo '<div class="product_grid">';
	foreach ($result as $item) {
		echo '<div class="product">';
		echo '<div class="product_image"><img height="262.5px" width="262.5px" src="';
		echo uploads();
		echo 'products/';
		echo $item['image'];
		echo '" alt="pictures"></div>';
		echo '<div class="product_extra product_new"><a href="categories?id=';
		echo $item['category_id'];
		echo '">New</a></div>';
		echo '<div class="product_content">';
		echo '<div class="product_title"><a href="products.php?id=';
		echo $item['id'];
		echo '">';
		echo $item['name'];
		echo '</a></div>';

		if($item['sale'] != 0){
			echo '<div>';
			echo '<span class="details_discount">$';
			echo $item['price'];
			echo '</span>';
			echo '<span class="product_price">$';
			echo sale_math($item['price'], $item['sale']);
			echo '</span>';
			echo '</div>';
		}else{
			echo '<div>';
			echo '<span class="product_price">$';
			echo formatPrice($item['price']);
			echo '</span>';
			echo '</div>';
		}

		echo '<div>';
		echo '<span class="product_price">';
		echo $item['view'];
		echo ' view</span>';
		echo '</div>';
		echo '<div class="btn btn-success btn-xl my-1" style="margin-right: 5px;"><a style="color: white;" href="products.php?id=';
		echo $item['id'];
		echo '"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a></div>';
		echo '<div class="btn btn-primary btn-xl my-1" style="margin-right: 5px;"><a style="color: white;" href="';
		echo base_url();
		echo 'action/add-cart.php?id=';
		echo $item['id'];
		echo '"><i class="fa fa-plus"></i> Add</a></div>';
		echo '<div class="btn btn-danger btn-xl my-3" style="margin-right: 5px;"><i class="fa fa-heart-o" aria-hidden="true"> Like</i></div>';
		echo '</div></div>';
	}
?>
<?php echo '</div>' ?>
<!-- 	clear fix for pagination
 -->
	<div class="clearfix">
		<div class="pull-right">
			<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">
				<ul class="pagination">
					<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="#">Previous</a> </li>
					<?php
						for ($i = 1; $i <= $total_page; $i++){
							$pos = ($i - 1) * $limit;
					?>
						<li class="pagination-item <?php echo ($i==1) ? 'is-active' : '' ?>"> <a class="pagination-link" onclick="getProduct_ver4(<?php echo $i?>, <?php echo $pos ?>,<?php echo $limit ?>)"><?php echo $i?></a> </li>
					<?php
						}
					?>
					<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a> </li>
				</ul>
			</div>
		</div>
	</div>
<?php } ?>

