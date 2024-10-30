<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow p-3 mb-3 bg-white rounded">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  
  <!-- Right navbar links -->
  @auth
  <div class="navbar-nav ml-auto">
    <div class="nav-item">
      <a class="nav-link btn btn-danger text-white" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-right-from-bracket"></i>
          {{ __('Logout') }}
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </div>
  </div>
  @endauth

  @guest
  <div class="navbar-nav ml-auto">
    <div class="nav-item">
      <a href="/login" class="nav-link btn btn-primary text-white">
        <i class="fa-solid fa-right-to-bracket"></i>
        Login
      </a>
    </div>
  </div>
  @endguest
</nav>