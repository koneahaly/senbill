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
                        <li><strong>Nom: </strong> {{ Auth::user()->name }}</li>
                        <li><strong>Type de client:</strong> Classique</li>
                        <li><strong>Adresse mail: </strong> {{ Auth::user()->email }}</li>
                        <li><strong>Numéro de compteur: </strong>{{ Auth::user()->customerId }}</li>
                        <li><strong>Adresse de facturation: </strong> {{Auth::user()->address}}  </li>
                    </ul>
                    </p>
                    <p class="amount col-md-offset-7">
                      @php
                        foreach($data as $value){
                          if($value->status == 'unpaid'){
                            echo 'Vous avez une ou plusieurs factures en attente de paiement d\'un montant de';
                          }
                          else{
                            echo 'Vous n\'avez aucune facture en attente de paiement';
                          }
                        }
                      @endphp
                        <br>
                        <span>Rs  @php
                                    use App\Http\Controllers\billController;
                                    echo billController::calculate(Auth::user()->customerId);
                                    @endphp
                        </span>
                        <!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Mode de paiement</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios-0">
      <input name="radios" id="radios-0" value="1" checked="checked" type="radio">
      Carte de crédit
    </label>
    </div>
  <div class="radio">
    <label for="radios-2">
      <input name="radios" id="radios-2" value="3" type="radio">
      Orange Money
    </label>
    </div>
    <div class="radio">
      <label for="radios-1">
        <input name="radios" id="radios-1" value="2" type="radio">
        Free Cash
      </label>
    </div>
  </div>
</div>
                        <br><a href="{{url('/home/pay')}}"><button type="button" class="btn btn-warning">PAYEZ MAINTENANT</button></a>

                    </p>
                    <br>
                    <p class="pastBills col-md-8 col-md-offset-5">Factures payées</p>
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
                        @foreach($data as $value)
                        <tr>
                              <td>{{$value->month}}</td>
                              <td>{{$value->year}}</td>
                              <td>{{$value->status}}</td>
                              <td>{{$value->amount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <p class="downl col-md-offset-5">Télécharger Factures</p>
                    <form class="form-inline" action="{{route('home.pdf')}}" method="POST">
                        {{csrf_field()}}
                        <fieldset>

                        <!-- Form Name -->


                        <!-- Select Basic -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="month">Mois</label>
                          <div class="col-md-4">
                            <select id="month" name="month" class="form-control">
                              <option value="January">Janvier</option>
                              <option value="February">Février</option>
                              <option value="March">Mars</option>
                              <option value="April">Avril</option>
                              <option value="May">Mai</option>
                              <option value="June">Juin</option>
                              <option value="July">Juillet</option>
                              <option value="August">Août</option>
                              <option value="September">Septembre</option>
                              <option value="October">Octobre</option>
                              <option value="November">Novembre</option>
                              <option value="Decemeber">Decemebre</option>
                            </select>
                          </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="year">Année</label>
                          <div class="col-md-4">
                            <select id="year" name="year" class="form-control">
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                              <option value="2017">2017</option>
                              <option value="2018">2018</option>
                              <option value="2019">2019</option>
                              <option value="2020">2020</option>
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <option value="2025">2025</option>
                              <option value="2026">2026</option>
                              <option value="2027">2027</option>
                              <option value="2028">2028</option>
                              <option value="2029">2029</option>
                            </select>
                          </div>
                        </div>
                        <!-- Button -->
                            <div class="form-group">
                              <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">Télécharger</button>
                              </div>
                            </div>

                        </fieldset>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
