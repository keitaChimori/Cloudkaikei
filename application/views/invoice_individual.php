<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <h4>請求書新規登録</h4>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?=base_url() ?>assets/img/y0729.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
      <span class="brand-text font-weight-light">Croudkaikei</span>
    </a>

    <!-- User Account -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url() ?>assets/img/Vote 2020 Stickers - Monster and Sign.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">User's name</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                納品書
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                請求書
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                売上台帳
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    
    <form action="" method="post">
      <br>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> 請求先：
                      <select name="customer">
                        <?php if( !empty($customer) ): ?>
                          <?php foreach( $customer as $value_c ): ?>
                            <option value="<?php echo $value_c['id'] ?>"><?php echo $value_c['name']; ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                      <span>　御中</span>
                      <small class="float-right">
                        請求日：
                        <input name="date" id="inputDate" type="date" />
                        <script>
                          var date = new Date();
      
                          var yyyy = date.getFullYear();
                          var mm = ("0"+(date.getMonth()+1)).slice(-2);
                          var dd = ("0"+date.getDate()).slice(-2);
      
                          document.getElementById("inputDate").value=yyyy+'-'+mm+'-'+dd;
                        </script>
                      </small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <?php if( !empty($user) ): ?>
                  <?php foreach( $user as $value_u ): ?>
                    <?php
                      if($value_u['id'] == 2){
                        break;
                      }
                    ?>
                  <?php endforeach; ?>
                <?php endif; ?>
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    <br>
                    <b>請求元:<?php echo $value_u['name']; ?>
                    </b><br>
                    <address>
                      〒<?php echo $value_u['post']; ?><br>
                      <?php
                        $prefs = array ('選択してください','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','新潟県','富山県','石川県','福井県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
                        echo $prefs[$value_u['prefecture']];
                        echo $value_u['adress1'].$value_u['address2'];
                      ?>
                    </address> 
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped" id="tblForm">
                      <thead>
                      <tr>
                        <th>詳細</th>
                        <th>価格</th>
                        <th>数量</th>
                        <th>単位</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td><input type="text" name="product_name[]" value="材料"></td>
                        <td><input type="text" name="price[]" value="10000"></td>
                        <td><input type="text" name="num[]" value="10"></td>
                        <td><input type="text" name="unit[]" value="個"></td>
                        <td><input class="btnDelete" type="button" value="削除" /></td>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <input id="btnAdd" type="button" value="＋" style="width:50px; height:50px; border-radius:100%; float:right;" class="btn btn-success"/>
                <br>
                <b>備考欄</b><br>
                <input type="text" name="note" value="なし" size="40">
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <input type="submit" value="送信する">
      <!-- /.content -->
    </form>
  </div>

  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <b>備考欄</b><br>
    <text>サンプルサンプルサンプルサンプルサンプル</text>
  </footer>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url() ?>assets/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url() ?>assets/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url() ?>assets/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url() ?>assets/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=base_url() ?>assets/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url() ?>assets/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url() ?>assets/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url() ?>assets/moment/moment.min.js"></script>
<script src="<?=base_url() ?>assets/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url() ?>assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url() ?>assets/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url() ?>assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url() ?>assets/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url() ?>assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url() ?>assets/js/pages/dashboard.js"></script>
</body>
</html>
<script>
var row = 1;
jQuery(function($) {
  $("#btnAdd").on("click", function() {
    // 最終行ではなく、非表示になっている最初の行なので first-child になっている
    $("#tblForm tbody tr:first-child").clone(true).appendTo("#tblForm tbody");
    // 複製後に表示させる
    $("#tblForm tbody tr:last-child").css("display", "table-row");

    // 行削除
    $(".btnDelete").on("click", function() {
      if(row > 1){
        $(this).parent().parent().remove();
        row = tblForm.rows.length - 1;
        console.log(row);
      }
    });
    row = tblForm.rows.length - 1;
    console.log(row);
  });
});
</script>