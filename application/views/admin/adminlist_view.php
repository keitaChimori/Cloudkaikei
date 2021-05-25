<!-- ********************************** -->
<!-- ***  管理者画面 登録ユーザーリスト *** -->
<!-- ********************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>管理者ページ | CloudKaikei</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/all.min.css" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css" type="text/css" />
  <!-- datatable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
</head>

<body class="hold-transition">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <h4 class="pt-2">管理者画面</h4>
    </nav>

    <!-- サイドメニュー表示 -->
    <?php $this->load->view('sidemenu_admin_view'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pb-3">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid" style="text-align:center;">
          <h1>登録ユーザーリスト</h1>
        </div>

        <!-- メッセージ -->
        <?php if ($this->session->flashdata('message')) : ?>
          <div class="alert alert-success mt-3" style="text-align: center;" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
          </div>
        <?php endif; ?>
      
      </section>
      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <table class="table table-striped projects" id="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>ユーザー名</th>
              <th>メールアドレス</th>
              <th>都道<br>府県</th>
              <th>住所</th>
              <th>電話番号</th>
              <th>詳細表示</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($info)) : ?>
              <?php foreach ($info as $value) : ?>
                <tr>
                  <!-- id -->
                  <td><?php echo $value['id']; ?></td>
                  <!-- 会社名 -->
                  <td><?php echo $value['name']; ?></td>
                  <!-- メール -->
                  <td><?php echo $value['mail']; ?></td>
                  <!-- 都道府県 -->
                  <td>
                    <?php
                      $prefecture_num = $value['prefecture'];
                      $prefectures = array('選択してください', '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '山梨県', '新潟県', '富山県', '石川県', '福井県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県');
                      if($prefecture_num == 0){
                        echo "";
                      }else{
                        echo $prefectures[$prefecture_num];
                      }
                    ?> 
                  </td>
                  <!-- 住所 -->
                  <td><?php echo $value['address1']; ?><?php echo $value['address2']; ?></td>
                  <!-- 電話番号 -->
                  <td><?php echo $value['tel']; ?></td>
                  <!-- 詳細表示 -->
                  <td>
                    <a href="/Admin/show_userdata?id=<?php echo $value['id']; ?>" class="btn btn-info btn-sm">詳細</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </section>
    </div><!-- /.content-wrapper -->
    

    <!-- footer表示 -->
    <footer>
      <?php $this->load->view('footer_view'); ?>
    </footer>
  
  </div><!-- ./wrapper -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/js/demo.js"></script>
  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <script>
    // ページネーション化
    $("#table").DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Japanese.json"
      },
      "lengthMenu": [10, 20, 30, 40, 50],
      "order": [],
    });
  </script>

  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript">
    // カレントページ表示
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
</body>

</html>