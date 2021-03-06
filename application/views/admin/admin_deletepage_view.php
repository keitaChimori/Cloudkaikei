<!-- ********************************** -->
<!-- ***   管理者画面 削除フォーム  *** -->
<!-- ********************************** -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>管理者画面  削除フォーム | CloudKaikei</title>

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
    <h4 class="mt-2">削除フォーム</h4>
  </nav>

  <!-- サイドメニュー表示 -->
  <?php $this->load->view('sidemenu_admin_view'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <br>
    <!-- Main content -->
    <section class="content">

        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputName">ユーザー名</label>
                      <span class="badge bg-danger">必須</span>
                      <input type="text" name="Name" id="inputName" class="form-control"
                      value="<?php echo $info['name']; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputKanaName">ユーザー名(カナ)</label>
                      <input type="text" name="KanaName" id="inputKanaName" class="form-control"
                      value="<?php echo $info['kana']; ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputMail">メールアドレス</label>
                  <input type="text" name="Mail" id="inputMail" class="form-control"
                  value="<?php echo $info['mail']; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="inputPost">郵便番号</label>
                  <input type="text" name="Post" id="inputPost" class="form-control"
                  value="<?php echo $info['post']; ?>" readonly>
                </div>
                
                <div class="form-group">
                  <label for="inputPref">都道府県</label>
                  <br>
                  <select name="Pref" id="inputPref" class="form-control" disabled>
                  <?php
                    $prefs = array ('選択してください','北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','山梨県','新潟県','富山県','石川県','福井県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
                    for($i=0; $i<=47; $i++){
                      if($i == 0){
                        print('<option value="'.$i.'" disabled>'.$prefs[$i].'</option>');  
                      }elseif($i == $info['prefecture']){
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
                      value="<?php echo $info['address1']; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputAddress2">住所2</label>
                      <input type="text" name="Address2" id="inputAddress2" class="form-control"
                      value="<?php echo $info['address2']; ?>" readonly>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputPhone">電話番号</label>
                  <input type="tel" name="Phone" id="inputPhone" class="form-control"
                  value="<?php echo $info['tel']; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="inputFax">FAX</label>
                  <input type="tel" name="Fax" id="inputFax" class="form-control"
                  value="<?php echo $info['fax']; ?>" readonly>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputBank">振込先金融機関</label>
                      <input type="text" name="Bank" id="inputBank" class="form-control"
                      value="<?php echo $info['bank_name']; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputBank">振込先口座</label>
                      <input type="text" name="BankAccount" id="inputBankAccount" class="form-control"
                      value="<?php echo $info['bank_account']; ?>" readonly>
                    </div>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div>
        </div><!-- /.row -->
        
        <div class="row mt-3">
          <div class="col-4">
            <a href="<?=base_url() ?>Admin/deletelist" class="btn btn-secondary">戻る</a>
          </div>
          <div class="col-4" style="text-align: center;">
            <a href="/Admin/delete?id=<?php echo $info['id']; ?>" class="btn btn-danger" id="btn_submit" onclick=" return disp()">登録情報を削除する</a>
          </div>
        </div>
      
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

<script type="text/javascript">
  // 削除メッセージ
  function disp(){
    if(window.confirm('本当に削除しますか？')){
      return true;
    }else{
      return false;
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
