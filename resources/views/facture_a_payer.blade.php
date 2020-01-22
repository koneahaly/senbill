@extends('layouts.app')

@section('content')
<div class="container">
    <div>
          <div class=" row panel-heading" style="margin-top:10px;margin-bottom:20px">
           <strong>Régler ma facture</strong></div>
          </div>

          <br />
          <div class="row">
            <div class="col-md-6 col-md-offset-3" style="background-color:#fff;text-align:center;">
              <div>
                <div>
                  <br/>
                  <span> Facture du mois de  {{ $data->echeance}}&nbsp;</span>
                  <span class="glyphicon glyphicon-remove-circle text-danger">Impayée</span>
                  <br />
                  <br />
                  <span style="font-size:30px"> {{ $data->montant}} FCFA</span>
                </div>
                  <br />
                  <br />

                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#carte_bancaire">Carte Bancaire</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#OrangeMoney">OrangeMoney</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#FreeCash">FreeCash</a>
                    </li>
                  </ul>

                  <span style="font-size:10px"> </span>
                  <br />
                  <br />
                  <div class="row">
                    @if(isset($_GET['carte_bancaire']) or (!isset($_GET['OrangeMoney']) and !isset($_GET['FreeCash'])))
                      <div class="col-xs-12 col-md-8">


                      <!-- CREDIT CARD FORM STARTS HERE -->
                      <div class="panel panel-default credit-card-box">
                      <div class="panel-heading display-table" >
                      <div class="row display-tr" >

                      <h3 class="panel-title display-td" > Details de paiement</h3>
                      <div class="display-td" >
                      <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                      </div>
                      </div>
                      </div>
                      <div class="panel-body">
                      <form role="form" id="payment-form" method="POST" action= "">
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

                      </button>
                      </div>
                      </div>
                      <div class="row" style="display:none;">
                      <div class="col-xs-12">
                      <p class="payment-errors"></p>
                      </div>
                      </div>

                      </form>
                      </div>
                      </div>
                      <!-- CREDIT CARD FORM ENDS HERE -->


                      </div>
                    @endif
                  </div>
                  <br />
                  <br />
                </div>

              </div>

            </div>

          </div>
          <br />
          <br />

    </div>
</div>
@endsection
