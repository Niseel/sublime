<?php
	// Câu truy vấn
	//error_reporting(0);
	if(isset($_GET['id']) == true){
		$category_id =  $_GET['id'];
	}
	$sql = 'SELECT count(id) AS total FROM product WHERE category_id = '.$category_id.';';

	// Tổng số Record
	$rs = $db->queryy($sql, true);
	$total_record = $rs['total'];
	// Tìm LIMIT và Current page
	$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

	$limit = 4;

	//Tính Total_page
	$total_page = ceil($total_record / $limit);
	if($current_page > $total_page){
		$current_page = $total_page;
	}
	if($current_page < 1){
		$current_page = 1;
	}
	// Thuật toán tính Start
	$start = ($current_page - 1 ) * $limit;

	$sql1 = 'SELECT * FROM product WHERE status = 1 AND category_id = '.$category_id.' LIMIT ' .$start. ',' .$limit. ';';
	$numRow = $db->numRow($sql1);
	if($numRow == 0){
		echo '<div style="font-size:24px; color: #000">';
		echo 'Sorry, No items are available for sale :(';
		echo '</div>';
	}else{
	$result = $db->query($sql1);
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
	</div>
	<!-- cai dong phan trang-->
	<?php } ?>