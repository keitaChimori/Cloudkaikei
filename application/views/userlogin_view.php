<!-- ******************************** -->
<!-- ****    ユーザーログイン   ***** -->
<!-- ******************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ユーザーログイン</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/all.min.css" type="text/css" />
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/icheck-bootstrap.min.css" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css" type="text/css" />
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>CloudKaikei<br>ユーザーログイン</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <!-- 登録完了メッセージ -->
        <?php if ($this->session->flashdata('message')) : ?>
          <div class="alert alert-success text-center" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        <?php endif; ?>
        <p class="login-box-msg">ログインしてください。</p>

        <form method="POST" id="form">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="Email" id="Email" placeholder="メールアドレス">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="パスワード">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <button type="submit" class="btn btn-primary btn-block mb-4" id="btn_submit" name="submit">ログイン</button>
          </div>
        </form>

        <p class="mb-0 text-center">
          <a href="/login/register" class="">ユーザー登録する</a><br>
          <a href="/login/password_reissue" class="">パスワードを忘れた方はこちら</a>
        </p>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script>
    // 二重クリック防止
    $('#form').on('submit', function() {
      $('#btn_submit').prop("disabled", true);

      // 1秒後に元に戻す
      setTimeout(function() {
        $('#btn_submit').prop("disabled", false);
      }, 1000);
    });

    //Ajax 
    $('#form').on('submit', function() {
      event.preventDefault();
      $.ajax({
        url: "/login/login_check",
        type: "POST",
        data: {
          'Email': $('#Email').val(),
          'password': $('#password').val(),
        },
        dataType: "json",
      }).then(
        function(data) {
          if (data.success == 1) {
            // ログイン成功
            window.location.href = '/Cloudkaikei/ledger';
          } else {
            alert(data.message);

          }
        })
    });
  </script>

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
</body>

</html>