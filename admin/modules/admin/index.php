<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $sql = "SELECT * FROM `admin`";
    $product = $db->fetchJone('admin', $sql, $page, 2, true);
    $x = $db->countTable('admin');
    if(isset($product['page'])){
        $sotrang = $product['page'];
        unset($product['page']);
    }
    $open = 'admin';
    include('../../includes_admin/header_admin.php');
?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        ADMIN PAGE
                        <small>Preview page</small>
                        <a href="add.php" title="Add admin" class="btn btn-success btn-xl">ADD</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Admin</li>
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
                                  <table class="table table-bordered" id="users" style="width: 100%; background-color: #c3d5ff" >
                                    <thead >
                                        <tr id="list-header">
                                            <th scope="col">No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Mail</th>   
                                            <th scope="col">Password</th>
                                            <th scope="col">Infor</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col">Update at</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt = 1; foreach ($product as $item): ?>
                                        <tr>
                                            <td><?php echo $stt?></td>
                                            <td><?php echo $item['name']?></td>
                                            <td><?php echo $item['mail']?></td>
                                            <td><?php echo $item['password']?></td>
                                            <td>
                                            <ul>
                                                <li>Phone: <?php echo $item['phone']?></li>
                                                <li>Status: <?php echo $item['status']?></li>
                                                <li>Level: <?php echo $item['level']?></li>
                                            </ul>
                                            </td>
                                            <td><?php echo $item['address']?></td>
                                            <td><?php echo $item['created_at']?></td>
                                            <td><?php echo $item['updated_at']?></td>
                                            <td>
                                                <a class="btn btn-info btn-xs" href="edit.php?id=<?php echo $item['id']?>"><i class="fa fa-edit"></i>  Fix</a>
                                                <a class="btn btn-success btn-xs" href="reset.php?id=<?php echo $item['id']?>"><i class="fa fa-refresh"></i>  Reset</a>
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
