<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Index | 請求書</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <h4>請求書</h4>
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
      <img src="dist/img/y0729.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
      <span class="brand-text font-weight-light">Croudkaikei</span>
    </a>

    <!-- User Account -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/Vote 2020 Stickers - Monster and Sign.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">User's name</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                納品書
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./invoice.html" class="nav-link">
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

  <!-- Main Content Wrapper.-->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <section class="content">
        <div class="container-fluid">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-4">
              <!-- PRODUCT LIST -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">請求書一覧</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body p-0">
                  <!-- test -->
                  <!-- <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                      <tr>
                        <th>請求書番号</th>
                        <th>宛先</th>
                        <th>支払い</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td><a href="">123</a></td>
                        <td>株式会社A</td>
                        <td><span class="badge badge-success">支払い済</span></td>
                      </tr>
                      <tr>
                        <td><a href="">456</a></td>
                        <td>B株式会社</td>
                        <td><span class="badge badge-warning">未払い</span></td>
                      </tr>
                      <tr>
                        <td><a href="">789</a></td>
                        <td>有限会社C</td>
                        <td><span class="badge badge-success">支払い済</span></td>
                      </tr>
                      </tbody>
                    </table>
                  </div> -->
                  <!-- /test -->
                  <!-- preview用index -->
                  <ul class="nav nav-tabs flex-column">
                    <li class="nav-item">
                      <a href="#tes1" class="nav-link" data-toggle="tab">タブ1</a>
                    </li>
                    <li class="nav-item">
                      <a href="#tes2" class="nav-link" data-toggle="tab">タブ2</a>
                    </li>
                    <li class="nav-item">
                      <a href="#tes3" class="nav-link" data-toggle="tab">タブ3</a>
                    </li>
                    <li class="nav-item">
                      <a href="#tes4" class="nav-link" data-toggle="tab">タブ4</a>
                    </li>
                  </ul>
                </div>

                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Products</a>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>

            <div class="col-md-8">
              <!-- TABLE: LATEST ORDERS -->
              <div class="card">
                <div class="card-header border-transparent">
                  <p>作成日：###</p>
                  <h3 class="card-title">請求宛先No1</h3>
                  <p>請求件名</p>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->

                <div class="card-body p-0">
                  <div class="table-responsive">
                  </div>
                  <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                  <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                  <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                </div>
                <!-- /.card-footer -->
                
                <!-- プレビュー機能 -->
                <!-- test -->
                <!-- <form>
                  <input type="file" id="input-file">
                </form>
                <div id="preview"></div> -->

                <!-- <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a href="#tes1" class="nav-link" data-toggle="tab">タブ1</a>
                  </li>
                  <li class="nav-item">
                    <a href="#tes2" class="nav-link" data-toggle="tab">タブ2</a>
                  </li>
                  <li class="nav-item">
                    <a href="#tes3" class="nav-link" data-toggle="tab">タブ3</a>
                  </li>
                  <li class="nav-item">
                    <a href="#tes4" class="nav-link" data-toggle="tab">タブ4</a>
                  </li>
                </ul> -->
                <!-- /test -->

                <div class="tab-content">
                  <div id="tes1" class="tab-pane active">
                    <div class="wrapper">
                        
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                          <div class="container-fluid">
                            <div class="row mb-2">
                              <div class="col-sm-6">
                                <h1>請求書</h1>
                              </div>
                            </div>
                          </div><!-- /.container-fluid -->
                        </section>
                    
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
                                        <i class="fas fa-globe"></i> 請求先株式会社_様
                                        <small class="float-right">請求日: 2021/1/16</small>
                                      </h4>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- info row -->
                                  <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                      <address>
                                        〒123-4567<br>
                                        xx県xx市xxxxxx<br>
                                      </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col">
                                      <b>請求書番号:  123</b><br>
                                      <br>
                                      <b>請求元株式会社:</b><br>
                                      <address>
                                        〒234-5678<br>
                                        xx県xx市xxxxxxz<br>
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
                                          <th>数量</th>
                                          <th>単価</th>
                                          <th>金額</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                          <td>サービス＃１</td>
                                          <td>1</td>
                                          <td>式</td>
                                          <td>1,000,000</td>
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
                                            <td>1,000,000</td>
                                          </tr>
                                          <tr>
                                            <th>消費税:</th>
                                            <td>100,000</td>
                                          </tr>
                                          <tr>
                                            <th>合計:</th>
                                            <td>1,100,000</td>
                                          </tr>
                                        </table>
                                      </div>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <!-- /.row -->
                                </div>
                                <!-- /.invoice -->
                              </div><!-- /.col -->
                            </div><!-- /.row -->
                          </div><!-- /.container-fluid -->
                        </section>
                        <!-- /.content -->
                      <!-- /.content-wrapper -->
                      <footer class="main-footer no-print">
                        <b>備考欄</b><br>
                        <text>サンプルサンプルサンプルサンプルサンプル</text>
                      </footer>
                      <!-- /.control-sidebar -->
                    </div>
                    <!-- ./wrapper -->
                  </div>
                  <div id="tes2" class="tab-pane">
                    <h1>B</h1>
                  </div>
                  <div id="tes3" class="tab-pane">
                    <h1>C</h1>
                  </div>
                  <div id="tes4" class="tab-pane">
                    <h1>D</h1>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- script -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- preview機能追加 -->
<script src="dist/js/preview.js"></script>
</body>
</html>
