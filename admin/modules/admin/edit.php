<?php
    require_once('../../core_admin/init_admin.php');
    $id = intval(getInput('id'));
    $value = $db->getRowArray('admin', $id);

    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('admin');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //
        $data= [
            'name'   => postInput('name'),
            'address' => postInput('address'),
            'mail' => postInput('mail'),
            'phone' => postInput('phone'),
            'level' => postInput('level')
        ];
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
        if(postInput('phone') == ''){
            $error['phone'] = "Invalid phone combination. Can't be empty";
        }

        if(empty($error)){
            $row = $db->numRow_check('admin', 'mail', $data['mail'], $id);
            if(intval($row) < 1){ // return 1 is false
                if($db->update('admin', $data, $id)){
                    $_SESSION['success'] = "Update admin successful";
                    redirectAdmin('admin');
                }else {
                    $_SESSION['fail'] = "Update admin fail";
                    echo "Lỗi: " .$db->error();
                }
            }else{
                $_SESSION['error'] = "Data has existed";
            }
        }
    }
    $open = 'admin';
    include('../../includes_admin/header_admin.php');
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        ADMIN EDIT PAGE
                        <small>Preview page</small>
                        <a href="add.php" title="Add category" class="btn btn-success btn-xl">ADD</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo public_admin() ?>modules/admin/"><i class="fa fa-tasks"></i> Admin</a></li>
                        <li class="active">Edit</li>
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
                            <form action="" method="post">
                                <div class="form-group col-md-12">
                                    <label for="newcategory">New admin</label>
                                    <input type="text" class="form-control" id="newadmin" placeholder="Enter new admin name" value="<?php echo isset($data['name']) ? $data['name'] : $value['name']?>" name="name">
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
                                    <input type="email" class="form-control" id="mailadmin" placeholder="Enter admin email" value="<?php echo isset($data['mail']) ? $data['mail'] : $value['mail']?>" name="mail">
                                    <?php
                                        if(isset($error['mail'])){
                                            echo '<div class="text-danger">';
                                            echo $error['mail'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="newcategory">Phone</label>
                                    <input type="text" class="form-control" id="phoneadmin" placeholder="Enter phone number" value="<?php echo isset($data['phone']) ? $data['phone'] : $value['phone']?>" name="phone">
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
                                        <option value="1" <?php
                                        if(isset($data['level'])){
                                            if($data['level'] == 1){
                                                echo 'selected="selected"';
                                            }else{
                                                echo '';
                                            }
                                        }else{
                                            if(isset($value['level']) && $value['level'] == 1){
                                                echo 'selected="selected"';
                                            }else{
                                                echo '';
                                            }
                                        }
                                        ?>
                                        >SALE</option>
                                        <option value="2" <?php
                                        if(isset($data['level'])){
                                            if($data['level'] == 2){
                                                echo 'selected="selected"';
                                            }else{
                                                echo '';
                                            }
                                        }else{
                                            if(isset($value['level']) && $value['level'] == 2){
                                                echo 'selected="selected"';
                                            }else{
                                                echo '';
                                            }
                                        }
                                        ?>
                                        >MANEGER</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="newcategory">Address</label>
                                    <input type="text" class="form-control" id="addressadmin" placeholder="Enter address" value="<?php echo isset($data['address']) ? $data['address'] : $value['address']?>" name="address">
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
    <script type="text/javascript">
        /*$(document).ready(function(){
            $('#rs_pass').click(function(){
                $('#passadmin').attr('value', '123456');
                alert('Password reset to \'123456\'');
            });
        });*/

    </script>
<!-- /.footer -->
