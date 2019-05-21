<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    $data= [
        'name'   => postInput('name'),
        'slug'   => to_slug(postInput('name')),
    ];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = [];

        if(postInput('name') == ''){
            $error['name'] = "Invalid name combination. Can't be empty";
        }

        if(empty($error)){
            $row = $db->num_rows('brand', $data['name']);
            if(intval($row) < 1){
                if($db->insert('brand', $data)){
                    $_SESSION['success'] = "Add new brand successful";
                    redirectAdmin('brand');
                }else {
                    $_SESSION['fail'] = "Add new brand fail";
                    echo "Lỗi: " .$db->error();
                }
            }else{
                $_SESSION['error'] = "Data has existed";
            }
        }
    }
    $open = 'brand';
    include('../../includes_admin/header_admin.php');
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        BRAND ADD PAGE
                        <small>Preview page</small>
                        <a href="add.php" title="Add category" class="btn btn-success btn-xl">ADD</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo public_admin() ?>modules/brand/"><i class="fa fa-trello"></i> Brand</a></li>
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
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="newcategory">New brand</label>
                                    <input type="text" class="form-control" id="newcategory" placeholder="Enter new brand name" value="<?php echo isset($data['name']) ? $data['name'] : '' ?>" name="name">
                                    <?php
                                        if(isset($error['name'])){
                                            echo '<div class="text-danger">';
                                            echo $error['name'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
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
