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
  <div class="content-wrapper">
    
    <form action="" method="post">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>請求書編集</h1>
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
                      <i class="fas fa-globe"></i> 請求先：
                      <select name="customer">
                        <?php if( !empty($customer) ): ?>
                          <?php foreach( $customer as $value_c ): ?>
                            <?php if( $info['customer_id'] == $value_c['id'] ): ?>
                                <option value="<?php echo $value_c['id'] ?>" selected><?php echo $value_c['name']; ?></option>    
                            <?php else: ?>
                                <option value="<?php echo $value_c['id'] ?>"><?php echo $value_c['name']; ?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                      <span>　御中</span>
                      <small class="float-right">
                        請求日：
                        <input name="date" id="inputDate" type="date" value="<?php echo $info['created_at']; ?>"/>
                        <script>
                          var date = new Date();
      
                          var yyyy = date.getFullYear();
                          var mm = ("0"+(date.getMonth()+1)).slice(-2);
                          var dd = ("0"+date.getDate()).slice(-2);
      
                        //   document.getElementById("inputDate").value=yyyy+'-'+mm+'-'+dd;
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
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>詳細</th>
                        <th>価格</th>
                        <th>数量</th>
                        <th>単位</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td><input type="text" name="product_name" value="<?php echo $info['product_name']; ?>"></td>
                        <td><input type="text" name="price" value="<?php echo $info['price']; ?>"></td>
                        <td><input type="text" name="num" value="<?php echo $info['num']; ?>"></td>
                        <td><input type="text" name="unit" value="<?php echo $info['unit']; ?>"></td>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <b>備考欄</b><br>
                <input type="text" name="note" value="" size="40">
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <input type="submit" value="登録">
      <!-- /.content -->
    </form>
  </div>

  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer no-print"> -->
    <!-- <b>備考欄</b><br> -->
    <!-- <text>サンプルサンプルサンプルサンプルサンプル</text> -->
  <!-- </footer> -->
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
