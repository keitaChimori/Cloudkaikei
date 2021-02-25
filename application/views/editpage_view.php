<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>編集ページ</title>

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
      <h4>編集ページ</h4>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header"> -->
      <!-- <div class="container-fluid" style="text-align:center;"> -->
        <!-- <h1>編集ページ</h1> -->
      <!-- </div> -->
      <!-- /.container-fluid -->
    <!-- </section> -->
    <br>
    <!-- Main content -->
    <section class="content">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">

              <div class="card-body">

                <?php
                  if(!empty($_POST['user_id'])){
                    $id = $_POST['user_id'];
                    $_SESSION['user_id'] = $id;
                  }else{
                    if(!empty($_SESSION['user_id'])){
                      $id = $_SESSION['user_id'];
                    }
                  }
                  if( !empty($info)){
                    foreach( $info as $value ){
                      if( $value['id'] == $id){
                        break;
                      }
                    }
                  }
                ?>

                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="inputName">会社名</label>
                      <input type="text" name="Name" id="inputName" class="form-control"
                      value="<?php echo $value['name']; ?>">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="inputKanaName">会社名(カナ)</label>
                      <input type="text" name="KanaName" id="inputKanaName" class="form-control"
                      value="<?php echo $value['kana']; ?>">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputMail">メールアドレス</label>
                  <input type="text" name="Mail" id="inputMail" class="form-control"
                  value="<?php echo $value['mail']; ?>">
                </div>

                <div class="form-group">
                  <label for="inputPost">郵便番号</label>
                  <input type="text" name="Post" id="inputPost" class="form-control"
                  value="<?php echo $value['post']; ?>">
                </div>
                
                <div class="form-group">
                  <label for="inputPref">都道府県</label>
                  <br>
                  <select name="Pref" id="inputPref" class="form-control custom-select">
                  <?php
                    $prefs = array ('選択してください','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','新潟県','富山県','石川県','福井県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
                    for($i=0; $i<=47; $i++){
                      if($i == 0){
                        print('<option value="'.$i.'" disabled>'.$prefs[$i].'</option>');  
                      }elseif($i == $value['prefecture']){
                        print('<option value="'.$i.'" selected>'.$prefs[$i].'</option>');
                      }else{
                        print('<option value="'.$i.'">'.$prefs[$i].'</option>');
                      }
                    }
                  ?>
                  </select>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputAddress1">住所1</label>
                      <input type="text" name="Address1" id="inputAddress1" class="form-control"
                      value="<?php echo $value['adress1']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputAddress2">住所2</label>
                      <input type="text" name="Address2" id="inputAddress2" class="form-control"
                      value="<?php echo $value['address2']; ?>">
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputPhone">電話番号</label>
                  <input type="tel" name="Phone" id="inputPhone" class="form-control"
                  value="<?php echo $value['tel']; ?>">
                </div>
                <div class="form-group">
                  <label for="inputFax">FAX</label>
                  <input type="tel" name="Fax" id="inputFax" class="form-control"
                  value="<?php echo $value['fax']; ?>">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputBank">振込先金融機関</label>
                      <input type="text" name="Bank" id="inputBank" class="form-control"
                      value="<?php echo $value['bank_name']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputBank">振込先口座</label>
                      <input type="text" name="BankAccount" id="inputBankAccount" class="form-control"
                      value="<?php echo $value['bank_account']; ?>">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          
        </div>
        <div class="row">
          <div class="col-4">
            <a href="<?=base_url() ?>Cloudkaikei/admin" class="btn btn-secondary">戻る</a>
          </div>
          <div class="col-4" style="text-align: center;">
            <input type="submit" value="変更を保存" class="btn btn-success">
          </div>
          <div class="col-4" style="text-align: right;">
            <!-- <span id="delete"></span> -->
            <!-- <input type="hidden" name="delete" value="<?php //echo $value['delete_flag']; ?>"> -->
            <a href="#" class="btn btn-danger" onclick="disp()">アカウントの削除</a>
          </div>
        </div>
        <input type="hidden" name="user_id" value="<?php echo $value['id']; ?>">
      </form>
    </section>
    <br>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0-rc
    </div>
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  
  function disp(){
    if(window.confirm('本当によろしいですか？')){
      // var delete = document.getElementById("delete");
      // delete.innerHTML = 0;

      window.alert('削除が完了しました');
    }
    else{
      window.alert('キャンセルされました');
    }
  }
</script>
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
