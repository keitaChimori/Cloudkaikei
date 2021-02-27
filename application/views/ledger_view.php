<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>売上台帳</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/all.min.css" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/adminlte.min.css" type="text/css" />
</head>
<body class="hold-transition">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <h4>売上台帳</h4>
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
      <span class="brand-text font-weight-light">Cloudkaikei</span>
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
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                請求書
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <section class="content">
      <form method="get" action="">
          <div class="row">
              <div class="col-md-6" style="text-align: center;">
                  <select id="inputCompany" name="inputCompany">
                  <option value="">取引先を選んでください
                  <?php if( !empty($info) ): ?>
                    <?php foreach( $info as $value ): ?>
                      <option value="<?php echo $value['customer']; ?>"><?php echo $value['customer']; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  </select>
                  <span>　</span>
                  <input id="inputDate1" name="inputDate1" type="date" />
                  ~
                  <input id="inputDate2" name="inputDate2" type="date" />
                  <script>
                      var date = new Date();
  
                      var yyyy = date.getFullYear();
                      var mm = ("0"+(date.getMonth()+1)).slice(-2);
                      var dd = ("0"+date.getDate()).slice(-2);
  
                      document.getElementById("inputDate2").value=yyyy+'-'+mm+'-'+dd;
                  </script>
              </div>
              <div class="col-md-6" style="text-align: center;">
                  <input type="button" value="絞り込む" id="button">
                  <span>　</span>
                  <input type="button" value="すべて表示" id="button2">
                  <span>　合計金額：</span>
                  <span id="money"></span>
                  <span>円</span>
              </div>
          </div>
      </form>
      <br>

      <!-- Default box -->
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped projects" id="data">
            <thead>
              <tr>
                <th>
                    取引番号
                </th>
                <th>
                    請求日時
                </th>
                <th>
                    取引先
                </th>
                <th>
                    取引金額
                </th>
                <th>
                    備考
                </th>
              </tr>
            </thead>
            <?php if( !empty($info) ): ?>
              <?php foreach( $info as $value ): ?>
                <tbody>
                <!-- 取引番号 -->
                <td>
                  <?php echo $value['id']; ?>
                </td>
                <!-- 請求日 -->
                <td>
                  <?php echo $value['updated_at']; ?>
                </td>
                <!-- 取引先 -->
                <td>
                  <?php echo $value['customer']; ?>
                </td>
                <!-- 取引金額 -->
                <td>
                  <?php echo $value['total']; ?>
                </td>
                <!-- 備考 -->
                <td>
                  <?php echo $value['note']; ?>
                </td>
              </tbody>
              <?php endforeach; ?>
            <?php endif; ?>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
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

<!-- AdminLTE for demo purposes -->
<script src="<?=base_url() ?>assets/js/demo.js"></script>
<!-- jQuery -->
<script src="<?=base_url() ?>assets/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url() ?>assets/js/adminlte.min.js"></script>

</body>
</html>

<script type="text/javascript">
  var total_money = document.getElementById("money");
  total = 0;
  $("#data tbody tr").each(function(){
    var txt = $(this).find("td").text();

    info = txt.split("\n");
    data = info[4];
    data = data.replace("                    ", "");
    data = data.replace(" ", "");
    data = data.replace("円", "");
    var data = Number( data );
    total = total + data;
  });
  total_money.innerHTML = total;
  $(function(){
      $("#button").bind("click",function(){
          var total_money = document.getElementById("money");
          total = 0;

          var com,time1,time2;
          com = $("#inputCompany").val();
          re = new RegExp(com);

          time1 = document.getElementById("inputDate1").value
          time2 = document.getElementById("inputDate2").value
          const words1 = time1.split("-");
          const words2 = time2.split("-");
          year1 = words1[0];
          month1 = words1[1];
          day1 = words1[2];
          year2 = words2[0];
          month2 = words2[1];
          day2 = words2[2];

          $("#data tbody tr").each(function(){
              var txt = $(this).find("td").text();

              info = txt.split("\n");
              data = info[2];
              data = data.replace("                  ", "");
              data = data.substr(0,11);
              flag = 1;

              if(words1 != ""){   //期間が指定されているとき
                  var days1 = new Date(data);
                  var days2 = new Date(time1);
                  // 経過時間をミリ秒で取得
                  var ms = days1.getTime() - days2.getTime();
                  // ミリ秒を日付に変換(端数切捨て)
                  var days3 = Math.floor(ms / (1000*60*60*24)) + 1;
                  console.log(days3);
                  var days1 = new Date(time2);
                  var days2 = new Date(data);
                  // 経過時間をミリ秒で取得
                  var ms = days1.getTime() - days2.getTime();
                  // ミリ秒を日付に変換(端数切捨て)
                  var days4 = Math.floor(ms / (1000*60*60*24));
                  console.log(days4);
                  if(days3>=0 && days4>=0){
                    flag = 0;
                  }
              }else{
                flag = 0;
              }

              if(flag == 0){
                if(info[3].match(re) != null){
                  $(this).show();

                  data = info[4];
                  data = data.replace("                    ", "");
                  data = data.replace(" ", "");
                  data = data.replace("円", "");
                  var data = Number( data );
                  total = total + data;
                }else{
                  flag = 1;
                }
              }
              if(flag == 1){
                  $(this).hide();
              }
              total_money.innerHTML = total;
          });

      });

      $("#button2").bind("click",function(){
          $("#data tr").show();
          var total_money = document.getElementById("money");
          total = 0;
          $("#data tbody tr").each(function(){
            var txt = $(this).find("td").text();

            info = txt.split("\n");
            data = info[4];
            data = data.replace("                    ", "");
            data = data.replace(" ", "");
            data = data.replace("円", "");
            var data = Number( data );
            total = total + data;
            console.log(total);
          });
          total_money.innerHTML = total;
      });
  });
</script>