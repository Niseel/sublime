<?php
    require_once('../../core_admin/init_admin.php');

    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    $data= [
        'name'   => postInput('name'),
        'slug'    => to_slug(postInput('name')),
        'content'    => postInput('content')
    ];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = [];

        if(postInput('name') == ''){
            $error['name'] = "Invalid name combination. Can't be empty";
        }
        if($_FILES['banner']['name'] == ''){
            $error['banner'] = "Invalid banner combination. Can't be empty";
        }
        if(postInput('content') == ''){
            $error['content'] = "Invalid content combination. Can't be empty";
        }

        if(empty($error)){
            //
            if(isset($_FILES['banner'])){
                $file_name = $_FILES['banner']['name'];
                $file_tmp = $_FILES['banner']['tmp_name'];
                $file_type = $_FILES['banner']['type'];
                $file_error = $_FILES['banner']['error'];
                if($file_error == 0){
                    $path = ROOT ."categories/";
                    $data['banner'] = $file_name;
                }
            }
            $row = $db->num_rows('category', $name);
            if(intval($row) < 1){
                if($db->insert('category', $data)){
                    move_uploaded_file($file_tmp, $path.$file_name);
                    $_SESSION['success'] = "Add new category successful";
                    redirectAdmin('category');
                    //echo 'Thêm thành công';
                }else {
                    $_SESSION['fail'] = "Add new category fail";
                    echo "Lỗi: " .$db->error();
                }
            }else{
                $_SESSION['error'] = "Data has existed";
            }
        }
    }
    $open = 'category';
    include('../../includes_admin/header_admin.php');
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        CATEGORY ADD PAGE
                        <small>Preview page</small>
                        <a href="add.php" title="Add category" class="btn btn-success btn-xl">ADD</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo public_admin() ?>modules/category/"><i class="fa fa-th"></i> Category</a></li>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-6">
                                    <label for="newcategory">New category</label>
                                    <input type="text" class="form-control" id="newcategory" placeholder="Enter new category name" value="<?php echo isset($data['name']) ? $data['name'] : '' ?>" name="name">
                                    <?php
                                        if(isset($error['name'])){
                                            echo '<div class="text-danger">';
                                            echo $error['name'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="textinput">Content category</label>
                                    <textarea class="form-control" id="textinput" rows="3" name="content"><?php echo isset($data['content']) ? $data['content'] : '' ?></textarea>
                                    <?php
                                        if(isset($error['content'])){
                                            echo '<div class="text-danger">';
                                            echo $error['content'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fileimage">Banner</label>
                                    <input type="file" class="form-control-file" id="fileimage" id="fileimage" name="banner">
                                    <?php
                                        if(isset($error['banner'])){
                                            echo '<div class="text-danger">';
                                            echo $error['banner'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
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
