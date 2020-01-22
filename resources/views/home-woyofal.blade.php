@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenue sur le portail de facturation en ligne eLECTRA</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Infos client:-
                    <ul id="">
                        <li><strong>Nom:</strong> {{ Auth::user()->name }}</li>
                        <li><strong>Type de client:</strong> Woyofal</li>
                        <li><strong>Adresse mail:</strong>{{ Auth::user()->email }}</li>
                        <li><strong>Numéro de compteur: </strong>{{ Auth::user()->customerId }}</li>
                        <li><strong>Adresse de facturation:</strong> {{Auth::user()->address}}  </li>
                    </ul>
                  </p>
                  <p class="amount col-md-offset-7">
                    @php
                      echo "Le solde de votre compteur Woyofal est de"
                    @endphp
                      <br>
                      <span>  @php
                                  $raw_content = file_get_contents("http://localhost/api_elec/electrical_counter/read_one.php?counter_number=".Auth::user()->customerId);
                                  $clean_content = json_decode($raw_content);
                                  $current_real_amount = $clean_content->current_amount;
                                  echo $current_real_amount." FCFA";
                                  @endphp
                      </span>
                      <!-- Multiple Radios -->
                      <p>
                        <form class="form-horizontal" action="/" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label class="col-md-4 control-label" for="radios">Achat de carte de recharge</label>
                          <div class="col-md-4">
                          <div class="radio">
                            <label for="radios-0">
                              <input name="choix_recharge" id="radios-0" value="5000" checked="checked" type="radio">
                              recharge de 5000 FCFA
                            </label>
                            </div>
                          <div class="radio">
                            <label for="radios-2">
                              <input name="choix_recharge" id="radios-2" value="10000" type="radio">
                              recharge de 10000 FCFA
                            </label>
                            </div>
                            <div class="radio">
                              <label for="radios-1">
                                <input name="choix_recharge" id="radios-1" value="15000" type="radio">
                                recharge de 15000 FCFA
                              </label>
                            </div>
                            <div class="radio">
                              <label for="radios-1">
                                <input name="choix_recharge" id="radios-1" value="25000" type="radio">
                                recharge de 25000 FCFA
                              </label>
                            </div>
                            <div class="radio">
                              <label for="radios-1">
                                <input name="choix_recharge" id="radios-1" value="50000" type="radio">
                                recharge de 50000 FCFA
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                              <button type="submit" name="btn_sub" value="1" class="btn btn-success">ACHETEZ PAR CB</button>
                          </div>
                          <div class="col-md-4">
                              <button type="submit" name="btn_sub" value="2" class="btn" style="background-color:#FE9A2E;color:black">ACHETEZ PAR OM</button>
                          </div>
                          <div class="col-md-4">
                              <button type="submit" name="btn_sub" value="3" class="btn" style="background-color:#FE2E2E;color:white">ACHETEZ PAR FC</button>
                          </div>
                        </div>
                        <input type="hidden" name="page" value="home/buy" />
                        </form>
                      </p>

                      <br>
                      <p class="pastBills col-md-8 col-md-offset-5">Recharges achetées</p>
                        <table class="table">
                        <thead class="thead-dark">
                            <tr>
                              <th scope="col">Mois</th>
                              <th scope="col">Année</th>
                              <th scope="col">Etat</th>
                              <th scope="col">Montant</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($buys as $value)
                              @php
                                $size = count($value); $i = 0;
                                while($i<($size)){
                              @endphp
                              <tr>
                                    <td>{{$months[substr($value[$i]->last_updated_date,5,2) - 1]}}</td>
                                    <td>{{substr($value[$i]->last_updated_date,0,4)}}</td>
                                    <td>bought</td>
                                    <td>{{$value[$i]->amount}}</td>
                              </tr>
                              @php $i++; } @endphp
                            @endforeach
                        </tbody>
                        </table>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
