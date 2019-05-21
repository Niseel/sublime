<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Page</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo public_admin() ?>js_css_origin/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo public_admin() ?>js_css_origin/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo public_admin() ?>js_css_origin/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo public_admin() ?>js_css_origin/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo public_admin() ?>js_css_origin/dist/css/skins/_all-skins.min.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo public_admin() ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>LT</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>LTE</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 4 messages</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <!-- start message -->
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Support Team
                                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        AdminLTE Design Team
                                                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Developers
                                                        <small><i class="fa fa-clock-o"></i> Today</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Sales Department
                                                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="pull-left">
                                                        <img src="" class="img-circle" alt="User Image">
                                                    </div>
                                                    <h4>
                                                        Reviewers
                                                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                    </h4>
                                                    <p>Why not buy a new awesome theme?</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">See All Messages</a></li>
                                </ul>
                            </li>
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">0</span>
                                </a>
                            </li>
                            <!-- Tasks: style can be found in dropdown.less -->
                            <li class="dropdown tasks-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">0</span>
                                </a>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header"><b>MAIN NAVIGATION</b></li>

                        <?php if (intval($_SESSION['login']['level']) == 2): ?>
                        <li class="<?php echo isset($open) && $open == 'order' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/order/">
                            <i class="fa fa-send"></i> <span>Order</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'chart' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/chart/">
                            <i class="fa fa-line-chart"></i> <span>Chart</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (intval($_SESSION['login']['level']) == 3): ?>
                        <li class="<?php echo isset($open) && $open == 'category' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/category/">
                            <i class="fa fa-th"></i> <span>Category</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'brand' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/brand/">
                            <i class="fa fa-trello"></i> <span>Brand</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'product' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/product/">
                            <i class="fa fa-product-hunt"></i> <span>Product</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'order' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/order/">
                            <i class="fa fa-send"></i> <span>Order</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'chart' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/chart/">
                            <i class="fa fa-line-chart"></i> <span>Chart</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'user' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/user/">
                            <i class="fa fa-user"></i> <span>User</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'admin' ? 'active' : ''?>">
                            <a href="<?php echo public_admin() ?>modules/admin/">
                            <i class="fa fa-tasks"></i> <span>Admin</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <!--
                        <li class="treeview">
                            <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Charts</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                                <li><a href="charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                                <li><a href="charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                                <li><a href="charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                            </ul>
                        </li>
                    -->
                        <li class="header"><b>EXIT</b></li>
                        <li class="">
                            <a href="<?php echo base_url()?>">
                            <i class="fa fa-home"></i> <span>Home</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo base_url() ?>action/log-out.php">
                            <i class="fa fa-sign-out"></i> <span>Log out</span>
                            <span class="pull-right-container">
                            </span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>