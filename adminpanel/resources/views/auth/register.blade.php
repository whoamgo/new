@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">Register</div>
      <div class="card-body">
        <form id="formRegister">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="username" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirmation" required>
            </div>
            @if (feature_enabled('RECAPTCHA_ENABLED', false))
              <div class="col-12">
                {!! NoCaptcha::display() !!}
                {!! NoCaptcha::renderJs() !!}
              </div>
            @endif
          </div>
          <div class="mt-3">
            <button class="btn btn-primary w-100" type="submit">Create account</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $('#formRegister').on('submit', function (e) {
    e.preventDefault();
    const $btn = $(this).find('button[type="submit"]').prop('disabled', true);
    $.post('{{ route('register') }}', $(this).serialize())
      .done(function (res) { if (res.redirect) window.location = res.redirect; })
      .fail(function (xhr) { alert(xhr.responseJSON?.message || 'Registration failed'); })
      .always(function () { $btn.prop('disabled', false); });
  });
  </script>
@endpush
@endsection

