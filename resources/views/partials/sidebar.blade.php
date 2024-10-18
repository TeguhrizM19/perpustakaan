<div class="sidebar">
  <!-- Sidebar user (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('templating/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">Alexander Pierce</a>
    </div>
  </div>

  <!-- SidebarSearch Form -->
  <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/books" class="nav-link {{ Request::is('books*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-solid fa-book"></i>
          <p>Buku</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/category" class="nav-link {{ Request::is('category*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-solid fa-list"></i>
          <p>Category</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/borrows" class="nav-link {{ Request::is('borrows*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-regular fa-id-card"></i>
          <p>Peminjaman</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/users" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-solid fa-users"></i>
          <p>Users</p>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>