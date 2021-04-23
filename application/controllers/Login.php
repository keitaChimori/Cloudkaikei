<?php

class Login extends CI_controller
{
  // デフォルトの設定
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper(array('form', 'url'));
    $this->load->helper('file');
    $this->load->model('Cloudkaikei_model');
    $this->load->model('Login_model');
    $this->load->library('javascript');
    $this->load->library('form_validation');
    // $this->load->library('jquery');
  }

  // ユーザーログイン画面表示
  public function index()
  {
    $this->load->view('userlogin_view');
  }

  // ログインチェック
  public function login_check()
  {
    header("Content-Type: application/json; charset=utf-8");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $this->input->post('Email', true);
      if (empty($email)) {
        // ログイン失敗
        echo json_encode(['message' => 'メールアドレスを入力してください']);
        exit();
      }
      $password = $this->input->post('password', true);
      if (empty($password)) {
        // ログイン失敗
        echo json_encode(["message" => "パスワードを入力してください"]);
        exit();
      }

      // user_dataテーブルからpassword,delete_flag,id,nameを取得
      $user_password = $this->Login_model->fetch_pass($email);
      $user_deleteflag = $this->Login_model->fetch_delete($email);
      $user_id = $this->Login_model->fetch_id($email);

      // delete_flagチェック
      if (!empty($user_delete_flag) && $user_deleteflag['delete_flag'] == 1) {
        // ログイン失敗
        echo json_encode(['message' => 'メールアドレスまたはパスワードが違います']);
        exit();
      }

      // パスワードチェック
      if (!empty($user_password) && password_verify($password, $user_password['password'])) {
        // セッション発行
        $data = [ 'id' => $user_id ];
        $this->session->set_userdata($data);
        // ログイン成功
        echo json_encode(['success' => 1]);
        exit();
      } else {
        // ログイン失敗
        echo json_encode(['message' => 'メールアドレスまたはパスワードが違います']);
        exit();
      }
    } else {
      // POST以外のとき
      echo json_encode(['message' => '許可されていないメソッドです']);
    }
    exit();
  }

  // パスワード再発行画面表示
  public function password_reissue()
  {
    $this->load->view('password_reissue_view');
  }

  // パスワード忘れフォーム
  public function reissue_sendmail()
  {
    header("Content-Type: application/json; charset=utf-8");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $this->input->post('Email'); //受け取り
      $user_email = $this->Login_model->fetch_mail($email); //DB照合

      //メールアドレス照合不一致
      if (empty($email) || empty($user_email)) {
        // 失敗
        echo json_encode(['message' => '登録したメールアドレスを入力してください']);
        exit();
      }
      // メールアドレス暗号化
      $key = 'g--YESw-F3LyGXDgGh*QqEt|7.kY8&4L'; // 鍵
      $code = bin2hex(openssl_encrypt($email, 'AES-128-ECB', $key));

      // メール送信
      try {
        $this->load->library('phpmailer_lib');

        $mail = $this->phpmailer_lib->load();

        // 文字エンコードを指定
        $mail->CharSet = 'utf-8';
        $mail->isSMTP();    // SMTPの使用宣言
        $mail->Host     = 'smtp.gmail.com';   // SMTPサーバーを指定
        $mail->SMTPAuth = true;   // SMTP authenticationを有効化
        $mail->Username = 'sendmailtest.programming@gmail.com';  // SMTPサーバーのユーザ名
        $mail->Password = 'oebpilyelgdboidg';   // SMTPサーバーのパスワード
        $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
        $mail->Port     = 587;  // TCPポートを指定（tlsの場合は465や587）

        // 送受信先設定（第二引数は省略可）
        $mail->setFrom('sendmailtest.programming@gmail.com', 'クラウド会計');   // 送信者
        // $mail->addReplyTo('info@example.com', 'CodexWorld');    // 返信先

        $mail->addAddress($email);    // 宛先

        $mail->isHTML(true);
        // 送信内容設定
        $passReissueToken = md5(uniqid(rand(), true));
        $mail->Subject = 'クラウド会計サービス【パスワード再設定】';
        $mailContent = "<h1>クラウド会計サービス【パスワード再設定】</h1>
            <p>下記URLから新しいパスワードの再設定を完了させてください。</p><br>
            <a href='http://cloudkaikei.work/login/password_reissue_form?passReset=$code'>http://cloudkaikei.work/login/password_reissue_form?passReset=$code</a>";
        $mail->Body = $mailContent;

        // 送信
        if ($mail->send()) {
          // echo json_encode(['success' => 1]);
          echo json_encode(['success_message' => 'メール送信が完了しました']);
          exit();
        }
      } catch (Throwable $e) {
        // エラーの場合
        echo '送信失敗: ', $mail->ErrorInfo;
      }
      exit();
    }
  }

  // パスワード再設定フォーム表示
  public function password_reissue_form()
  {
    $code = $this->input->get('passReset');
    if (empty($code)) {
      $this->load->view('error_view');
    } else {
      // メールアドレス復号
      $key = 'g--YESw-F3LyGXDgGh*QqEt|7.kY8&4L'; // 鍵
      $email = openssl_decrypt(hex2bin($code), 'AES-128-ECB', $key);
      $data['email'] = $email;
      $this->load->view('password_reissue_form_view', $data);
    }
  }

  // パスワード再設定実行
  public function password_reissue_done()
  {
    header("Content-Type: application/json; charset=utf-8");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $this->input->post('email', true);
      $password1 = $this->input->post('password1', true);
      if (empty($password1)) {
        // ログイン失敗
        echo json_encode(['message' => 'パスワードを入力してください']);
        exit();
      }
      $password2 = $this->input->post('password2', true);
      if (empty($password2)) {
        // ログイン失敗
        echo json_encode(["message" => "パスワード【確認用】を入力してください"]);
        exit();
      }
      $this->form_validation->set_rules(
        'password1',
        'パスワード',
        'required|regex_match[/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,20}$/i]|trim|matches[password2]',
        array(
          'required' => "%sが未入力です。",
          'regex_match' => "%sは5文字以上20文字以下の半角数字、半角英字を含む値を入力してください。",
          'matches' => "%sとパスワード【確認用】が一致しません。"
        )
      );
      $this->form_validation->set_rules(
        'password2',
        'パスワード【確認用】',
        'required',
        array(
          'required' => "%sが未入力です。",
        )
      );

      if ($this->form_validation->run() == false) {
        // 失敗
        $error_message = str_replace("<p>", "", validation_errors());
        $error_message = str_replace("</p>", "", $error_message);
        echo json_encode(['message' => $error_message]);
        exit();
      } else {
        // 成功
        $hash_password = password_hash($password1, PASSWORD_DEFAULT); // passwordハッシュ化
        $data = null;
        $data = [
          'mail' => $email,
          'password' => $hash_password,
        ];

        // DBへ登録
        if ($this->Login_model->password_reissue($email, $data)) {
          echo json_encode(['success' => 1]);
          // パスワード再設定完了メール送信
          try {
            $this->load->library('phpmailer_lib');

            $mail = $this->phpmailer_lib->load();

            // 文字エンコードを指定
            $mail->CharSet = 'utf-8';
            $mail->isSMTP();    // SMTPの使用宣言
            $mail->Host     = 'smtp.gmail.com';   // SMTPサーバーを指定
            $mail->SMTPAuth = true;   // SMTP authenticationを有効化
            $mail->Username = 'sendmailtest.programming@gmail.com';  // SMTPサーバーのユーザ名
            $mail->Password = 'oebpilyelgdboidg';   // SMTPサーバーのパスワード
            $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
            $mail->Port     = 587;  // TCPポートを指定（tlsの場合は465や587）

            // 送受信先設定（第二引数は省略可）
            $mail->setFrom('sendmailtest.programming@gmail.com', 'クラウド会計');   // 送信者
            // $mail->addReplyTo('info@example.com', 'CodexWorld');    // 返信先

            $mail->addAddress($email);    // 宛先

            $mail->isHTML(true);
            // 送信内容設定
            $passReissueToken = md5(uniqid(rand(), true));
            $mail->Subject = 'クラウド会計サービス【パスワード再設定完了】';
            $mailContent = "<h1>クラウド会計サービス【パスワード再設定完了】</h1>
                <p>パスワードの再設定が完了しました。</p>";
            $mail->Body = $mailContent;
            $mail->send();
          } catch (Throwable $e) {
            // 送信エラーの場合
            echo '送信失敗: ', $mail->ErrorInfo;
          }
          exit();
        } else {
          echo json_encode(['messege' => 'error']);
          exit();
        }
      }
    } else {
      // POST以外のとき
      echo json_encode(['message' => '許可されていないメソッドです']);
    }
    exit();
  }

  // パスワード再設定完了
  public function password_reissue_finish()
  {
    $this->load->view('password_reissue_finish_view');
  }

  // 新規登録画面表示
  public function register()
  {
    $this->load->view('userregister_view');
  }

  // 新規登録実行
  public function register_done()
  {
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
      // 値の受け取り
      $email = $this->input->post('Email', true);
      $password  = $this->input->post('password1', true);
      // バリデーション設定
      $this->form_validation->set_rules(
        'Email',
        'メールアドレス',
        'required|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]|trim|is_unique[user_data.mail]',
        array(
          'required' => "%sが未入力です。",
          'regex_match' => "%sは正しい形式で入力してください。",
          'is_unique' => "入力した%sは既に登録されています。"
        )
      );
      $this->form_validation->set_rules(
        'password1',
        'パスワード',
        'required|regex_match[/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,20}$/i]|trim|matches[password2]',
        array(
          'required' => "%sが未入力です。",
          'regex_match' => "%sは5文字以上20文字以下の半角数字、半角英字を含む値を入力してください。",
          'matches' => "%sとパスワード【確認用】が一致しません。"
        )
      );
      $this->form_validation->set_rules(
        'password2',
        'パスワード【確認用】',
        'required',
        array(
          'required' => "%sが未入力です。",
        )
      );
      //セッション
      $data = [];
      if ($email) {
        $data['email'] = $email;
        $_SESSION['email'] = $email;
      }

      if ($this->form_validation->run() == false) {
        // 失敗
        $this->load->view('userregister_view', $data);
      } else {
        // 成功
        $hash_password = password_hash($password, PASSWORD_DEFAULT); // passwordハッシュ化
        $data = null;
        $data = [
          'mail' => $email,
          'password' => $hash_password,
        ];
        // DBへ登録
        if ($this->Login_model->insert($data)) {
          // 新規登録完了メール送信
          try {
            $this->load->library('phpmailer_lib');

            $mail = $this->phpmailer_lib->load();

            // 文字エンコードを指定
            $mail->CharSet = 'utf-8';
            $mail->isSMTP();    // SMTPの使用宣言
            $mail->Host     = 'smtp.gmail.com';   // SMTPサーバーを指定
            $mail->SMTPAuth = true;   // SMTP authenticationを有効化
            $mail->Username = 'sendmailtest.programming@gmail.com';  // SMTPサーバーのユーザ名
            $mail->Password = 'oebpilyelgdboidg';   // SMTPサーバーのパスワード
            $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
            $mail->Port     = 587;  // TCPポートを指定（tlsの場合は465や587）

            // 送受信先設定（第二引数は省略可）
            $mail->setFrom('sendmailtest.programming@gmail.com', 'クラウド会計');   // 送信者
            // $mail->addReplyTo('info@example.com', 'CodexWorld');    // 返信先

            $mail->addAddress($email);    // 宛先

            $mail->isHTML(true);
            // 送信内容設定
            $passReissueToken = md5(uniqid(rand(), true));
            $mail->Subject = 'クラウド会計サービス【新規登録完了】';
            $mailContent = "<h1>クラウド会計サービス【新規登録完了】</h1>
                <p>ご登録ありがとうございます。新規登録が完了しました。<br>
                下記URLのログインページからログインを行ってください。<br>
                <a href='http://cloudkaikei.work/login'>http://cloudkaikei.work/login</a></p>";
            $mail->Body = $mailContent;
            $mail->send();
          } catch (Throwable $e) {
            // 送信エラーの場合
            echo '送信失敗: ', $mail->ErrorInfo;
          }

          $this->session->set_flashdata("message", "新規登録が完了しました");
          header('location:/login');
          exit();
        }
      }
    }
  }

  // エラー画面
  // public function error()
  // {
  //   $this->load->view('');
  // }

  // ユーザーページログアウト
  public function user_logout()
  {
    // $this->session->unset_userdata('id');
    $this->session->sess_destroy();
    header('location:/login');
    exit();
  }
}
