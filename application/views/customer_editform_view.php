<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>顧客情報の編集</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
        <h4>顧客情報の編集</h4>
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
        <img src="<?=base_url() ?>assets/img/y0729.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8; background-color: white;">
        <span class="brand-text font-weight-light">Cloudkaikei</span>
      </a>

      <!-- User Account -->
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?=base_url() ?>assets/img/Vote 2020 Stickers - Monster and Sign.png"
              class="img-circle elevation-2" alt="User Image">
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
            <li class="nav-item">
              <a href="/customer" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  顧客リスト
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
        <form action="/customer/edit" method="post" id="form">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">

                <div class="card-body">

                  <?php
                  // if(!empty($_POST['user_id'])){
                  //   $id = $_POST['user_id'];
                  //   $_SESSION['user_id'] = $id;
                  // }else{
                  //   if(!empty($_SESSION['user_id'])){
                  //     $id = $_SESSION['user_id'];
                  //   }
                  // }
                  // if( !empty($info)){
                  //   foreach( $info as $value ){
                  //     if( $value['id'] == $id){
                  //       break;
                  //     }
                  //   }
                  // }
                ?>
                  <!-- バリデーションエラー表示 -->
                  <?php if(!empty(validation_errors())): ?>
                  <div class="alert alert-warning" role="alert">
                    <p><?= validation_errors(); ?></p>
                  </div>
                  <?php endif; ?>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="inputName">お客様名<span class="badge badge-danger">必須</span></label>
                        <input type="text" name="name" id="inputName" class="form-control"
                          value="<?php echo set_value('name',$info['name']); ?>">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="inputKanaName">お客様名(カナ)</label>
                        <input type="text" name="kana" id="inputKanaName" class="form-control"
                          value="<?php echo set_value('kana',$info['kana']); ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="name_title">敬称</label>
                        <select name="name_title" id="name_title" class="form-control custom-select">
                        <?php
                        $name_titles = array ('様','御中');
                        for($i=0; $i<=1; $i++){
                          if($i == set_value('name_title',$info['name_title'])){
                            print('<option value="'.$i.'" selected>'.$name_titles[$i].'</option>');
                          }else{
                            print('<option value="'.$i.'">'.$name_titles[$i].'</option>');
                          }
                        }
                        ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputMail">メールアドレス</label>
                    <input type="email" name="mail" id="inputMail" class="form-control"
                      value="<?php echo set_value('mail',$info['mail']); ?>">
                  </div>

                  <div class="form-group">
                    <label for="inputPost">郵便番号(ハイフンなし)</label>
                    <input type="text" name="post" id="inputPost" class="form-control"
                      value="<?php echo set_value('post',$info['post']); ?>">
                  </div>

                  <div class="form-group">
                    <label for="inputPref">都道府県</label>
                    <select name="prefecture" id="inputPref" class="form-control custom-select">
                      <?php
                    $prefs = array ('選択してください','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','新潟県','富山県','石川県','福井県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
                    for($i=0; $i<=47; $i++){
                      if($i == 0){
                        print('<option value="">'.$prefs[$i].'</option>');  
                      }elseif($i == set_value('prefecture',$info['prefecture'])){
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
                        <label for="inputAddress1">住所1(市町村番地)</label>
                        <input type="text" name="address1" id="inputAddress1" class="form-control"
                          value="<?php echo set_value('address1',$info['address1']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputAddress2">住所2(建物名)</label>
                        <input type="text" name="address2" id="inputAddress2" class="form-control"
                          value="<?php echo set_value('address2',$info['address2']); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPhone">電話番号(ハイフンなし)</label>
                    <input type="tel" name="tel" id="inputPhone" class="form-control"
                      value="<?php echo set_value('tel',$info['tel']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputFax">FAX(ハイフンなし)</label>
                    <input type="text" name="fax" id="inputFax" class="form-control"
                      value="<?php echo set_value('fax',$info['fax']); ?>">
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="customer_group">部門</label>
                        <input type="text" name="customer_group" id="customer_group" class="form-control"
                          value="<?php echo set_value('customer_group',$info['customer_group']); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="position">役職</label>
                        <input type="text" name="position" id="position" class="form-control"
                          value="<?php echo set_value('position',$info['position']); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="person">担当者名</label>
                        <input type="text" name="person" id="person" class="form-control"
                          value="<?php echo set_value('person',$info['person']); ?>">
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
              <a href="<?=base_url() ?>customer" class="btn btn-secondary">戻る</a>
            </div>
            <div class="col-4" style="text-align: center;">
              <input type="hidden" name="<?= $name ?>" value="<?= $hash ?>">
              <input type="submit" name="btn_submit" id="btn_submit" value="変更を保存" class="btn btn-success">
            </div>
            <div class="col-4" style="text-align: right;">
              <!-- <span id="delete"></span> -->
              <!-- <input type="hidden" name="delete" value="<?php //echo $info['delete_flag']; ?>"> -->
              <a href="/customer/delete?id=<?php echo $info['id']; ?>" class="btn btn-danger"
                onclick="return disp()">顧客情報の削除</a>
            </div>
          </div>
          <input type="hidden" name="user_id" value="<?php echo $info['id']; ?>">
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
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  // 削除確認メッセージ
  function disp() {
    // 削除確認メッセージ
    if (window.confirm('本当に削除しますか？')) {
      // var delete = document.getElementById("delete");
      // delete.innerHTML = 0;
      return true;
    } else {
      return false;
    }
  }

  // 二重クリック防止
  $('#form').on('submit',function(){
    $('#btn_submit').prop("disabled",true);
  })

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