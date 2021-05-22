<!-- ******************************** -->
<!-- *****   請求書TOPページ    ***** -->
<!-- ******************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>請求書 | Cloudkaikei</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <h4 class="mt-2">請求書</h4>
      <?php var_dump($info); ?>
      
    </nav>

    <!-- サイドメニュー表示 -->
    <?php $this->load->view('sidemenu_view'); ?>

    <!-- Main Content Wrapper.-->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <section class="content">
          <div class="container-fluid">
            <br>
            <!-- Main row -->
            <div class="row">
              <!-- Left col -->
              <div class="col-md-4">
                <!-- PRODUCT LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">請求書一覧</h3>
                  </div>

                  <div class="card-body p-0">
                    <!-- preview用index -->
                    <ul class="nav nav-tabs flex-column">
                      <li class="nav-item">
                        <?php if (!empty($id)) : ?>
                          <?php foreach ($id as $value) : ?>
                            <?php
                            $y = substr($value['date'], 0, 4);
                            $m = substr($value['date'], 4, 2);
                            $d = substr($value['date'], 6, 2);
                            ?>
                            <a href="/invoice?id=<?php echo $value['id']; ?>" class="nav-link">
                              <?php echo $value['id'] . "　" . $y . "年" . $m . "月" . $d . "日　"; ?>
                              <?php if (!empty($customer)) : ?>
                                <?php foreach ($customer as $value_c) : ?>
                                  <?php
                                  if ($value['customer'] == $value_c['id']) {
                                    echo $value_c['name'];
                                  }
                                  ?>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </a>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

              <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                <div class="card">
                  <!-- /.card-header -->

                  <div class="card-body p-0">
                    <div class="table-responsive">
                    </div>
                    <!-- /.table-responsive -->
                  </div>

                  <div class="tab-content">
                    <div id="tes1" class="tab-pane active">
                      <div class="wrapper">

                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                          <div class="container-fluid">
                            <a href="/invoice/register" class="btn-sm">新規登録</a>
                            <a href="/invoice/edit?id=<?php if (!empty($invoice['id'])) {
                                                        echo $invoice['id'];
                                                      } ?>" class="btn-sm">編集</a>
                            <a href="/invoice/delete?id=<?php if (!empty($invoice['id'])) {
                                                          echo $invoice['id'];
                                                        } ?>" class="btn-sm">削除</a>
                            <form method="POST" name="invoice_pdf" action="Pdf_create.php">                           
                              <a href="/Pdf_create?invoice_id=<?php echo $info[0]['invoice_id']; ?>" class="btn-sm" onclick="document.invoice_pdf.submit();">請求書出力</a>
                              <input type="hidden" name="data" value="">
                            </form> 
                            <a href="" class="btn-sm">納品書出力</a>
                          </div><!-- /.container-fluid -->
                        </section>

                        <section class="content">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-12">
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                  <!-- title row -->
                                  <h2 style="text-align:center;">請求書</h2>
                                  <br>
                                  <div class="row">
                                    <div class="col-12">
                                      <h4>

                                        <?php if (!empty($customer)) : ?>
                                          <?php foreach ($customer as $value_c) : ?>
                                            <?php
                                            if (!empty($value_c['id']) && !empty($invoice['customer'])) {
                                              if ($invoice['customer'] == $value_c['id']) {
                                                echo $value_c['name'] . "  御中";
                                              }
                                            }
                                            ?>
                                          <?php endforeach; ?>
                                        <?php endif; ?>
                                        <small class="float-right">
                                          請求日:
                                          <?php
                                          if (!empty($invoice['date'])) {
                                            $y = substr($invoice['date'], 0, 4);
                                            $m = substr($invoice['date'], 4, 2);
                                            $d = substr($invoice['date'], 6, 2);
                                            echo $y . "年" . $m . "月" . $d . "日";
                                          }
                                          ?>
                                        </small>
                                      </h4>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- info row -->
                                  <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                      <b>請求書番号: <?php if (!empty($info[0]['invoice_id'])) {
                                                  echo $info[0]['invoice_id'];
                                                } ?></b><br>
                                      <br>
                                      <?php if (!empty($user)) : ?>
                                        <?php foreach ($user as $value_u) : ?>
                                          <?php
                                          if ($value_u['id'] == 2) {
                                            break;
                                          }
                                          ?>
                                        <?php endforeach; ?>
                                      <?php endif; ?>
                                      <b>請求元:<?php echo $value_u['name']; ?></b><br>
                                      <address>
                                        〒<?php echo $value_u['post']; ?><br>
                                        <?php
                                        $prefs = array('選択してください', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県', '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県');
                                        echo $prefs[$value_u['prefecture']];
                                        echo $value_u['address1'] . $value_u['address2'];
                                        ?>
                                        <br>
                                      </address>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->

                                  <!-- Table row -->
                                  <div class="row">
                                    <div class="col-12 table-responsive">
                                      <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th>詳細</th>
                                            <th>価格</th>
                                            <th>数量</th>
                                            <th>単位</th>
                                            <th>金額</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          // print_r($info);
                                          $line = count($info);
                                          $total = 0;
                                          ?>
                                          <?php for ($i = 0; $i < $line; $i++) { ?>
                                            <tr>
                                              <?php if ($info[$i]['invoice_id'] == $info[0]['invoice_id']) : ?>
                                                <td><?php echo $info[$i]['product_name']; ?></td>
                                                <td><?php echo number_format($info[$i]['price']); ?>円</td>
                                                <td><?php echo $info[$i]['num']; ?></td>
                                                <td><?php echo $info[$i]['unit']; ?></td>
                                                <td><?php
                                                    $total = $total + $info[$i]['price'] * $info[$i]['num'];
                                                    echo number_format($info[$i]['price'] * $info[$i]['num']);
                                                    ?>円</td>
                                              <?php endif; ?>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->

                                  <div class="row">
                                    <!-- accepted payments column -->

                                    <!-- /.col -->
                                    <div class="col-6" id="amount">
                                      <div class="table-responsive">
                                        <table class="table">
                                          <tr>
                                            <th style="width:50%">小計:</th>
                                            <td><?php echo number_format($total); ?>円</td>
                                          </tr>
                                          <tr>
                                            <th>消費税:</th>
                                            <td>
                                              <?php
                                              $tax = floor($total / 10.0);
                                              echo number_format($tax);
                                              ?>円
                                            </td>
                                          </tr>
                                          <tr>
                                            <th>合計:</th>
                                            <td>
                                              <?php
                                              echo number_format($total + $tax);
                                              ?>円
                                            </td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                  <b>振込先：<?php echo $value_u['bank_name']; ?></b><br>
                                  <b>　口座：<?php echo $value_u['bank_account']; ?></b>
                                  <br>
                                  <br>
                                  <footer class="main-footer no-print">
                                    <b>備考欄</b><br>
                                    <text><?php if (!empty($invoice['note'])) {
                                            echo $invoice['note'];
                                          } ?></text>
                                  </footer>
                                </div>
                                <!-- /.invoice -->
                              </div><!-- /.col -->
                            </div><!-- /.row -->
                          </div><!-- /.container-fluid -->
                        </section>
                        <!-- /.content -->
                        <!-- /.content-wrapper -->
                      </div>
                      <!-- ./wrapper -->
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>
        </section>
      </section>
    </div><!-- /.content-wrapper -->
    <!-- footer表示 -->
    <?php $this->load->view('footer_view'); ?>

    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->



  <!-- script -->
  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>assets/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?= base_url() ?>assets/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url() ?>assets/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url() ?>assets/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url() ?>assets/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url() ?>assets/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url() ?>assets/moment/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url() ?>assets/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url() ?>assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?= base_url() ?>assets/js/pages/dashboard.js"></script>
  <!-- preview機能追加 -->
  <script src="<?= base_url() ?>assets/js/preview.js"></script>

  <script>
    // カレントページ表示
    $(document).ready(function() {
      if (location.pathname != "/") {
        $('.nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
      } else $('.nav li a:eq(0)').addClass('active');
    });
  </script>
</body>

</html>