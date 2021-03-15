<!-- ******************************** -->
<!-- **  パスワード再設定フォーム *** -->
<!-- ******************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>パスワード再設定</title>

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
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">新しいパスワードを入力してください</p>

        <form method="POST" id="form">
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password1" id="password1" placeholder="パスワード">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password2" id="password2" placeholder="パスワード【確認用】">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <button type="submit" class="btn btn-primary btn-block" name="submit">パスワード再設定</button>
          </div>
        </form>

        <!-- <p class="mb-0">
        <a href="/login/register" class="text-center">ユーザー登録する</a><br>
        <a href="/login/password_reissue" class="text-center">パスワードを忘れた方はこちら</a>
      </p> -->

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script>
  $('#form').on('submit', function() {
    event.preventDefault();
    $.ajax({
      url: "/login/password_reissue_done",
      type: "POST",
      data: {
        'password1': $('#password1').val(),
        'password2': $('#password2').val(),
      },
      dataType: "json",
    }).then(
      function(data) {
        if (data.success == 1) {
          // ログイン成功
          window.location.href = '/';
        } else {
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