@include('layouts.head')

<body>



    @include('layouts.scripts')

    <script>
        const payment = {!! json_encode($data) !!};
        const redirect = {!! json_encode($redirect) !!};
        $(document).ready(function() {
            if (payment.status === 'successful' || payment.status === 'completed') {
                $.alert({
                    title: 'Hello!',
                    icon: `mdi mdi-checkbox-marked-circle-outline`,
                    type: 'green',
                    content: `Payment was ${payment.status}`,
                    theme: "modern",
                    buttons: {
                        ok: {
                            text: 'ok',
                            btnClass: 'btn-green',
                            keys: ['enter', 'shift'],
                            action: function() {
                                window.location.href = redirect;
                            }
                        },
                    }
                });
            } else {
                $.alert({
                    title: 'Sorry!',
                    icon: `mdi mdi-information-outline`,
                    type: 'orange',
                    content: `Payment was ${payment.status}`,
                    theme: "modern",
                    buttons: {
                        ok: {
                            text: 'ok',
                            btnClass: 'btn-orange',
                            keys: ['enter', 'shift'],
                            action: function() {
                                window.location.href = redirect;
                            }
                        },
                    }
                });
            }
            console.log(payment.status);

        })
    </script>

</body>


</html>
