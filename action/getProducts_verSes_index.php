<?php
	require_once('../core/init.php');
	$number_product_start = $_POST['num'];
	$limit = $_POST['limit'];
	//echo $num. '</br>';
	//echo $name;
?>

<?php
	$sql = $_SESSION['query'];
	$sql .= " LIMIT $number_product_start, $limit;";
	//echo $sql;
	$result = $db->query($sql, true);

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