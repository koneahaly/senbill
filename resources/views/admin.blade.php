@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tableau de bord Admin</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form class="form-horizontal" action="{{ route('admin.store') }}" method="POST">
                        {{ csrf_field() }}
                        <fieldset>

                        <!-- Form Name -->
                        <legend>Nouvelle facture</legend>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="customerId">Numéro de compteur</label>
                          <div class="col-md-4">
                          <input id="customerId" name="customerId" placeholder="" class="form-control input-md" required="" type="text">

                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="initial">Consommation initiale</label>
                          <div class="col-md-2">
                          <input id="initial" name="initial" placeholder="" class="form-control input-md" required="" type="text">

                          </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="final">Consommation finale</label>
                          <div class="col-md-2">
                          <input id="final" name="final" placeholder="" class="form-control input-md" required="" type="text">

                          </div>
                        </div>

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
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                          </div>
                        </div>

                        </fieldset>
                        </form>
                        <form class="form-inline" action="{{ route('admin.updaterate') }}" method="POST">
                            {{ csrf_field() }}

                            <fieldset>

                            <!-- Form Name -->
                            <legend>Mise à jour du tarif</legend>
                            <p class="current">Tarif actuel = <span>{{ Auth::user()->rate }} </span></p>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="rate">Nouveau tarif</label>
                              <div class="col-md-2">
                              <input id="rate" name="rate" placeholder="" class="form-control input-md" required="" type="text">

                              </div>
                            </div>
                            <!-- Button -->
                            <div class="form-group">
                              <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
