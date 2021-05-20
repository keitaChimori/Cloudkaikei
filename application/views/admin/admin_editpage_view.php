<!-- ********************************** -->
<!-- ***   管理者画面 編集フォーム  *** -->
<!-- ********************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>管理者画面 編集フォーム | CloudKaikei</title>

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
      <h4 class="mt-2">編集フォーム</h4>
    </nav>

    <!-- サイドメニュー表示 -->
    <?php $this->load->view('sidemenu_admin_view'); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <br>
      <!-- Main content -->
      <section class="content">
        <!-- バリデーションエラー表示 -->
        <?php if (!empty(validation_errors())) :  ?>
          <div class="alert alert-warning py-0" role="alert">
            <p><?php echo validation_errors(); ?></p>
          </div>
        <?php endif; ?>
        <!-- 編集フォーム -->
        <form action="/Admin/edit" id="form" method="post">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">

                <div class="card-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputName">ユーザー名</label>
                        <span class="badge bg-danger">必須</span>
                        <input type="text" name="name" id="inputName" class="form-control" value="<?php echo set_value('name', $info['name']); ?>">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputKanaName">ユーザー名(カナ)</label>
                        <input type="text" name="kana" id="inputKanaName" class="form-control" value="<?php echo set_value('kana', $info['kana']); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputMail">メールアドレス</label>
                    <input type="text" name="mail" id="inputMail" class="form-control" value="<?php echo set_value('mail', $info['mail']); ?>">
                  </div>

                  <div class="form-group w-25">
                    <label for="inputPost">郵便番号<small class="ml-2" style="color: red;">半角数字,ハイフンなし</small></label>
                    <input type="text" name="post" id="inputPost" class="form-control" value="<?php echo set_value('post', $info['post']); ?>">
                  </div>

                  <div class="form-group w-25">
                    <label for="inputPref">都道府県</label>
                    <br>
                    <select name="prefecture" id="inputPref" class="form-control custom-select">
                      <?php
                      $prefs = array('選択してください', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県', '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県');
                      for ($i = 0; $i <= 47; $i++) {
                        if ($i == 0) {
                          print('<option value="' . $i . '" disabled>' . $prefs[$i] . '</option>');
                        } elseif ($i == set_value('prefecture', $info['prefecture'])) {
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
                        <label for="inputAddress1">住所1<small class="ml-3">例:松山市湊町４丁目8-15</small></label>
                        <input type="text" name="address1" id="inputAddress1" class="form-control" value="<?php echo set_value('address1', $info['address1']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputAddress2">住所2<small class="ml-3">例:銀天街ビル1F</small></label>
                        <input type="text" name="address2" id="inputAddress2" class="form-control" value="<?php echo set_value('address2', $info['address2']); ?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group w-25">
                    <label for="inputPhone">電話番号<small class="ml-2" style="color: red;">半角数字,ハイフンなし</small></label>
                    <input type="tel" name="tel" id="inputPhone" class="form-control" value="<?php echo set_value('tel', $info['tel']); ?>">
                  </div>

                  <div class="form-group w-25">
                    <label for="inputFax">FAX番号<small class="ml-2" style="color: red;">半角数字,ハイフンなし</small></label>
                    <input type="tel" name="fax" id="inputFax" class="form-control" value="<?php echo set_value('fax', $info['fax']); ?>">
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputBank">振込先金融機関</label>
                        <input type="text" name="bank_name" id="inputBank" class="form-control" value="<?php echo set_value('bank_name', $info['bank_name']); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputBank">振込先口座番号</label>
                        <input type="text" name="bank_account" id="inputBankAccount" class="form-control" value="<?php echo set_value('bank_account', $info['bank_account']); ?>">
                      </div>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div><!-- /.card -->
            </div>
          </div><!-- /.row -->

          <!-- button -->
          <div class="form-group row justify-content-center">
            <!-- <input type="hidden" name="<?= $name; ?>" value="<?= $hash; ?>"> -->
            <input type="hidden" name="user_id" value="<?php echo $info['id']; ?>">
            <input type="submit" value="変更を保存" name="btn" id="btn_submit" class="btn btn-success px-5 mx-5">
            <a href="<?= base_url() ?>Admin/editlist" class="btn btn-secondary">戻る</a>
          </div>
        </form>
      </section>
      <br>
     
    </div><!-- /.content-wrapper -->

    <!-- footer表示 -->
    <?php $this->load->view('footer_view'); ?>

  </div><!-- ./wrapper -->

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
  </script>

  <script type="text/javascript">
    // 2重クリック禁止
    $('#form').on('submit', function() {
      $('#btn_submit').prop('disabled', true);
    });

    // カレントページ
    $(function() {
      $('#nav li a').each(function() {
        var $href = $(this).attr('href');
        if (location.href.match($href)) {
          $(this).addClass('active');
        } else {
          $(this).removeClass('active');
        }
      });
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