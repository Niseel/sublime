<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    $data= [
        'name'   => postInput('name'),
        'address' => postInput('address'),
        'mail' => postInput('mail'),
        'password' => postInput('password'),
        'phone' => postInput('phone'),
        'level' => postInput('level')
    ];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $error = [];
        if(postInput('name') == ''){
            $error['name'] = "Invalid name combination. Can't be empty";
        }
        if(postInput('address') == ''){
            $error['address'] = "Invalid address combination. Can't be empty";
        }

        if(postInput('mail') == ''){
            $error['mail'] = "Invalid mail combination. Can't be empty";
        }
        if(postInput('password') == ''){
            $error['password'] = "Invalid password combination. Can't be empty";
        }
        if(postInput('re_password') != postInput('password')){
            $error['re_password'] = "Invalid password confirmation. Can't be empty";
        }
        if(postInput('phone') == ''){
            $error['phone'] = "Invalid phone combination. Can't be empty";
        }

        if(empty($error)){
            $data['password'] = MD5(postInput('password'));
            $row = $db->insert('user', $data);
            if($row){
                $_SESSION['success'] = "Add user successful";
                redirectAdmin('user');
            }else{
                $_SESSION['fail'] = "Add user fail";
                echo "Lỗi: " .$db->error();
            }
        }
    }
    $open = 'user';
    include('../../includes_admin/header_admin.php');
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        USER PAGE
                        <small>Preview page</small>
                        <a href="add.php" title="Add category" class="btn btn-success btn-xl">ADD</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo public_admin() ?>modules/user/"><i class="fa fa-user"></i> User</a></li>
                        <li class="active">Add</li>
                    </ol>
                </section>
                <!-- Main content -->
                <?php
                    include('../../../patials/notification.php');
                ?>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- enctype="multipart/form-data" -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-12">
                                    <label for="newcategory">New user</label>
                                    <input type="text" class="form-control" id="newadmin" placeholder="Enter new user name" value="<?php echo isset($data['name']) ? $data['name'] : '' ?>" name="name">
                                    <?php
                                        if(isset($error['name'])){
                                            echo '<div class="text-danger">';
                                            echo $error['name'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="newcategory">Email</label>
                                    <input type="email" class="form-control" id="mailadmin" placeholder="Enter user email" value="<?php echo isset($data['mail']) ? $data['mail'] : '' ?>" name="mail">
                                    <?php
                                        if(isset($error['mail'])){
                                            echo '<div class="text-danger">';
                                            echo $error['mail'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="newcategory">Password</label>
                                    <input type="password" class="form-control" id="passadmin"  value="<?php echo isset($data['password']) ? $data['password'] : '' ?>" name="password">
                                    <?php
                                        if(isset($error['password'])){
                                            echo '<div class="text-danger">';
                                            echo $error['password'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="newcategory">Confirm Password</label>
                                    <input type="password" class="form-control" id="re_passadmin"  value="" name="re_password">
                                    <?php
                                        if(isset($error['re_password'])){
                                            echo '<div class="text-danger">';
                                            echo $error['re_password'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="newcategory">Phone</label>
                                    <input type="text" class="form-control" id="phoneadmin" placeholder="Enter phone number" value="<?php echo isset($data['phone']) ? $data['phone'] : '' ?>" name="phone">
                                    <?php
                                        if(isset($error['phone'])){
                                            echo '<div class="text-danger">';
                                            echo $error['phone'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputbrand">Level</label>
                                    <select id="inputbrand" class="form-control" name="level">
                                        <option value="1" <?php echo isset($data['level']) && $data['level'] == 1 ? 'selected = "selected"' : ''?>>USER</option>
                                        <option value="2" <?php echo isset($data['level']) && $data['level'] == 2 ? 'selected = "selected"' : ''?>>SALE</option>
                                        <option value="3" <?php echo isset($data['level']) && $data['level'] == 3 ? 'selected = "selected"' : ''?>>MANEGER</option>
                                    </select>
                                    <?php
                                        if(isset($error['brand_id'])){
                                            echo '<div class="text-danger">';
                                            echo $error['brand_id'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="newcategory">Address</label>
                                    <input type="text" class="form-control" id="addressadmin" placeholder="Enter address" value="<?php echo isset($data['address']) ? $data['address'] : '' ?>" name="address">
                                    <?php
                                        if(isset($error['address'])){
                                            echo '<div class="text-danger">';
                                            echo $error['address'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>

                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
<!-- footer -->
<?php
    include('../../includes_admin/footer_admin.php');
?>
<!-- /.footer -->
