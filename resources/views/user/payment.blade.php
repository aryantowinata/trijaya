@extends('layouts user.user')

@section('user-main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Pembayaran') }}</h1>

<p>Silakan selesaikan pembayaran Anda dengan menekan tombol di bawah ini:</p>

<form id="payment-form" action="#" method="POST">
    @csrf
    <button type="button" id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
</form>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                /* You may add your own success handler here */
                console.log(result);
            },
            onPending: function(result) {
                /* You may add your own pending handler here */
                console.log(result);
            },
            onError: function(result) {
                /* You may add your own error handler here */
                console.log(result);
            }
        });
    };
</script>
@endsection