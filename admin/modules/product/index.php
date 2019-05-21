<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_SESSION['error'])){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    include('../../includes_admin/permission.php');
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $sql = "SELECT product.*, category.name as category_name, brand.name as brand_name FROM product LEFT JOIN category on category.id = product.category_id LEFT JOIN brand on brand.id = product.brand_id";
    $product = $db->fetchJone('product', $sql, $page, 10, true);

    if(isset($product['page'])){
        $sotrang = $product['page'];
        unset($product['page']);
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
                        <li class="active">product</li>
                    </ol>
                </section>
            </hr>
                <div class="clearfix"></div>
                <div class="row">
                        <div class="col-md-12">
                        <?php
                            include('../../../patials/notification.php');
                        ?>
                        </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                  <table class="table table-bordered" id="users" style="width: 100%; background-color: #c3d5ff">
                                    <thead >
                                        <tr id="list-header">
                                            <th scope="col">No</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Sale</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Infor</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt = 1; foreach ($product as $item): ?>
                                        <tr>
                                            <td><?php echo $stt?></td>
                                            <td>
                                                <img src="<?php echo uploads()?>products/<?php echo $item['image']?>" width="80px" height="100px">
                                            </td>
                                            <td><?php echo $item['name']?></td>
                                            <td><?php echo $item['price']?></td>
                                            <td><?php echo $item['sale']?> %</td>
                                            <td><?php echo $item['category_name']?></td>
                                            <td><?php echo $item['brand_name']?></td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a class="<?php echo $item['status']==1  ? 'btn btn-success btn-xs' : 'btn btn-danger btn-xs'?>"
                                                    href="status.php?id=<?php echo $item['id']?>">

                                                    <?php echo $item['status']==1 ? 'Active' : 'Inactive'?>
                                                        </a>
                                                    </li>
                                                    <li>Amount: <?php echo $item['amount']?></li>
                                                    <li>View: <?php echo $item['view']?></li>
                                                    <li>Payed: <?php echo $item['pay']?></li>
                                                    <li>Created at: <?php echo $item['created_at']?></li>
                                                    <li>Updated at: <?php echo $item['updated_at']?></li>
                                                </ul>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-xs" href="edit.php?id=<?php echo $item['id']?>"><i class="fa fa-edit"></i>  Fix</a>
                                                <a class="btn btn-danger btn-xs" href="delete.php?id=<?php echo $item['id']?>"><i class="fa fa-times"></i>  Delete</a>
                                            </td>
                                        </tr>
                                        <?php $stt++; endforeach ?>


                                    </tbody>
                                  </table>
                            </div>
                        </div>
                        <div class="pull-right">
                            <nav aria-label="Page navigation" class="clearfix">
                                <ul class="pagination">
                                    <li>
                                        <a href="" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i=1; $i <=$sotrang ; $i++) {
                                        if(isset($_GET['page'])){
                                            $page = $_GET['page'];
                                        }else{
                                            $page = 1;
                                        }
                                    ?>
                                        <li class="<?php echo ($i == $page)? 'active' : ''?>">
                                            <a href="?page=<?php echo $i?>" ><?php echo $i?></a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a href="" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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
