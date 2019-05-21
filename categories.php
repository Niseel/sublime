<?php
session_start();
	require_once ('action/classes/Database.php');
	require_once ('action/classes/Functions.php');
	include("includes/header.php");
?>
	<link rel="stylesheet" type="text/css" href="styles/categories.css">
	<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
	<link rel="stylesheet" type="text/css" href="styles/pagination.css">
<?php
	$db = new Database();
	$id = intval(getInput('id'));
	$sql = "SELECT * FROM product WHERE category_id = $id;";
	$rs = $db->numRow($sql);
	unset($_SESSION['query']);
	$brand = $db->fetchALL_condition('brand', 'status', '1');
	//$sql = "SELECT * FROM category WHERE id = '$id' AND status = '1'";
    //$value = $db->query($sql, true);
    $value = $db->fetchALL_condition_and_assoc('category', 'id', $id, 'status', '1');
    //_debug($value);
    //echo $value['banner'];
    //var_dump($value);
    if(empty($value)){
        redirectHome('');
    }
	$category = $db->fetchALL_condition('category', 'status', '1');
	$product = $db->fetchALL_condition_and('product', 'status', '1', 'category_id', $id);
	//_debug($product);
	//$product = $db->fetchALL_condition('product', 'status', '1');
	//$sql = "SELECT * FROM product ORDER BY updated_at DESC LIMIT 8";
	//$product_new = $db->query($sql, true);*/

	//_debug($test);
?>

