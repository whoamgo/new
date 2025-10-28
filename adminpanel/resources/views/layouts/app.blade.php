<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AdminPanel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <style>
        .avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
    </style>
    @stack('styles')
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">{{ setting('APP_BRAND_NAME', config('app.name')) }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="/">Dashboard</a></li>
          </ul>
          <ul class="navbar-nav ms-auto">
            @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="avatar me-2" src="{{ current_user()->avatar_path ? asset('storage/'.current_user()->avatar_path) : 'https://www.gravatar.com/avatar/'.md5(strtolower(trim(current_user()->email))).'?s=80&d=mp' }}" />
                {{ current_user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="#" id="btnLogout">Logout</a>
                </li>
              </ul>
            </li>
            @endauth
            @guest
              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <div class="container py-4">
      @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } });
      $(document).on('click', '#btnLogout', function (e) {
        e.preventDefault();
        $.post('{{ route('logout') }}').done(function (res) {
          if (res.redirect) window.location = res.redirect;
        });
      });
    </script>
    @stack('scripts')
  </body>
 </html>

