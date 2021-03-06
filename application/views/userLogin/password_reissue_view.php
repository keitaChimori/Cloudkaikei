<!-- **************************************** -->
<!-- ****    パスワード再発行フォーム   ***** -->
<!-- **************************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>パスワード再発行  | CloudKaikei</title>

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
      <b>CloudKaikei<br>パスワード再発行</b><i class="fa fa-circle-o-notch"></i>
    </div><!-- /.login-logo -->

    <div class="card">
      <div class="card-body login-card-body">
        <p class="mx-2">登録したメールアドレスをフォームに入力してください。パスワード再発行用のメールを送信します。</p>

        <!-- パスワード再発行フォーム -->
        <form method="POST" id="form">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="メールアドレス">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- csrfトークン埋め込み -->
            <input id="token" type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>">
            <button type="submit" class="btn btn-primary btn-block mb-3" id="btn_submit" name="submit">パスワード再発行メール送信</button>
            <div class="loading m-auto small pb-2">
              <i class="fas fa-spinner fa-pulse fa-3x fa-fw" style="display: none;"></i>
            </div>
          </div>
      
        </form>

        <p class="mb-0 text-center">
          <a href="/login/register" class="text-center">ユーザー登録する</a><br>
        </p>

      </div><!-- /.login-card-body -->
    </div><!-- /.card -->
  </div><!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <script>
    // ローディング
    $(function() {
      $('.btn').on('click', function() {
        $('.btn').hide();
        $('.fa-spinner').show();

        // 3秒後に元に戻す
        setTimeout(function() {
          $('.btn').show();
          $('.fa-spinner').hide();
        }, 3000);
      });
    });

    // Ajax
    $('#form').on('submit', function() {
      event.preventDefault();
      var csrf_name = $("#token").attr('name'); // viewに生成されたトークンのname取得
      var csrf_hash = $("#token").val(); // viewに生成されたトークンのハッシュ取得

      $.ajax({
        url: "/login/reissue_sendmail",
        type: "POST",
        data: {
          'email': $('#email').val(),
          "csrf_test_name": csrf_hash,
        },
        dataType: "json",
      }).then(
        function(data) {
          if (data.success_message == 'メール送信が完了しました') {
            // ログイン成功
            alert(data.success_message);
            window.location.href = '/login';
          } else {
            alert(data.message);
            
          }
        })
    });
  </script>
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
</body>

</html>