<?php
    require_once('../../core_admin/init_admin.php');
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $sql = "SELECT orders.*, user.name as user_name, user.phone as user_phone, user.address as user_address FROM orders LEFT JOIN user on user.id = orders.user_id ORDER BY id DESC";
    $orders = $db->fetchJone('orders', $sql, $page, 5, true);

    if(isset($orders['page'])){
        $sotrang = $orders['page'];
        unset($orders['page']);
    }
    $open = 'order';
    include('../../includes_admin/header_admin.php');
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        ORDERS PAGE
                        <small>Preview page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">Orders</li>
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Infor</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $stt = 1; foreach ($orders as $item): ?>
                                        <tr>
                                            <td><?php echo $stt?></td>
                                            <td><?php echo $item['user_name']?></td>
                                            <td><?php echo $item['amount']?></td>
                                            <td>
                                                <ul>
                                                    <li class="">
                                                        <a class="fa fa-<?php echo $item['status']==1 ? 'unlock' : 'lock' ?> <?php echo $item['status']==1  ? 'btn btn-success btn-xs' : 'btn btn-danger btn-xs'?>"
                                                    href="status.php?id=<?php echo $item['id']?>">

                                                    <?php echo $item['status']==1 ? 'Processed' : 'No process'?>
                                                        </a>
                                                    </li>
                                                    <li>Phone: <?php echo $item['user_phone']?></li>
                                                    <li>Address: <?php echo $item['user_address']?></li>
                                                    <li>Created at: <?php echo $item['created_at']?></li>
                                                    <li>Updated at: <?php echo $item['updated_at']?></li>
                                                </ul>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-xs" href="edit.php?id=<?php echo $item['id']?>"><i class="fa fa-edit"></i>  Fix</a>
                                                <a class="btn btn-success btn-xs" href="detail.php?id=<?php echo $item['id']?>"><i class="fa fa-edit"></i>  Detail</a>
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
