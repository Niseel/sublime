<?php
session_start();
	require_once ('action/classes/Database.php');
	require_once ('action/classes/Functions.php');
	include("includes/header.php");
?>
	<link rel="stylesheet" type="text/css" href="styles/cart.css">
	<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
<?php
	//_debug($_SESSION['cart']);
	if(!isset($_SESSION['cart'])){
		$_SESSION['error'] = '<script type="text/javascript">alert("Your cart dont have any product. Go shoping");</script>';
		header("location: http://localhost/sublime/");
	}else{
		$sum = 0;
		if(isset($_SESSION['open_login'])){
			echo '<script type="text/javascript">alert("Register account successful");</script>';
		}

		if(isset($_SESSION['error'])){
			echo $_SESSION['error'];
			unset($_SESSION['error']);

		}

		$db = new Database();
		$category = $db->fetchALL_condition('category', 'status', '1');
	}
?>

<div class="super_container">


	<!-- Header -->

	<header class="header">
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo"><a href="<?php echo base_url() ?>">Sublime.</a></div>
							<nav class="main_nav">
								<ul>
									<li class="">
										<a href="<?php echo base_url() ?>">Home</a>
										<ul>

										</ul>
									</li>
									<li class="hassubs">
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
	        <div class="home_background" style="background-image:url(images/cart.jpg)"></div>
	        <div class="home_content_container">
	            <div class="container">
	                <div class="row">
	                    <div class="col">
	                        <div class="home_content">
	                            <div class="breadcrumbs">
	                                <ul>
	                                    <li><a href="<?php echo base_url()?>">Home</a></li>
	                                    <li>Shopping Cart</li>
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Cart Info -->
	<div class="cart_info">
	    <div class="container">
	        <div class="row">
	            <div class="col">
	                <!-- Column Titles -->
	                <div class="cart_info_columns clearfix">
	                    <div class="cart_info_col cart_info_col_product">Product</div>
	                    <div class="cart_info_col cart_info_col_price">Price</div>
	                    <div class="cart_info_col cart_info_col_quantity">Quantity</div>
	                    <div class="cart_info_col cart_info_col_total">Total</div>
	                </div>
	            </div>
	        </div>
	        <div class="row cart_items_row">
	        	<?php $stt=1; foreach ($_SESSION['cart'] as $key => $value): ?>
	            <div class="col">
	                <!-- Cart Item -->
	                <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
	                    <!-- Name -->
	                    <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
	                        <div class="cart_item_image">
	                            <div><img height="163px" width="183px" src="<?php echo uploads()?>products/<?php echo $value['image']?>" alt=""></div>
	                        </div>
	                        <div class="cart_item_name_container">
	                            <div class="cart_item_name"><a href="products.php?id=<?php echo $key?>"><?php echo $value['name'] ?></a></div>
	                            <div class="cart_item_edit">Edit Product:
	                            	<a href="remove.php?key=<?php echo $key?>" id="remove" >  Remove</a>
	                            	<span> / </span>
	                            	<a href="" class="updatecart" data-key="<?php echo $key?>" id="update">  Update</a>
	                            	<pre>                           </pre>
	                            </div>
	                        </div>
	                    </div>
	                    <!-- Price -->
	                    <div class="cart_item_price">$<?php echo $value['price'] ?></div>
	                    <!-- Quantity -->
	                    <div class="product_quantity_container">
							<div class="product_quantity clearfix" style="margin: 0px 40px 0px 30px;">
								<span>Qty</span>
								<input id="ai" type="number" class="cart_number" min=0 value="<?php echo $value['qty'] ?>">
							</div>
						</div>

	                    <!-- Total -->
	                    <div class="cart_item_total">
	                    	$<?php echo formatPrice($value['qty']*$value['price'])==0 ? 'free' : formatPrice($value['qty']*$value['price']) ?>
	                    </div>
	                </div>
	            </div>
	            <?php $sum += ($value['qty']*$value['price']); ?>
	        	<?php $stt++; endforeach ?>
	        </div>
	        <div class="row row_cart_buttons">
	            <div class="col">
	                <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
	                    <div class="button continue_shopping_button"><a href="index.php">Continue shopping</a></div>
	                    <div class="cart_buttons_right ml-lg-auto">
	                        <div class="button clear_cart_button" data-key="<?php echo isset($_SESSION['cart']) && count($_SESSION['cart']) != 0 ? count($_SESSION['cart']) : '0' ?>"><a href="">Clear cart</a></div>
	                        <div class="button update_cart_button" data-key="<?php echo isset($_SESSION['cart']) && count($_SESSION['cart']) != 0 ? count($_SESSION['cart']) : '0' ?>"><a href="">Update cart</a></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="row row_extra">
	            <div class="col-lg-4">

	                <!-- Coupon Code -->
	                <div class="coupon">
	                    <div class="section_title">Coupon code</div>
	                    <div class="section_subtitle">Enter your coupon code</div>
	                    <div class="coupon_form_container">
	                        <form action="#" id="coupon_form" class="coupon_form">
	                            <input type="text" class="coupon_input" required="required">
	                            <button class="button coupon_button"><span>Apply</span></button>
	                        </form>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-6 offset-lg-2">
	                <div class="cart_total">
	                    <div class="section_title">Cart total</div>
	                    <div class="section_subtitle">Final info</div>
	                    <div class="cart_total_container">
	                        <ul>
	                            <li class="d-flex flex-row align-items-center justify-content-start">
	                                <div class="cart_total_title">Subtotal</div>
	                                <div class="cart_total_value ml-auto">$
	                                <?php echo formatPrice($sum);?>
	                                </div>
	                            </li>
	                            <li class="d-flex flex-row align-items-center justify-content-start">
	                                <div class="cart_total_title">VAT</div>
	                                <div class="cart_total_value ml-auto">10%</div>
	                            </li>
	                            <li class="d-flex flex-row align-items-center justify-content-start">
	                                <div class="cart_total_title">Shipping</div>
	                                <div class="cart_total_value ml-auto">Free</div>
	                            </li>
	                            <li class="d-flex flex-row align-items-center justify-content-start">
	                                <div class="cart_total_title">Total</div>
	                                <div class="cart_total_value ml-auto">$
	                                <?php echo formatPrice($_SESSION['total'] = $sum*110/100) ?></div>
	                            </li>
	                        </ul>
	                    </div>
	                    <div class="button checkout_button"><a href="checkout.php">Proceed to checkout</a></div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


	<!-- Ad -->

	<div class="avds_xl">
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
<?php
	if(isset($_SESSION['open_login'])){
		echo '<script type="text/javascript">openLoginModal();</script>';
		unset($_SESSION['open_login']);
	}else{
		echo 'qq log';
	}
?>
</body>
</html>

	<!--Modal-->
<?php
	include('includes/modal.php');
?>