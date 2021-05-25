<!-- ******************************** -->
<!-- ****    ユーザー新規登録   ***** -->
<!-- ******************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>新規登録  |  CloudKaikei</title>

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
      <b>CloudKaikei<br>新規登録</b>
    </div><!-- /.login-logo -->

    <div class="card">
      <div class="card-body login-card-body">

        <!-- エラーメッセージ -->
        <?php if (!empty(validation_errors())) : ?>
          <div class="alert alert-warning" role="alert">
            <div class="error_list">
              <p><?= validation_errors(); ?></p>
            </div>
          </div>
        <?php endif; ?>

        <!-- 登録フォーム -->
        <form method="post" id="form" action="/login/register_done">
          <label for="email" class="form-label">メールアドレス</label>
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="メールアドレス" value="<?php if (!empty($email)) { echo $_SESSION['email'];} ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <label for="password1" class="form-label">パスワード</label>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password1" id="password1" placeholder="パスワード">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <small class="text-primary">半角数字・半角英字をそれぞれ1文字以上含む</small>
          </div>

          <label for="password2" class="form-label">パスワード【確認用】</label>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password2" id="password2" placeholder="パスワード【確認用】">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row mb-4">
            <!-- csrfトークン埋め込み -->
            <input id="token" type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
            <button type="submit" class="btn btn-primary btn-block" name="submit" id="btn_submit" value="submit">新規登録</button>
          </div>
        </form>

        <p class="text-center mb-0">
          <a href="/login" class="text-center">ログインする</a>
        </p>

      </div><!-- /.login-card-body -->
    </div>
  </div><!-- /.login-box -->

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript">

    // 二重クリック防止
    $('#form').on('submit',function(){
      $('#btn_submit').prop("disabled",true);
    });
    
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
</body>

</html>