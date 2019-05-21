<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    $category = $db->fetchALL('category');
    $brand = $db->fetchALL('brand');
    $data= [
        'name'   => postInput('name'),
        'slug'    => to_slug(postInput('name')),
        'price' => postInput('price'),
        'category_id' => postInput('category_id'),
        'brand_id' => postInput('brand_id'),
        'amount' => postInput('amount'),
        'content' => postInput('content')
    ];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $error = [];
        if(postInput('name') == ''){
            $error['name'] = "Invalid name combination. Can't be empty";
        }
        if(postInput('category_id') == ''){
            $error['category_id'] = "Invalid category combination. Can't be empty";
        }
        if(postInput('brand_id') == ''){
            $error['brand_id'] = "Invalid brand combination. Can't be empty";
        }
        if(postInput('price') == ''){
            $error['price'] = "Invalid price combination. Can't be empty";
        }
        if(postInput('amount') == ''){
            $error['amount'] = "Invalid amount combination. Can't be empty";
        }
        /*if(!isset($_FILES['image'])){
            echo 'k co file image';
            $error['image'] = "Invalid image combination";
        }*/
        if($_FILES['image']['name'] == ''){
            $error['image'] = "Invalid image combination. Can't be empty";
        }
        if(postInput('content') == ''){
            $error['content'] = "Invalid content combination. Can't be empty";
        }

        if(empty($error)){
           if(isset($_FILES['image'])){
                $file_name = $_FILES['image']['name'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_error = $_FILES['image']['error'];
                if($file_error == 0){
                    $path = ROOT ."products/";
                    $data['image'] = $file_name;
                }
            }
            $row = $db->insert('product', $data);
            if($row){
                $_SESSION['success'] = "Add new product successful";
                move_uploaded_file($file_tmp, $path.$file_name);
                redirectAdmin('product');
                //echo 'Thêm thành công';
            }else{
                $_SESSION['fail'] = "Add new product fail";
                echo "Lỗi: " .$db->error();
            }
        }

    }
    $open = 'product';
    include('../../includes_admin/header_admin.php');
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        PRODUCT PAGE
                        <small>Preview page</small>
                        <a href="add.php" title="Add category" class="btn btn-success btn-xl">ADD</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo public_admin() ?>modules/product/"><i class="fa fa-product-hunt"></i> Product</a></li>
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
                                <div class="form-group col-md-6">
                                    <label for="inputcategory">Category</label>
                                    <select id="inputcategory" class="form-control" name="category_id">
                                        <option value="" selected>Choose category</option>
                                        <?php foreach ($category as $item): ?>
                                            <option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?php
                                        if(isset($error['category_id'])){
                                            echo '<div class="text-danger">';
                                            echo $error['category_id'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputbrand">Brand</label>
                                    <select id="inputbrand" class="form-control" name="brand_id">
                                        <option value="" selected>Choose brand</option>
                                        <?php foreach ($brand as $item): ?>
                                            <option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
                                        <?php endforeach ?>
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
                                    <label for="newcategory">New product</label>
                                    <input type="text" class="form-control" id="newcategory" placeholder="Enter new product name" value="<?php echo isset($data['name']) ? $data['name'] : '' ?>" name="name">
                                    <?php
                                        if(isset($error['name'])){
                                            echo '<div class="text-danger">';
                                            echo $error['name'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="inputprice">Price</label>
                                    <input type="number" class="form-control" id="inputprice" placeholder="VND" value="<?php echo isset($data['price']) ? $data['price'] : '' ?>" name="price">
                                    <?php
                                        if(isset($error['price'])){
                                            echo '<div class="text-danger">';
                                            echo $error['price'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputsale">Sale</label>
                                    <input type="number" class="form-control" id="inputsale" placeholder="%" value="<?php echo isset($data['sale']) ? $data['sale'] : '' ?>" name="sale">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputsale">Amount</label>
                                    <input type="number" class="form-control" id="inputamount" placeholder="Amount of product" value="<?php echo isset($data['amount']) ? $data['amount'] : '' ?>" name="amount">
                                    <?php
                                        if(isset($error['amount'])){
                                            echo '<div class="text-danger">';
                                            echo $error['amount'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="fileimage">Image</label>
                                    <input type="file" class="form-control-file" id="fileimage" name="image">
                                    <?php
                                        if(isset($error['image'])){
                                            echo '<div class="text-danger">';
                                            echo $error['image'];
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="textinput">Content product</label>
                                    <textarea class="form-control" id="textinput" rows="4" name="content"><?php echo isset($data['content']) ? $data['content'] : '' ?></textarea>
                                    <?php
                                        if(isset($error['content'])){
                                            echo '<div class="text-danger">';
                                            echo $error['content'];
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
