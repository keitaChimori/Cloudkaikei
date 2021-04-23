<!-- ************************************** -->
<!-- ***   管理者画面 新規登録フォーム  *** -->
<!-- ************************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>管理者画面 新規登録フォーム</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/all.min.css" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css" type="text/css" />

  <style>
    .current{
      background: rgba(255, 255, 255,.2);
      color: #fff;
    }
  </style>
</head>

<body class="hold-transition">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <h4>管理者画面</h4>
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
        <img src="<?= base_url() ?>assets/img/y0729.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
        <span class="brand-text font-weight-light">Cloudkaikei</span>
      </a>

      <!-- User Account -->
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>assets/img/Vote 2020 Stickers - Monster and Sign.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">管理者</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" id="nav" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="/Admin/user_list" class="nav-link">
                <i class="nav-icon fas fa-list-ol"></i>
                <p>
                  ユーザーリスト
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/Admin/registerform" class="nav-link active">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  新規登録
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/Admin/editlist" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  編集
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/Admin/deletelist" class="nav-link">
                <i class="nav-icon fas fa-trash-alt"></i>
                <p>
                  削除
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/adminlogin/admin_logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  ログアウト
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
      <br>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid" style="text-align:center;">
          <h2>新規登録</h2>
        </div>

        <!-- バリデーションエラー表示 -->
        <?php if (!empty(validation_errors())) :  ?>
          <div class="alert alert-warning py-0" style="text-align: center;" role="alert">
            <p><?php echo validation_errors(); ?></p>
          </div>
        <?php endif; ?>
        <!-- 新規登録フォーム -->
        <form action="/Admin/register" id="form" method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">

                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">会社名</label>
                        <span class="badge bg-danger">必須</span>
                        <input type="text" name="name" id="inputName" class="form-control" value="<?php echo set_value('name'); ?>">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputKanaName">会社名(カナ)</label>
                        <input type="text" name="kana" id="inputKanaName" class="form-control" value="<?php echo set_value('kana'); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputMail">メールアドレス</label>
                    <input type="text" name="mail" id="inputMail" class="form-control" value="<?php echo set_value('mail'); ?>">
                  </div>

                  <div class="form-group">
                    <label for="inputPost">郵便番号<small class="ml-2" style="color: red;">半角数字,ハイフンなし</small></label>
                    <input type="text" name="post" id="inputPost" class="form-control" value="<?php echo set_value('post'); ?>">
                  </div>

                  <div class="form-group">
                    <label for="inputPref">都道府県</label>
                    <br>
                    <select name="prefecture" id="inputPref" class="form-control custom-select">
                      <?php
                      $prefs = array('選択してください', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県', '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県');
                      for ($i = 0; $i <= 47; $i++) {
                        if ($i == 0) {
                          print('<option value="' . $i . '">' . $prefs[$i] . '</option>');
                        } elseif ($i == set_value('prefecture')) {
                          print('<option value="' . $i . '" selected>' . $prefs[$i] . '</option>');
                        } else {
                          print('<option value="' . $i . '">' . $prefs[$i] . '</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputAddress1">住所1<small class="ml-3">例:松山市湊町</small></label>
                        <input type="text" name="address1" id="inputAddress1" class="form-control" value="<?php echo set_value('address1'); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputAddress2">住所2<small class="ml-3">例:４丁目8-15 銀天街ビル1F</small></label>
                        <input type="text" name="address2" id="inputAddress2" class="form-control" value="<?php echo set_value('address2'); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPhone">電話番号<small class="ml-2" style="color: red;">半角数字,ハイフンなし</small></label>
                    <input type="tel" name="tel" id="inputPhone" class="form-control" value="<?php echo set_value('tel'); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputFax">FAX番号<small class="ml-2" style="color: red;">半角数字,ハイフンなし</small></label>
                    <input type="tel" name="fax" id="inputFax" class="form-control" value="<?php echo set_value('fax'); ?>">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputBank">振込先金融機関</label>
                        <input type="text" name="bank_name" id="inputBank" class="form-control" value="<?php echo set_value('bank_name'); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputBank">振込先口座番号</label>
                        <input type="text" name="bank_account" id="inputBankAccount" class="form-control" value="<?php echo set_value('bank_account'); ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

          </div>
          <div class="row mt-3">
            <div class="col-4">
              <a href="<?= base_url() ?>Admin/user_list" class="btn btn-secondary">戻る</a>
            </div>
            <div class="col-4" style="text-align: center;">
              <input type="hidden" name="<?= $name; ?>" value="<?= $hash; ?>">
              <input type="submit" value="新規登録" name="btn" id="btn_submit" class="btn btn-success px-3">
            </div>
          </div>
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

  </div>
  <!-- ./wrapper -->

  <!-- current -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script class="text/javascript">

    // 2重クリック禁止
    $('#form').on('submit',function(){
      $('#btn_submit').prop('disabled',true);
    });
    
  </script>
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