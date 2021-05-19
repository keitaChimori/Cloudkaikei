<!-- ******************************************** -->
<!-- ***   サイドメニュー共通化(管理者画面)   *** -->
<!-- ******************************************** -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">

  <!-- Brand Logo -->
  <a href="/Admin/user_list" class="brand-link">
    <img src="<?= base_url() ?>assets/img/y0729.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
    <span class="brand-text font-weight-light">CloudKaikei</span>
  </a>

  <!-- User Account -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>assets/img/person-1824144_640.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="" class="d-block">管理者</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" id="nav" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/Admin/user_list" class="nav-link">
            <i class="nav-icon fas fa-list-ol"></i>
            <p>ユーザーリスト</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/Admin/registerform" class="nav-link">
            <i class="nav-icon fas fa-user-plus"></i>
            <p>新規登録</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/Admin/editlist" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>編集</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/Admin/deletelist" class="nav-link">
            <i class="nav-icon fas fa-trash-alt"></i>
            <p>削除</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/adminlogin/admin_logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>ログアウト</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>