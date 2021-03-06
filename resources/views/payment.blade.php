@extends('layouts.main')

@section('content')

    <section id="payment">
        <Cart></Cart>
        <div class="container">
            <div class="row m-50">
                <div class="col-12">
                    @if (session('success_message'))
                        <div class="alert alert-success">
                            {{ session('success_message') }}
                        </div>

                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>

                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" id="payment-form" action="{{ url('/checkout') }}">
                        @csrf
                        <section>
                            <label for="amount">
                                <h1 class="primary-text">Totale Ordine: {{ $total }} euro.</h1>
                                <div class="input-wrapper amount-wrapper">
                                    <input id="amount" name="amount" type="hidden" min="1" placeholder="Amount"
                                        value={{ strval($total) }}>
                                </div>
                            </label>

                            <div class="bt-drop-in-wrapper">
                                <div id="bt-dropin"></div>
                            </div>
                        </section>

                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button class="button primary-button" type="submit"><span> PAGA E METTITI COMODO</span></button>
                    </form>
                </div>
            </div>
        </div>
        <Prefooter></Prefooter>
    </section>

@endsection
<script>
    $dishes = JSON.parse(localStorage.getItem('orders'));
    $restaurantId = JSON.parse(localStorage.getItem('restaurantId'));
    $total = JSON.parse(localStorage.getItem('total'));

    console.log('Piatti');
    console.log($dishes);
    console.log('RestaurantId');
    console.log($restaurantId);
    console.log('Total');
    console.log($total);

</script>
<script defer src="https://js.braintreegateway.com/web/dropin/1.26.1/js/dropin.min.js"></script>
<script defer>
    document.addEventListener("DOMContentLoaded", function(event) {
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });


    });

</script>
