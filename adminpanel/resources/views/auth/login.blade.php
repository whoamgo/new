@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form id="formLogin">
          <div class="mb-3">
            <label class="form-label">Email or Username</label>
            <input type="text" class="form-control" name="login" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
          @if (feature_enabled('RECAPTCHA_ENABLED', false))
            <div class="mb-3">
              {!! NoCaptcha::display() !!}
            </div>
            {!! NoCaptcha::renderJs() !!}
          @endif
          <button class="btn btn-primary w-100" type="submit">Login</button>
        </form>
        <hr>
        <div class="d-grid gap-2">
          @if (feature_enabled('SOCIAL_GOOGLE_ENABLED', false))
          <a href="{{ route('social.redirect', 'google') }}" class="btn btn-outline-danger">Login with Google</a>
          @endif
          @if (feature_enabled('SOCIAL_TWITTER_ENABLED', false))
          <a href="{{ route('social.redirect', 'twitter') }}" class="btn btn-outline-primary">Login with Twitter</a>
          @endif
          @if (feature_enabled('SOCIAL_FACEBOOK_ENABLED', false))
          <a href="{{ route('social.redirect', 'facebook') }}" class="btn btn-outline-primary">Login with Facebook</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $('#formLogin').on('submit', function (e) {
    e.preventDefault();
    const $btn = $(this).find('button[type="submit"]').prop('disabled', true);
    $.post('{{ route('login') }}', $(this).serialize())
      .done(function (res) {
        if (res.requires_2fa) {
          window.location = '{{ route('2fa.show') }}';
          return;
        }
        if (res.redirect) window.location = res.redirect;
      })
      .fail(function (xhr) {
        alert(xhr.responseJSON?.message || 'Login failed');
      })
      .always(function () { $btn.prop('disabled', false); });
  });
</script>
@endpush
@endsection

