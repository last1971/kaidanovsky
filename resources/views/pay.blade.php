<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
    <head>
        <title></title>
        <script type="text/javascript">
            function closethisasap() {
                document.forms["redirectpost"].submit();
            }
        </script>
    </head>
    <body onload="closethisasap();">
        <form name="redirectpost"
              method="POST"
              action="{{ env('MODUL_BASE_URI', 'https://pay.modulbank.ru') . '/pay' }}"
        >
            <input type="hidden" name="merchant" value="{{ $order->merchant }}">
            <input type="hidden" name="amount" value="{{ $order->amount }}">
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="custom_order_id" value="{{ $order->order_number }}">
            <input type="hidden" name="description" value="{{ $order->description }}">
            <input type="hidden" name="success_url" value="{{ route('success') }}">
            <input type="hidden" name="testing" value="{{ $order->testing }}">
            <input type="hidden" name="callback_on_failure" value="1">
            <input type="hidden" name="client_phone" value="{{ $order->phone }}">
            <input type="hidden" name="client_name" value="{{ $order->name }}">
            <input type="hidden" name="client_email" value="{{ $order->email }}">
            <input type="hidden" name="unix_timestamp" value="{{ $order->unix_timestamp }}">
            <input type="hidden" name="salt" value="{{ $order->salt }}">
            <input type="hidden" name="signature" value="{{ $order->getSignature() }}">
        </form>
    </body>
</html>
