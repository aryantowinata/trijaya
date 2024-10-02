<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Midtrans Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>

<body>
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
</body>

</html>