<div class="super_container">


	<!-- Header -->

	<header class="header">
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo"><a href="<?php echo base_url()?>">Sublime.</a></div>
							<nav class="main_nav">
								<ul>
									<li class="">
										<a href="<?php echo base_url()?>">Home</a>
										<ul>

										</ul>
									</li>
									<li class="hassubs active">
										<a href="">Categories</a>
										<ul>
											<?php foreach ($category as $item): ?>
												<li>
													<a href="categories.php?id=<?php echo $item['id'] ?>">
														<?php echo $item['name']?>
													</a>
												<li>
											<?php endforeach ?>
										</ul>
									</li>
									<li><a href="contact.php">Contact</a></li>

									<?php
										if(isset($_SESSION['login'])){
											echo '<li class="hassubs"><a href="profile.php?id=';
											echo $_SESSION['login']['name_id'];
											echo '">';
											echo $_SESSION['login']['name_user'];
											echo '</a><ul>';
											echo '<li>';
											echo '<a href="profile.php?id=';
											echo $_SESSION['login']['name_id'];
											echo '">Profile</a>';
											echo '</li>';
											echo '<li>';
											echo '<a href="listinvoices.php">List invoices</a>';
											echo '</li>';
											echo '</ul>';
											echo '<li><a href="action/log-out.php">Log out</a></li>';
										}else{
									?>
									<li><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Log in</a></li>

									<li> <a data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a></li>
									<?php
										}
									?>

								</ul>
							</nav>
							<div class="header_extra ml-auto">
								<div class="shopping_cart">
									<a href="cart.php">
										<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 viewBox="0 0 489 489" style="enable-background:new 0 0 489 489;" xml:space="preserve">
											<g>
												<path d="M440.1,422.7l-28-315.3c-0.6-7-6.5-12.3-13.4-12.3h-57.6C340.3,42.5,297.3,0,244.5,0s-95.8,42.5-96.6,95.1H90.3
													c-7,0-12.8,5.3-13.4,12.3l-28,315.3c0,0.4-0.1,0.8-0.1,1.2c0,35.9,32.9,65.1,73.4,65.1h244.6c40.5,0,73.4-29.2,73.4-65.1
													C440.2,423.5,440.2,423.1,440.1,422.7z M244.5,27c37.9,0,68.8,30.4,69.6,68.1H174.9C175.7,57.4,206.6,27,244.5,27z M366.8,462
													H122.2c-25.4,0-46-16.8-46.4-37.5l26.8-302.3h45.2v41c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h139.3v41
													c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h45.2l26.9,302.3C412.8,445.2,392.1,462,366.8,462z"/>
											</g>
										</svg>
										<div>Cart 
											<span>(
											<?php echo isset($_SESSION['cart']) && count($_SESSION['cart']) != 0 ? count($_SESSION['cart']) : '0' ?>
											)</span>
										</div>
									</a>
								</div>
								<div class="search">
									<div class="search_icon">
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										viewBox="0 0 475.084 475.084" style="enable-background:new 0 0 475.084 475.084;"
										 xml:space="preserve">
										<g>
											<path d="M464.524,412.846l-97.929-97.925c23.6-34.068,35.406-72.047,35.406-113.917c0-27.218-5.284-53.249-15.852-78.087
												c-10.561-24.842-24.838-46.254-42.825-64.241c-17.987-17.987-39.396-32.264-64.233-42.826
												C254.246,5.285,228.217,0.003,200.999,0.003c-27.216,0-53.247,5.282-78.085,15.847C98.072,26.412,76.66,40.689,58.673,58.676
												c-17.989,17.987-32.264,39.403-42.827,64.241C5.282,147.758,0,173.786,0,201.004c0,27.216,5.282,53.238,15.846,78.083
												c10.562,24.838,24.838,46.247,42.827,64.234c17.987,17.993,39.403,32.264,64.241,42.832c24.841,10.563,50.869,15.844,78.085,15.844
												c41.879,0,79.852-11.807,113.922-35.405l97.929,97.641c6.852,7.231,15.406,10.849,25.693,10.849
												c9.897,0,18.467-3.617,25.694-10.849c7.23-7.23,10.848-15.796,10.848-25.693C475.088,428.458,471.567,419.889,464.524,412.846z
												 M291.363,291.358c-25.029,25.033-55.148,37.549-90.364,37.549c-35.21,0-65.329-12.519-90.36-37.549
												c-25.031-25.029-37.546-55.144-37.546-90.36c0-35.21,12.518-65.334,37.546-90.36c25.026-25.032,55.15-37.546,90.36-37.546
												c35.212,0,65.331,12.519,90.364,37.546c25.033,25.026,37.548,55.15,37.548,90.36C328.911,236.214,316.392,266.329,291.363,291.358z
												"/>
										</g>
									</svg>
									</div>
								</div>
								<div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Search Panel -->
		<div class="search_panel trans_300">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="search_panel_content d-flex flex-row align-items-center justify-content-end">
							<form action="#">
								<div class="group pull-right">
									<input type="text" required name="searchBox">
							    	<span class="highlight"></span>
							    	<span class="bar"></span>
							    	<label>Search</label>
								</div>

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Social -->
		<div class="header_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu menu_mm trans_300">
		<div class="menu_container menu_mm">
			<div class="page_menu_content">
				<div class="page_menu_search menu_mm">
					<form action="#">
						<input type="search" required="required" class="page_menu_search_input menu_mm" placeholder="Search for products...">
					</form>
				</div>
				<ul class="page_menu_nav menu_mm">
					<li class="page_menu_item has-children menu_mm">
						<a href="<?php echo base_url()?>">Home<i class=""></i></a>
					</li>
					<li class="page_menu_item has-children menu_mm">
						<a href="categories.html">Categories<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<?php foreach ($category as $item): ?>
							<li class="page_menu_item menu_mm"><a href="categories.php?id=<?php echo $item['id'] ?>"><?php echo $item['name']?><i class="fa fa-angle-down"></i></a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li class="page_menu_item menu_mm"><a href="contact.php">Contact<i class="fa fa-angle-down"></i></a></li>


					<?php
						if(isset($_SESSION['login'])){
							echo '<li class="page_menu_item menu_mm"><a href="profile.php?id=';
							echo $_SESSION['login']['name_id'];
							echo '">';
							echo $_SESSION['login']['name_user'];
							echo '</a></li>';
							echo '<li class="page_menu_item menu_mm"><a href="action/log-out.php">Log out</a></li>';
						}else{
					?>
						<li class="page_menu_item menu_mm"><a data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Log in<i class="fa fa-angle-down"></i></a></li>
						<li class="page_menu_item menu_mm"><a data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register<i class="fa fa-angle-down"></i></a></li>
					<?php
						}
					?>


				</ul>
			</div>
		</div>

		<div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

		<div class="menu_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>
	<!-- Home -->

	<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url(<?php echo base_url()?>public/uploads/categories/<?php echo $value['banner']?>)"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="home_title" style="text-shadow: 2px 2px 5px black">
									<?php echo $value['name']?>
									<span>.</span>
								</div>
								<div class="home_text" >
									<p style="text-shadow: 2px 2px 5px black">
										<?php echo $value['content']?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col my-5">
					<!-- Product Sorting -->
					<div class="pull-left">
						<!-- <p>Show <?php echo intval($rs); ?> products</p> -->
					</div>
					<div class="pull-right">
						<div class="btn btn-info btn-xl" onclick="adSearch(<?php echo $id?>)">
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
			<div class="row">
				<div class="col" id="for_load">
					<div class="product_grid">

						<!-- Product -->
						<?php
							include('action/loadProducts.php');
						?>
						<?php
							include('action/load_pagination.php');
						?>
