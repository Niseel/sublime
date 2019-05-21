<?php
    require_once('../../core_admin/init_admin.php');

    $id = intval(getInput('id'));
    $value = $db->getRowArray('orders', $id);
    //var_dump($value);
    if(empty($value)){
        $_SESSION['error'] = "No data";
        redirectAdmin('order');
    }
    $sum = 0;
    $sql1 = "SELECT orders.*, user.name as user_name FROM orders LEFT JOIN user on user.id = orders.user_id WHERE orders.id = $id";

    $sql2 = "SELECT orders.admin_id, user.name as admin_name FROM orders LEFT JOIN user on user.id = orders.admin_id WHERE orders.id = $id";

    $value = $db->queryy($sql1, true);
    $getAdmin = $db->queryy($sql2, true);
    //_debug($value);
    //_debug($getAdmin);

    $sql_detail = "SELECT detailorder.*, product.name as product_name FROM detailorder LEFT JOIN product on detailorder.product_id= product.id WHERE order_id = $id;";
    $detail = $db->query($sql_detail, true);
    //_debug($detail);

    $open = 'order';
    include('../../includes_admin/header_admin.php');
?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        DETAIL ORDERS PAGE
                        <small>Preview page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="<?php echo public_admin() ?>modules/order/"><i class="fa fa-send"></i> Order</a></li>
                        <li class="active">Detail</li>
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
                        <div class="col-md-6">
                            <b>Order ID:&emsp;<?php echo $value['id']?></b></br>
                            <b>Employees Name (ID):&emsp;<?php echo $getAdmin['admin_name'] .'  ('. $getAdmin['admin_id'].')'?></b></br>
                            <b>Date:&emsp;<?php echo $value['created_at']?></b></br>
                        </div>
                        <div class="col-md-6">
                            <b>Customer Name (ID):&emsp;<?php echo $value['user_name']?></b></br>
                            <b>Phone:&emsp;<?php echo $value['phone_curr']?></b></br>
                            <b>Shiping address:&emsp;<?php echo $value['address_curr']?></b></br>
                            <b>Method paying:&emsp;
                            <?php
                            if($value['method_paying'] == 1){
                                echo 'Cash on delivery';
                            }else{
                                echo 'Credit card' . '</br>';
                                echo '<b>Bank:&emsp;';
                                echo $value['bank_brand'];
                                echo '</b></br>';
                                echo 'Credit card' . '</b>';
                                echo '<b>Card number:&emsp;';
                                echo $value['card_number'];
                                echo '</b></br>';
                            }
                            ?>
                            </b></br>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                  <table class="table table-bordered" id="users" style="width: 100%; background-color: #c3d5ff">
                                    <thead >
                                        <tr id="list-header">
                                            <th scope="col">Product ID</th>
                                            <th scope="col">Product name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit price</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detail as $item): ?>
                                        <tr>
                                            <td><?php echo $item['product_id'] ?></td>
                                            <td><?php echo $item['product_name']?></td>
                                            <td><?php echo $item['qty']?></td>
                                            <td>$<?php echo $item['price']?></td>
                                            <td>$<?php echo $item['total']?></td>
                                            <?php $sum += $item['total']?>
                                        </tr>
                                        <?php endforeach ?>

                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="background: #cbe0de; height: 40px; margin: 0px 10px 0px 15px;"><div style="padding: 10px 0px"><b>TOTAL CASH (with 10% VAT):&emsp; $<?php echo formatPrice(($sum*110)/100)?></b></div></div>
                    </div>
                    <div class="row" style="margin: 15px 0px 0px 0px;">
                            <div class="btn btn-success" id="accept" onclick="accept(<?php echo $getAdmin['admin_id'] ?>, '<?php echo $getAdmin['admin_name']?>', <?php echo $value['id']?>)">Accept</div>
                            <div class="btn btn-warning"><a href="<?php echo base_url()?>admin/modules/order/" style="color: white;">&nbsp;Back&nbsp;</a></div>
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
function accept(admin_id, admin_name, order_id){
    var text = "As an admin whose name and ID is " +admin_name+ "(" +admin_id+ ") would you like to approve this order?";
    var r = confirm(text);
    if(r == true) {
      window.location.href = "http://localhost/sublime/admin/modules/order/status.php?id="+order_id;
    }else {

    }
}
</script>
<!-- /.footer -->
