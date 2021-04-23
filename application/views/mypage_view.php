<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>マイページ</title>

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
      <h4 class="pt-2">マイページ</h4>
    </nav>

    <!-- サイドメニュー表示 -->
    <?php $this->load->view('sidemenu_view'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <br>
      <!-- Main content -->
      <section class="content">
        <form action="/Mypage/edit" method="post">
          <div class="row">
            <div class="col-md-12">

              <!-- バリデーションエラー表示 -->
              <?php if (!empty(validation_errors())) :  ?>
                <div class="alert alert-warning py-0 mb-2" role="alert">
                  <p><?php echo validation_errors(); ?></p>
                </div>
              <?php endif; ?>

              <!-- メッセージ -->
              <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success mt-3" style="text-align: center;" role="alert">
                  <?php echo $this->session->flashdata('message'); ?>
                </div>
              <?php endif; ?>

              <div class="card card-primary">
                <div class="card-body">

                  <?php
                  // var_dump($info);
                  // exit;
                  ?>
                  <p>ユーザー情報を入力してください</p>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">会社名</label>
                        <span class="badge bg-danger">必須</span>
                        <input name="name" type="text" id="inputName" class="form-control" value="<?php echo set_value('name', $info['name']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputKanaName">会社名(カナ)</label>
                        <input name="kana" type="text" id="inputKanaName" class="form-control" value="<?php echo set_value('kana', $info['kana']); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputMail">メールアドレス</label>
                    <span class="badge bg-danger">必須</span>
                    <input name="mail" type="text" id="inputMail" class="form-control" value="<?php echo set_value('mail', $info['mail']); ?>">
                  </div>

                  <div class="form-group">
                    <label for="inputPost">郵便番号 (半角数字・ハイフンなし)</label>
                    <span class="badge bg-danger">必須</span>
                    <input name="post" type="text" id="inputPost" class="form-control" value="<?php echo set_value('post', $info['post']); ?>">
                  </div>

                  <div class="form-group">
                    <label for="inputPref">都道府県</label>
                    <span class="badge bg-danger">必須</span>
                    <br>
                    <select name="prefecture" id="inputPref" class="form-control custom-select">
                      <?php
                      $prefs = array('選択してください', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県', '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県');
                      print_r($prefs);

                      for ($i = 0; $i <= 47; $i++) {
                        if ($i == 0) {
                          print('<option value="">' . $prefs[$i] . '</option>');
                        } elseif ($i == $info['prefecture']) {
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
                        <label for="inputAddress1">住所1(市町村番地)</label>
                        <span class="badge bg-danger">必須</span>
                        <input name="address1" type="text" id="inputAddress1" class="form-control" value="<?php echo set_value('address1', $info['address1']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputAddress2">住所2(建物名)</label>
                        <input name="address2" type="text" id="inputAddress2" class="form-control" value="<?php echo set_value('address2', $info['address2']); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPhone">電話番号 (半角数字・ハイフンなし)</label>
                    <span class="badge bg-danger">必須</span>
                    <input name="tel" type="tel" id="inputPhone" class="form-control" value="<?php echo set_value('tel', $info['tel']); ?>">
                  </div>
                  <div class="form-group">
                    <label for="inputFax">FAX番号 (半角数字・ハイフンなし)</label>
                    <input name="fax" type="tel" id="inputFax" class="form-control" value="<?php echo set_value('fax', $info['fax']); ?>">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputBank">振込先金融機関</label>
                        <input name="bank_name" type="text" id="inputBank" class="form-control" value="<?php echo set_value('bank_name', $info['bank_name']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputBankAccount">振込先口座 (半角数字)</label>
                        <input name="bank_account" type="text" id="inputBankAccount" class="form-control" value="<?php echo set_value('bank_account', $info['bank_account']); ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>

          <div class="form-group row justify-content-center">
            <div>
              <input type="hidden" name="user_id" value="<?php echo $info['id'] ?>">
              <input type="submit" value="変更を保存" class="btn btn-success mr-4 px-5">
              <a href="<?= base_url() ?>Cloudkaikei/ledger" class="btn btn-secondary">戻る</a>
            </div>
          </div>
        </form>
      </section>
      <!-- /.content -->
      <br>
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