<!--
						<div class="product">
							<div class="product_image"><img src="images/product_1.jpg" alt=""></div>
							<div class="product_extra product_new"><a href="categories.html">New</a></div>
							<div class="product_content">
								<div class="product_title"><a href="product.html">Smart Phone</a></div>
								<div class="product_price">$670</div>
							</div>
						</div>
					</div>

					<div class="clearfix">
						<div class="pull-right">
							<div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">
								<ul class="pagination">
									<li class="pagination-item--wide first"> <a class="pagination-link--wide first" href="#">Previous</a> </li>
									<li class="pagination-item first-number"> <a class="pagination-link" href="#">1</a> </li>
									<li class="pagination-item"> <a class="pagination-link" href="#">2</a> </li>
									<li class="pagination-item is-active"> <a class="pagination-link" href="#">3</a> </li>
									<li class="pagination-item"> <a class="pagination-link" href="#">4</a> </li>
									<li class="pagination-item"> <a class="pagination-link" href="#">5</a> </li>
									<li class="pagination-item--wide last"> <a class="pagination-link--wide last" href="#">Next</a> </li>
								</ul>

							</div>
						</div>
					</div>
-->

				</div>
			</div>
		</div>
	</div>

	<!-- Ad -->

	<div class="avds_xl my-5">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="avds_xl_container clearfix">
						<div class="avds_xl_background" style="background-image:url(images/avds_xl.jpg)"></div>
						<div class="avds_xl_content">
							<div class="avds_title">Amazing Devices</div>
							<div class="avds_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.</div>
							<div class="avds_link avds_xl_link"><a href="categories.html">See More</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Icon Boxes -->

	<div class="icon_boxes">
		<div class="container">
			<div class="row icon_box_row">
				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
						<div class="icon_box_title">Free Shipping Worldwide</div>
						<div class="icon_box_text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
						<div class="icon_box_title">Free Returns</div>
						<div class="icon_box_text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
						<div class="icon_box_title">24h Fast Support</div>
						<div class="icon_box_text">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_border"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="newsletter_content text-center">
						<div class="newsletter_title">Subscribe to our newsletter</div>
						<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
						<div class="newsletter_form_container">
							<form action="#" id="newsletter_form" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required">
								<button class="newsletter_button trans_200"><span>Subscribe</span></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
<?php

	include('includes/footer.php');
?>
</body>
</html>
	<!--Modal-->
<?php
	include('includes/modal.php');
?>


