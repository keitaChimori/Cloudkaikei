<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>売上台帳</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/all.min.css" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css" type="text/css" />
</head>

<body class="hold-transition">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <h4>売上台帳</h4>
        <!-- <?php var_dump($this->session->userdata('id')); ?> -->
      </ul>
    </nav>

    <!-- サイドメニュー表示 -->
    <?php $this->load->view('sidemenu_view'); ?>

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
                  <?php if (!empty($customer)) : ?>
                    <?php foreach ($customer as $value_c) : ?>
                <option value="<?php echo $value_c['name']; ?>"><?php echo $value_c['name']; ?>
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
                var mm = ("0" + (date.getMonth() + 1)).slice(-2);
                var dd = ("0" + date.getDate()).slice(-2);

                document.getElementById("inputDate2").value = yyyy + '-' + mm + '-' + dd;
              </script>
            </div>
            <div class="col-md-6" style="text-align: center;">
              <input type="button" value="絞り込む" id="button">
              <span>　</span>
              <input type="button" value="すべて表示" id="button2">
              <span>　合計金額：</span>
              <span id="money"></span>
              <span>円（消費税込み）</span>
            </div>
          </div>
        </form>
        <br>

        <!-- Default box -->
        <div class="card">
          <div class="card-body p-0">
            <table class="table table-striped" id="data">
              <thead>
                <tr>
                  <th>取引番号</th>
                  <th>請求日</th>
                  <th>取引先</th>
                  <th>取引金額</th>
                  <th>備考</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($info)) : ?>
                  <?php foreach ($info as $value) : ?>
                    <tr>
                      <!-- 取引番号 -->
                      <td> <?php echo "\n" . $value['id'] . "\n"; ?> </td>
                      <!-- 請求日 -->
                      <td>
                        <?php
                        echo "\n" . substr($value['date'], 0, -4) . "/" .
                          substr($value['date'], 4, -2) . "/" .
                          substr($value['date'], 6) . "\n";
                        ?>
                      </td>
                      <!-- 取引先 -->
                      <td>
                        <?php if (!empty($customer)) : ?>
                          <?php foreach ($customer as $value_c) : ?>
                            <?php
                            if ($value['customer'] == $value_c['id']) {
                              echo "\n" . $value_c['name'] . "\n";
                            }
                            ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </td>
                      <!-- 取引金額 -->
                      <td>
                        <?php
                        echo "\n" . number_format($value['total'] * 1.10) . "円\n";
                        ?>
                      </td>
                      <!-- 備考 -->
                      <td> <?php echo "\n" . $value['note'] . "\n"; ?> </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- footer表示 -->
    <?php $this->load->view('footer_view'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/js/demo.js"></script>
  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>

</body>

</html>

<script type="text/javascript">
  var total_money = document.getElementById("money");
  total = 0;
  $("#data tbody tr").each(function() {
    var txt = $(this).find("td").text();
    info = txt.split("\n");
    data = info[10];
    data = data.replace("円", "");
    data = data.replace(/,/g, '');
    var data = Number(data);
    total = total + data;
  });
  total_money.innerHTML = total.toLocaleString();
  $(function() {
  $("#button").bind("click", function() {
    var total_money = document.getElementById("money");
    total = 0;

    var com, time1, time2;
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

    $("#data tbody tr").each(function() {
      var txt = $(this).find("td").text();
      info = txt.split("\n");
      data = info[4];
      data = data.replace("                  ", "");
      data = data.replace("/", "-");
      data = data.replace("/", "-");
      flag = 1;

      if (words1 != "") { //期間が指定されているとき
        var days1 = new Date(data);
        var days2 = new Date(time1);
        // 経過時間をミリ秒で取得
        var ms = days1.getTime() - days2.getTime();
        // ミリ秒を日付に変換(端数切捨て)
        var days3 = Math.floor(ms / (1000 * 60 * 60 * 24)) + 1;
        var days1 = new Date(time2);
        var days2 = new Date(data);
        // 経過時間をミリ秒で取得
        var ms = days1.getTime() - days2.getTime();
        // ミリ秒を日付に変換(端数切捨て)
        var days4 = Math.floor(ms / (1000 * 60 * 60 * 24));
        if (days3 >= 0 && days4 >= 0) {
          flag = 0;
        }
      } else {
        flag = 0;
      }

      if (flag == 0) {
        if (info[7].match(re) != null) {
          $(this).show();

          data = info[10];
          data = data.replace("円", "");
          data = data.replace(/,/g, '');
          var data = Number(data);
          total = total + data;
        } else {
          flag = 1;
        }
      }
      if (flag == 1) {
        $(this).hide();
      }
      total_money.innerHTML = total.toLocaleString();
    });

  });

  $("#button2").bind("click", function() {
    $("#data tr").show();
    var total_money = document.getElementById("money");
    total = 0;
    $("#data tbody tr").each(function() {
      var txt = $(this).find("td").text();
      info = txt.split("\n");
      data = info[10];
      data = data.replace("円", "");
      data = data.replace(/,/g, '');
      var data = Number(data);
      total = total + data;
    });
    total_money.innerHTML = total.toLocaleString();
  });
  });

  // カレントページ表示
  $(document).ready(function() {
    if (location.pathname != "/") {
      $('.nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
    } else $('.nav li a:eq(0)').addClass('active');
  });
</script>