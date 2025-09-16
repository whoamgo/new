@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="alert alert-info">Please verify your email address. Check your inbox for a verification link.</div>
    <button class="btn btn-primary" id="btnResend">Resend verification email</button>
  </div>
</div>

@push('scripts')
<script>
  $('#btnResend').on('click', function () {
    $.post('{{ route('verification.send') }}').done(function (res) {
      alert(res.message || 'Verification link sent');
    });
  });
</script>
@endpush
@endsection

