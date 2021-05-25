<!-- ************************************* -->
<!-- *****  パスワード再設定フォーム ***** -->
<!-- ************************************* -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>パスワード再設定  | CloudKaikei</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/all.min.css" type="text/css" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/icheck-bootstrap.min.css" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/adminlte.min.css" type="text/css" />
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>CloudKaikei<br>パスワード再設定</b>
    </div><!-- /.login-logo -->
   
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">新しいパスワードを入力してください</p>
        
        <!-- パスワード再設定フォーム -->
        <form method="POST" id="form">
          <label for="password1" class="form-label">新しいパスワード</label>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password1" id="password1" placeholder="新しいパスワード">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <small class="text-primary">半角数字・半角英字をそれぞれ1文字以上含む</small>
          </div>
          
          <label for="password2" class="form-label">新しいパスワード【確認用】</label>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password2" id="password2" placeholder="新しいパスワード【確認用】">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
             <!-- csrfトークン埋め込み -->
             <input id="token" type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
            <button type="submit" class="btn btn-primary btn-block" id="btn_submit" name="submit">パスワード再設定</button>
          </div>
        </form>

      </div><!-- /.login-card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script>
    // 二重クリック防止
    $('#form').on('submit', function() {
      $('#btn_submit').prop("disabled", true);

        // 2秒後に元に戻す
        setTimeout(function() {
          $('#btn_submit').prop("disabled", false);
        }, 2000);
    });

  $('#form').on('submit', function() {
    event.preventDefault();
    var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
    var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得

    $.ajax({
      url: "/login/password_reissue_done",
      type: "POST",
      data: {
        'password1': $('#password1').val(),
        'password2': $('#password2').val(),
        'email': $('#email').val(),
        "csrf_test_name": csrf_hash,
      },
      dataType: "json",
    }).then(
      function(data) {
        if (data.success == 1) {
          // パスワード再設定成功
          window.location.href = '/login/password_reissue_finish';
        } else {
          // パスワード再設定失敗
          alert(data.message);
        }
      })
  });
  </script>

  <!-- jQuery -->
  <script src="<?=base_url() ?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?=base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=base_url() ?>assets/js/adminlte.min.js"></script>
</body>

</html>