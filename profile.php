<?php
session_start();
	require_once ('action/classes/Database.php');
	require_once ('action/classes/Functions.php');
	include("includes/header.php");
	define("ROOT", $_SERVER['DOCUMENT_ROOT'] ."/sublime/public/uploads/");
?>
	<link rel="stylesheet" type="text/css" href="styles/checkout.css">
	<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
<?php
	unset($_SESSION['query']);
	if(isset($_SESSION['open_login'])){
		echo '<script type="text/javascript">alert("Register account successful");</script>';
	}
	//unset($_SESSION['cart']);
	if(isset($_SESSION['error'])){
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}

	$db = new Database();

	$id = intval(getInput('id'));
    $value = $db->getRowArray('user', $id);
    if(empty($value)){
        $_SESSION['error'] = '<script type="text/javascript">alert("No user exsit");</script>';
		header("location: http://localhost/sublime/");
    }

	$category = $db->fetchALL_condition('category', 'status', '1');

	$user = $db->getRowArray('user', intval($_SESSION['login']['name_id']));

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //
        $data= [
            'name'   => postInput('name'),
            'address'    => postInput('address'),
            'phone'    => postInput('phone'),
            'mail'    => postInput('mail'),
            'note'    => postInput('note')
        ];
        $error = [];

        if(postInput('name') == ''){
            $error['name'] = "Invalid name combination. Can't be empty";
        }
        if(postInput('address') == ''){
            $error['address'] = "Invalid address combination. Can't be empty";
        }
        if(postInput('phone') == ''){
            $error['phone'] = "Invalid phone combination. Can't be empty";
        }
        if(postInput('mail') == ''){
            $error['mail'] = "Invalid mail combination. Can't be empty";
        }

        if(empty($error)){
            //
            if(isset($_FILES['avt'])){
                $file_name = $_FILES['avt']['name'];
                $file_tmp = $_FILES['avt']['tmp_name'];
                $file_type = $_FILES['avt']['type'];
                $file_error = $_FILES['avt']['error'];
                if($file_error == 0){
                    $path = ROOT ."users/";
                    $data['avt'] = $file_name;
                }
            }
           	$row = $db->numRow_check('user', 'mail', $data['mail'], $id);
            if(intval($row) == 0){
                if($db->update('user', $data, $id)){
                    //$_SESSION['success'] = "Update new user successful";
                    move_uploaded_file($file_tmp, $path.$file_name);
                    //redirectAdmin('user');
                    $_SESSION['error'] = '<script type="text/javascript">alert("Update user successful");</script>';
					header("location: http://localhost/sublime/profile.php?id=$id");
                }else{
                    //$_SESSION['fail'] = "Update new user fail";
                    echo "Lỗi: " .$db->error();
                    $_SESSION['error'] = '<script type="text/javascript">alert("Update user fail");</script>';
					header("location: http://localhost/sublime/profile.php?id=$id");
                }
        	}else{
        		$_SESSION['error'] = '<script type="text/javascript">alert("Your mail already exists, please use another mail");</script>';
				header("location: http://localhost/sublime/profile.php?id=$id");
        	}

        }
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
							<div class="logo"><a href="<?php echo base_url()?>">Sublime.</a></div>
							<nav class="main_nav">
								<ul>
									<li class="">
										<a href="<?php echo base_url()?>">Home</a>
										<ul>
										</ul>
									</li>
									<li class="hassubs">
										<a href="categories.html">Categories</a>
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
									<li><a href="contact.html">Contact</a></li>
									<?php
										if(isset($_SESSION['login'])){
											echo '<li class="hassubs active"><a href="profile.php?id=';
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
							<!-- <form action=""> -->
							    <div class="group pull-right">
									<input type="text" required name="searchBox" id="search_box">
							    	<span class="highlight"></span>
							    	<span class="bar"></span>
							    	<label>Search</label>
								</div>
							<!-- </form> -->
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
	        <div class="home_background" style="background-image:url(images/frofile_banner.jpg)"></div>
	        <div class="home_content_container">
	            <div class="container">
	                <div class="row">
	                    <div class="col">
	                        <div class="home_content">
	                            <div class="breadcrumbs">
	                                <ul>
	                                    <li><a id="sd" href="index.html">Home</a></li>
	                                    <li id="sd">Profile</li>
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

		<!-- Checkout -->
	<div class="checkout">
	    <div class="container">
	    	<form action="" method="post" id="checkout_form" class="checkout_form" enctype="multipart/form-data">
	        <div class="row">
	            <!-- Billing Info -->
	            <div class="col-lg">
	                <div class="billing checkout_section">
	                    <div class="frofile_title">Edit profile information</div>
	                    <div class="frofile_subtitle">Enter your profile info</div>
	                    <div class="checkout_form_container">
	                        <!-- <form action="" method="post" id="checkout_form" class="checkout_form"> -->
	                            <div class="row">
	                                <div class="col-xl-6">
	                                    <!-- Name -->
	                                    <p for="checkout_name">Full Name*</p>
	                                    <input type="text" id="ai" class="checkout_input" required="required" name="name" value="<?php echo isset($data['name']) ? $data['name'] : $user['name'] ?>">
	                                    <?php
	                                        if(isset($error['name'])){
	                                            echo '<div class="text-danger">';
	                                            echo $error['name'];
	                                            echo '</div>';
	                                        }
                                        ?>
	                                </div>
	                                <div class="form-group col-xl-6">
	                                	<!-- Avt -->
	                                    <p for="checkout_name">Avatar*</p>
	                                    <input type="file" class="form-control-file" id="ai" name="avt">
	                                    <img src="<?php echo uploads()?>users/<?php echo $user['avt']?>" width="200px" height="200px">
	                                    <?php
	                                        if(isset($error['avt'])){
	                                            echo '<div class="text-danger">';
	                                            echo $error['avt'];
	                                            echo '</div>';
	                                        }
	                                    ?>
                                	</div>
	                            </div>
	                            <div>
	                                <!-- Address -->
	                                <p for="checkout_address">Address*</p>
	                                <input type="text" id="ai" class="checkout_input"name="address" value="<?php echo isset($data['address']) ? $data['address'] : $user['address'] ?>">
	                                    <?php
	                                        if(isset($error['address'])){
	                                            echo '<div class="text-danger">';
	                                            echo $error['address'];
	                                            echo '</div>';
	                                        }
                                        ?>
	                            </div>

	                            <div>
	                                <!-- Phone no -->
	                                <p for="checkout_phone">Phone no*</p>
	                                <input type="phone" id="ai" class="checkout_input" name="phone" value="<?php echo isset($data['phone']) ? $data['phone'] : $user['phone'] ?>">
	                                    <?php
	                                        if(isset($error['phone'])){
	                                            echo '<div class="text-danger">';
	                                            echo $error['phone'];
	                                            echo '</div>';
	                                        }
                                        ?>
	                            </div>
	                            <div>
	                                <!-- Email -->
	                                <p for="checkout_email">Email Address*</p>
	                                <input type="mail" id="ai" class="checkout_input" name="mail" value="<?php echo isset($data['mail']) ? $data['mail'] : $user['mail'] ?>">
	                                    <?php
	                                        if(isset($error['mail'])){
	                                            echo '<div class="text-danger">';
	                                            echo $error['mail'];
	                                            echo '</div>';
	                                        }
                                        ?>
	                            </div>
	                            <div>
	                                <!-- Note -->
									<p for="checkout_email">Note*</p>
	                                <textarea name="note" rows="4" style="width: 100%; padding: 10px 20px 10px 20px"><?php echo isset($data['note']) ? $data['note'] : $user['note'] ?></textarea>
	                            </div>

	                        <!-- </form> -->
	                    </div>
	                </div>
	            </div>
	        </div>
			<div class="row">
	        	<div class="col-md-12">
	        		<input class="btn btn-success btn-block" type="submit" value="Save your information" id="submit">
	        	</div>
	        </div>
	    </form>
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