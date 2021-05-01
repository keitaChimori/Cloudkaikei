<!-- ******************************** -->
<!-- ***   サイドメニュー共通化   *** -->
<!-- ******************************** -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">

    <!-- Brand Logo -->
    <a href="/ledger" class="brand-link">
      <img src="<?=base_url() ?>assets/img/y0729.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; background-color: white;">
      <span class="brand-text font-weight-light">Cloudkaikei</span>
    </a>

    <!-- User Account -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/img/person-1824144_640.png" class="img-circle elevation-2" alt="User Image">
          
        </div>
        <div class="info">
          <a href="/Mypage" class="d-block">
          <!-- ユーザー名表示 -->
            <?php if(!empty($user_name['name'])): ?>
              <?= $user_name['name']; ?> 
            <?php else: ?>
              User's name
            <?php endif; ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/ledger" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                売上台帳
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/invoice" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                請求書
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/customer" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                顧客リスト
              </p>
            </a>
          </li>
          <li class="nav-item">
              <a href="/login/user_logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  ログアウト
                </p>
              </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>