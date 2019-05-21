<?php
    require_once('../../core_admin/init_admin.php');
    error_reporting(0);
    // $sql = "SELECT (date(created_at)) as days, COUNT(*) as 'coun' FROM orders WHERE (date(created_at)) = '2019-05-10' GROUP BY (date(created_at));";

    $label1 = '';
    $date = '';
    $rs1 = '';
    for($i=0; $i<7; $i++){
        $now = mktime(0, 0, 0 ,date('m'), date('d')-$i, date('Y'));
        $label1 = '\'' . date('Y-m-d', $now) . '\',' . $label1;
        $date = date('Y-m-d', $now);
        $value = $db->query_date($date);
        $rs1 = intval($value[0]['coun']) . ', ' . $rs1;
        //_debug(intval($value[0]['coun']));
        //echo $rs1;
    }
    $label2 = '';
    $rs2 = '';
    $sql_product = 'SELECT * FROM product ORDER BY pay DESC LIMIT 7';
    $value2 = $db->query($sql_product, true);
    for($i=0; $i<7; $i++){
        $label2 .= '\'' . $value2[$i]['name'] . '\',';
        $rs2 .= '\'' . $value2[$i]['pay'] . '\',';
    }
    // _debug($label2);
    // _debug($rs2);
    $open = 'chart';
    include('../../includes_admin/header_admin.php');
?>
    <script type="text/javascript" src="../../../js/Chart.min.js"></script>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Chart PAGE
                        <small>Preview page</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo public_admin() ?>"><i class="fa fa-home"></i> Home</a></li>
                        <li class="active">chart</li>
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
                            <canvas id="myChart" width="400" height="400"></canvas>
                            <canvas id="mySecond" width="400" height="400"></canvas>
                            <script>
                                var ctx = document.getElementById('myChart').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels:[<?php echo $label1 ?>],
                                        datasets: [
                                            {
                                                label: 'Invoice in the past week',
                                                data: [<?php echo $rs1 ?>],
                                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1
                                            },
                                            {
                                                label: '#2 of Votes',
                                                data: [12, 25 ,12 ,19 ,31 ,21 ,80],
                                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                borderColor: 'rgba(255, 99, 132, 1)',
                                                borderWidth: 1
                                            },
                                        ]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>
                            <script>
                                var ctx2 = document.getElementById('mySecond').getContext('2d');
                                var mySecond = new Chart(ctx2, {
                                    type: 'bar',
                                    data: {
                                        labels:[<?php echo $label2 ?>],
                                        datasets: [
                                            {
                                                label: 'Selling products',
                                                data: [<?php echo $rs2 ?>],
                                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1
                                            },
                                            {
                                                label: '#2 of Votes',
                                                data: [12, 25 ,12 ,19 ,31 ,21 ,80],
                                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                borderColor: 'rgba(255, 99, 132, 1)',
                                                borderWidth: 1
                                            },
                                        ]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>
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
