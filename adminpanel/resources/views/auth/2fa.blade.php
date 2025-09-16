@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card mb-3">
      <div class="card-header">Two Factor Authentication</div>
      <div class="card-body">
        <div id="setup" class="mb-3">
          <button class="btn btn-outline-primary" id="btnEnable">Begin setup</button>
          <div id="qrWrap" class="mt-3 d-none">
            <div class="mb-2"><code id="secret"></code></div>
            <img id="qr" alt="QR Code" />
            <div class="input-group mt-3" style="max-width: 240px;">
              <input type="text" class="form-control" id="otp" placeholder="Enter code">
              <button class="btn btn-primary" id="btnConfirm">Confirm</button>
            </div>
          </div>
        </div>
        <hr>
        <button class="btn btn-outline-danger" id="btnDisable">Disable 2FA</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $('#btnEnable').on('click', function () {
    $.post('{{ route('2fa.enable') }}').done(function (res) {
      $('#qrWrap').removeClass('d-none');
      $('#secret').text(res.secret);
      const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' + encodeURIComponent(res.qr);
      $('#qr').attr('src', qrUrl);
    });
  });

  $('#btnConfirm').on('click', function () {
    $.post('{{ route('2fa.confirm') }}', { otp: $('#otp').val() }).done(function (res) {
      alert(res.message);
      location.reload();
    }).fail(function (xhr) { alert(xhr.responseJSON?.message || 'Invalid code'); });
  });

  $('#btnDisable').on('click', function () {
    $.post('{{ route('2fa.disable') }}').done(function (res) { alert(res.message); location.reload(); });
  });
</script>
@endpush
@endsection

