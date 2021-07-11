@extends('layouts.app')

<link href="{{ asset('css/payment.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payez votre facture par carte bancaire</div>

                <div class="panel-body">
                  <div class="container">
                    <div class="row">
                    <!-- You can make it whatever width you want. I'm making it full width
                    on <= small devices and 4/12 page width on >= medium devices -->
                    <div class="col-xs-12 col-md-4">


                    <!-- CREDIT CARD FORM STARTS HERE -->
                    <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table" >
                    <div class="row display-tr" >

                    <h3 class="panel-title display-td" >Payment Details</h3>
                    <div class="display-td" >
                    <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                    </div>
                    </div>
                    </div>
                    <div class="panel-body">
                    <form role="form" id="payment-form" method="POST" action= "{{ url($data->page) }}">
                      {{ csrf_field() }}
                    <div class="row">
                    <div class="col-xs-12">
                    <div class="form-group">
                    <label for="cardNumber">CARD NUMBER</label>
                    <div class="input-group">
                    <input
                    type="tel"
                    class="form-control"
                    name="cardNumber"
                    placeholder="Valid Card Number"
                    autocomplete="cc-number"
                    required autofocus
                    />
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-7 col-md-7">
                    <div class="form-group">
                    <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                    <input
                    type="tel"
                    class="form-control"
                    name="cardExpiry"
                    placeholder="MM / YY"
                    autocomplete="cc-exp"
                    required
                    />
                    </div>
                    </div>
                    <div class="col-xs-5 col-md-5 pull-right">
                    <div class="form-group">
                    <label for="cardCVC">CV CODE</label>
                    <input
                    type="tel"
                    class="form-control"
                    name="cardCVC"
                    placeholder="CVC"
                    autocomplete="cc-csc"
                    required
                    />
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-12">
                    <div class="form-group">
                    <label for="couponCode">COUPON CODE</label>
                    <input type="text" class="form-control" name="couponCode" />
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-xs-12">
                    <button class="btn btn-success btn-lg btn-block" type="submit">Payez
                      @php
                                  use App\Http\Controllers\billController;
                                  if(!empty($data->mode_paiment)){
                                    echo billController::calculate(Auth::user()->customerId)." FCFA";
                                  }
                                  if(!empty($data->choix_recharge)){
                                    $montant_recharge = $data->choix_recharge;
                                    echo $montant_recharge." FCFA";
                                  }
                      @endphp
                    </button>
                    </div>
                    </div>
                    <div class="row" style="display:none;">
                    <div class="col-xs-12">
                    <p class="payment-errors"></p>
                    </div>
                    </div>
                    <input type="hidden" name="montant_recharge" value="{{ $montant_recharge }}" />
                    </form>
                    </div>
                    </div>
                    <!-- CREDIT CARD FORM ENDS HERE -->


                    </div>



                    </div>
                    </div>

                    	<!-- If you're using Stripe for payments -->
                    <script type="text/javascript" src="{{ asset('js/payment.js') }}"></script>
                    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
