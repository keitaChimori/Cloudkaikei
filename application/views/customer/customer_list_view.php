<!-- ******************************** -->
<!-- ****    顧客リストの表示    **** -->
<!-- ******************************** -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/all.min.css" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css" type="text/css" />
  <!-- datatable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
  <title>顧客リスト | CloudKaikei</title>
</head>

<body class="hold-transition">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <h4>顧客リスト</h4>
    </nav>

    <!-- サイドメニュー表示 -->
    <?php $this->load->view('sidemenu_view'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid" style="text-align:center;">
          <div>
            <a href="/customer/customer_register" class="btn btn-success w-25">新規登録</a>
          </div>
          <br>
          <!-- メッセージ -->
          <?php if ($this->session->flashdata('message')) : ?>
            <div class="alert alert-success" role="alert">
              <?php echo $this->session->flashdata('message'); ?>
            </div>
          <?php endif; ?>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <table class="table table-striped projects" id="table">
          <thead>
            <tr class="text-center">
              <!-- <th>ID</th> -->
              <th>会社名</th>
              <th>メールアドレス</th>
              <th>電話番号</th>
              <th>FAX</th>
              <th>詳細・編集</th>
              <th>削除</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($info)) : ?>
              <?php foreach ($info as $value) : ?>
                <tr>
                  <!-- id -->
                  <!-- <td><?php echo $value['id']; ?></td> -->
                  <!-- 会社名 -->
                  <td class="pl-3"><?php echo $value['name']; ?></td>
                  <!-- メール -->
                  <td><?php echo $value['mail']; ?></td>
                  <!-- 電話番号 -->
                  <td><?php echo $value['tel']; ?></td>
                  <!-- FAX -->
                  <td><?php echo $value['fax']; ?></td>
                  <!-- 編集 -->
                  <td class="text-center">
                    <a class="btn btn-info btn-sm" href="<?= base_url()  ?>customer/editform?id=<?= $value["id"]; ?>">詳細・編集</a>
                  </td>
                  <td class="text-center">
                    <a class="btn btn-danger btn-sm delete-btn" href="/customer/delete?id=<?php echo $value['id']; ?>" onclick="return disp()">削除</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>

        <!-- ページネーション -->
        <!-- <div id="pagination">
          <?php echo $page_link; ?>
        </div> -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- footer表示 -->
    <footer>
      <?php $this->load->view('footer_view'); ?>
    </footer>

  </div><!-- ./wrapper -->

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>assets/js/demo.js"></script>
  <!-- jQuery -->
  <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>assets/jquery-ui/jquery-ui.min.js"></script>
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

    // カレントページ表示
    $(document).ready(function() {
      if (location.pathname != "/") {
        $('.nav li a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
      } else $('.nav li a:eq(0)').addClass('active');
    });

    // 削除確認メッセージ
    function disp() {
      // 削除確認メッセージ
      if (window.confirm('本当に削除しますか？')) {
        return true;
      } else {
        return false;
      }
    }

    // 顧客リストの数が0にならないようにする処理
    var rows = $('table').prop('rows').length - 1;
    // console.log(rows);
    $(function() {
      // 行のソート
      // $('tbody').sortable();

      // 行が１つしかない時削除ボタンを無効にする
      if (rows == 1) {
        $(".delete-btn").addClass("disabled");
        return false;
      }
    });
  </script>
</body>

</html>