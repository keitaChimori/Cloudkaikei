<!-- ******************************** -->
<!-- ****   顧客リスト新規登録   **** -->
<!-- ******************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>顧客情報の新規登録 | Cloudkaikei</title>

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
        <h4>顧客情報の新規登録</h4>
      </ul>
    </nav>

    <!-- サイドメニュー表示 -->
    <?php $this->load->view('sidemenu_view'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <br>
      <!-- Main content -->
      <section class="content">
        <form action="/customer/customer_register_done" method="post" id="form">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">

                <div class="card-body">

                  <!-- バリデーションエラー表示 -->
                  <?php if (!empty(validation_errors())) : ?>
                    <div class="alert alert-warning p-0" style="text-align: center;" role="alert">
                      <p><?= validation_errors(); ?></p>
                    </div>
                  <?php endif; ?>
                  <!-- フォーム -->
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="name">お客様名<span class="badge badge-danger">必須</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="例）サンプル株式会社" value="<?php echo set_value('name'); ?>">
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="kana">お客様名 <small class="text-danger">(カナ)</small></label>
                        <input type="text" name="kana" id="kana" class="form-control" placeholder="例）サンプルカブシキカイシャ" value="<?php echo set_value('kana'); ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="name_title">敬称</label>
                        <select name="name_title" id="name_title" class="form-control custom-select">
                          <?php
                          $name_titles = array('様', '御中');
                          for ($i = 0; $i <= 1; $i++) {
                            if ($i == set_value('name_title')) {
                              print('<option value="' . $i . '" selected>' . $name_titles[$i] . '</option>');
                            } else {
                              print('<option value="' . $i . '">' . $name_titles[$i] . '</option>');
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="mail">メールアドレス</label>
                    <input type="email" name="mail" id="mail" class="form-control" placeholder="例）sample.email@sample.jp" value="<?php echo set_value('mail'); ?>">
                  </div>

                  <div class="form-group w-25">
                    <label for="post">郵便番号 <small class="text-danger">(半角数字・ハイフンなし)</small></label>
                    <input type="text" name="post" id="post" class="form-control" placeholder="例）1234567" value="<?php echo set_value('post'); ?>">
                  </div>

                  <div class="form-group w-25">
                    <label for="prefecture">都道府県</label>
                    <br>
                    <select name="prefecture" id="prefecture" class="form-control custom-select">
                      <?php
                      $prefs = array('選択してください', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県', '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県');
                      for ($i = 0; $i <= 47; $i++) {
                        if ($i == 0) {
                          print('<option value="">' . $prefs[$i] . '</option>');
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
                        <label for="address1">住所1 <small class="text-danger">(市区町村番地)</small></label>
                        <input type="text" name="address1" id="address1" class="form-control" placeholder="例）○○市□□□町1丁目1-11" value="<?php echo set_value('address1'); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address2">住所2 <small class="text-danger">(建物名)</small></label>
                        <input type="text" name="address2" id="address2" class="form-control" placeholder="例）△△△ビル1F" value="<?php echo set_value('address2'); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group w-25">
                    <label for="tel">電話番号 <small class="text-danger">(半角数字・ハイフンなし)</small></label>
                    <input type="tel" name="tel" id="tel" class="form-control" placeholder="例）01234567890" value="<?php echo set_value('tel'); ?>">
                  </div>
                  <div class="form-group w-25">
                    <label for="fax">FAX番号 <small class="text-danger">(半角数字・ハイフンなし)</small></label>
                    <input type="tel" name="fax" id="fax" class="form-control" placeholder="例）09876543211" value="<?php echo set_value('fax'); ?>">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="customer_groupe">部門</label>
                        <input type="text" name="customer_groupe" id="customer_groupe" class="form-control" placeholder="例）営業部" value="<?php echo set_value('customer_groupe'); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="position">役職</label>
                        <input type="text" name="position" id="position" class="form-control" placeholder="例）部長" value="<?php echo set_value('position'); ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="person">担当者名</label>
                        <input type="text" name="person" id="person" class="form-control" placeholder="例） 田中 太郎" value="<?php echo set_value('person'); ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <!-- botton -->
          <div class="form-group row justify-content-center">
              <input type="hidden" name="<?= $name; ?>" value="<?= $hash; ?>">
              <input type="submit" name="btn_submit" id="btn_submit" value="新規登録" class="btn btn-success px-5 mr-3">
              <a href="<?= base_url() ?>customer" class="btn btn-secondary">戻る</a>
          </div>
        
        </form>
      </section>
      <br>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    // 二重クリック禁止
    $('#form').on('submit', function() {
      $('#btn_submit').prop("disabled", true);
    });

    // カレントページ表示
    $(document).ready(function() {
      if (location.pathname != "/") {
        $('.nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
      } else $('.nav li a:eq(0)').addClass('active');
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