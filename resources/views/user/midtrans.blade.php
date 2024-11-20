@extends('layouts user.user')

@section('user-main-content')

<h1>Silakan Selesaikan Pembayaran</h1>
<button id="pay-button">Bayar Sekarang</button>

<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log('payment success:', result);
                // Lakukan redirect ke halaman order jika pembayaran berhasil
                window.location.href = "{{ route('user.orders') }}";
            },
            onPending: function(result) {
                console.log('waiting for payment:', result);
            },
            onError: function(result) {
                console.log('payment error:', result);
            }
        });
    };
</script>

@endsection