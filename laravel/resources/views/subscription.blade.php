@extends('layouts.app')

@section('othersScriptsPreDom')
    @parent  

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('pk_test_tU5idfumfRpLAXwiTzx28rpn'); // token de test actuellement (joe.k..@devfactory.ch)
    // ...
    jQuery(function($) {
        $('#payment-form').submit(function(event) {
            var $form = $(this);

            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);

            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
        });
    });

    function stripeResponseHandler(status, response) {
        var $form = $('#payment-form');

        if (response.error) {
            // Show the errors on the form
            $form.find('.payment-errors').text(response.error.message);
            $form.find('button').prop('disabled', false);
        } else {
            // response contains id and card, which contains additional card details
            var token = response.id;
            // Insert the token into the form so it gets submitted to the server
            $form.append($('<input type="hidden" name="stripeToken" />').val(token));
            // and submit
            $form.get(0).submit();
        }
    };
    </script>

       

@endsection

@section('othersCSS')
    @parent

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Souscription à un abonnement</div>

                <div class="panel-body">


                    <form action="/subscribe" method="POST" id="payment-form">
                    {{ csrf_field() }} 
                      <span class="payment-errors"></span>

                      <div class="form-row">
                        <label>
                          <span>Card Number</span>
                          <input type="text" size="20" data-stripe="number" value="4242424242424242"/>
                        </label>
                      </div>

                      <div class="form-row">
                        <label>
                          <span>CVC</span>
                          <input type="text" size="4" data-stripe="cvc"/>
                        </label>
                      </div>

                      <div class="form-row">
                        <label>
                          <span>Expiration (MM/YYYY)</span>
                          <input type="text" size="2" data-stripe="exp-month" value="01"/>
                        </label>
                        <span> / </span>
                        <input type="text" size="4" data-stripe="exp-year" value="2020"/>
                      </div>

                      <button type="submit">Submit Payment</button>
                    </form>


                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection