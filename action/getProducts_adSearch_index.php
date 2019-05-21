<?php
	require_once('../core/init.php');
	$sortBy = $_POST['sortBy'];
	$category_id = $_POST['category'];
	$brand_id = $_POST['brand'];
	$start_price = $_POST['start'];
	$end_price = intval($_POST['end']);
	//echo $num. '</br>';
	//echo $id;
	$brand = $db->fetchALL_condition('brand', 'status', '1');
	$category = $db->fetchALL_condition('category', 'status', '1');

	error_reporting(0);
?>

<?php

	$sql = "SELECT * FROM product WHERE category_id LIKE '$category_id' AND status = '1' AND brand_id LIKE '$brand_id'";
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
	$num = $db->numRow($sql);
	$sql .= "  LIMIT $start, $limit";
	$sql .= ";";
	//echo $sql;
	//echo $sql;
	// $value = $db->query($sql);
	// _debug($value); check data
	$numRow = $db->numRow($sql);
	if($numRow == 0){
	?>
		<div class="row">
					<div class="col my-5">
						<!-- Product Sorting -->
						<div class="pull-left">
							<p>Find <?php echo $num?> products</p>
						</div>
						<div class="pull-right">
							<div class="btn btn-info btn-xl" onclick="adSearch_noAgru()">
								Filter
							</div>
						</div>
						<div class="pull-right" style="margin-right: 20px">
							<div class="loai" style="width: 130px">
					        	Sort:
					        	<select id="sort_by" style="border: 0;margin-left: 5px;border-bottom: 1px solid black;">
					            	<option value="">Default</option>
					            	<option value="name ASC">A-Z</option>
					            	<option value="name DESC">Z-A</option>
					            	<option value="price ASC">Low-high</option>
					            	<option value="price DESC">High-low</option>
					          	</select>
					      	</div>
						</div>
						<div class="pull-right">
							<div class="loai" style="width: 200px">
					        	Category:
					        	<select id="category_by" style="border: 0;margin-left: 5px;border-bottom: 1px solid black;">
					            	<option value="%">All</option>
									<?php foreach ($category as $item): ?>
										<option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
									<?php endforeach ?>
					          	</select>
					      	</div>
						</div>
						<div class="pull-right">
							<div class="loai" style="width: 170px">
					        	Brand:
					        	<select id="brand_by" style="border: 0;margin-left: 5px;border-bottom: 1px solid black;">
					            	<option value="%">All</option>
									<?php foreach ($brand as $item): ?>
										<option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
									<?php endforeach ?>
					          	</select>
					      	</div>
						</div>
						<div class="pull-right" style="margin-right: 40px">
							<span style="margin: 10px">TO</span>
							<div class="group pull-right">
								<input type="number" name="price_end" id="ad" required>
								<span class="highlight"></span>
							</div>
						</div>
						<div class="pull-right" style="margin-right: 20px">
							<span style="margin: 10px">PRICE FROM</span>
							<div class="group pull-right">
								<input type="number" name="price_start" id="ad" required>
								<span class="highlight"></span>
							</div>
						</div>
					</div>
		</div>
	<?php
		echo '<div style="font-size:24px; color: #000">';
		echo 'Sorry, No items are available for sale :(';
		echo '</div>';
	}else{
	?>
		<div class="row">
			<div class="col my-5">
						<!-- Product Sorting -->
						<div class="pull-left">
							<p>Find <?php echo $num?> products</p>
						</div>
						<div class="pull-right">
							<div class="btn btn-info btn-xl" onclick="adSearch_noAgru()">
								Filter
							</div>
						</div>
						<div class="pull-right" style="margin-right: 20px">
							<div class="loai" style="width: 130px">
					        	Sort:
					        	<select id="sort_by" style="border: 0;margin-left: 5px;border-bottom: 1px solid black;">
					            	<option value="">Default</option>
					            	<option value="name ASC">A-Z</option>
					            	<option value="name DESC">Z-A</option>
					            	<option value="price ASC">Low-high</option>
					            	<option value="price DESC">High-low</option>
					          	</select>
					      	</div>
						</div>
						<div class="pull-right">
							<div class="loai" style="width: 200px">
					        	Category:
					        	<select id="category_by" style="border: 0;margin-left: 5px;border-bottom: 1px solid black;">
					            	<option value="%">All</option>
									<?php foreach ($category as $item): ?>
										<option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
									<?php endforeach ?>
					          	</select>
					      	</div>
						</div>
						<div class="pull-right">
							<div class="loai" style="width: 170px">
					        	Brand:
					        	<select id="brand_by" style="border: 0;margin-left: 5px;border-bottom: 1px solid black;">
					            	<option value="%">All</option>
									<?php foreach ($brand as $item): ?>
										<option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
									<?php endforeach ?>
					          	</select>
					      	</div>
						</div>
						<div class="pull-right" style="margin-right: 40px">
							<span style="margin: 10px">TO</span>
							<div class="group pull-right">
								<input type="number" name="price_end" id="ad" required>
								<span class="highlight"></span>
							</div>
						</div>
						<div class="pull-right" style="margin-right: 20px">
							<span style="margin: 10px">PRICE FROM</span>
							<div class="group pull-right">
								<input type="number" name="price_start" id="ad" required>
								<span class="highlight"></span>
							</div>
						</div>
			</div>
		</div>
	<?php
	$result = $db->query($sql);
	echo '<div class="row">';
	echo '<div class="col">';
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
						<li class="pagination-item <?php echo ($i==1) ? 'is-active' : '' ?>"> <a class="pagination-link" onclick="getProduct_ver3(<?php echo $i?>, <?php echo $pos?>, <?php echo $limit?>)"><?php echo $i?></a> </li>
					<?php
						}
					?>
					<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a> </li>
				</ul>
			</div>
		</div>
	</div>
<?php echo '</div>'; } ?>

