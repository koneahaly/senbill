<?php if(!isset($numberOfBillsNonPaid)) $numberOfBillsNonPaid = -1; ?>
@extends('layouts.app', ['notification' => $numberOfBillsNonPaid])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-8 col-md-offset-2  p-0 mt-3 mb-2">
            <div class="panel panel-default" style="margin-top:85px;color:black;">
                <div class="panel-heading">Tableau de bord Admin</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                      <div class="col-md-6">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.create_users_demo') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Importer les clients</button>
                        </form>
                        <br /> <br />
                      </div>
                      <div class="col-md-6">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.imports_bills') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Importer les factures</button>
                        </form>
                        <br /> <br />
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.imports_bills_six_months') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Importer les factures du semestre</button>
                        </form>
                        <br /> <br />
                      </div>
                      <div class="col-md-6">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.imports_occupants_bills') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Importer les factures des locataires</button>
                        </form>
                        <br /> <br />
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.dashboard') }}">
                            {{ csrf_field() }}
                            <button type="submit" name="add_service" class="btn btn-primary">Ajouter un service</button>
                        </form>
                        <br /> <br />
                      </div>
                      <div class="col-md-6">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.dashboard') }}">
                            {{ csrf_field() }}
                            <button type="submit" name="add_partner" class="btn btn-primary">Ajouter un partenaire</button>
                        </form>
                        <br /> <br />
                      </div>
                    </div>

                    @if(!isset($_POST['add_service']) && !isset($_POST['add_partner']))
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
                              <option value="Janvier">Janvier</option>
                              <option value="Février">Février</option>
                              <option value="Mars">Mars</option>
                              <option value="Avril">Avril</option>
                              <option value="Mai">Mai</option>
                              <option value="Juin">Juin</option>
                              <option value="Juillet">Juillet</option>
                              <option value="Août">Août</option>
                              <option value="Septembre">Septembre</option>
                              <option value="Octobre">Octobre</option>
                              <option value="Novembre">Novembre</option>
                              <option value="Décembre">Décembre</option>
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
                        @endif
                        @if(isset($_POST['add_service']))
                        <form class="form-horizontal" action="{{ route('admin.add_service') }}" method="POST">
                            {{ csrf_field() }}
                            <fieldset>

                            <!-- Form Name -->
                            <legend>Nouveau service</legend>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="libelle">Libellé</label>
                              <div class="col-md-4">
                              <input id="libelle" name="libelle" placeholder="" class="form-control input-md" required="" type="text">

                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="desc">Description</label>
                              <div class="col-md-6">
                              <textarea id="desc" name="desc" placeholder="" class="form-control input-md" required=""></textarea>

                              </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="month">Type de service</label>
                              <div class="col-md-4">
                                <select id="tos" name="tos" class="form-control">
                                  <option value="postpaid">Postpayé</option>
                                  <option value="prepaid">Prépayé</option>
                                  <option value="hybrid">Hybride</option>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                              </div>
                            </div>

                            </fieldset>
                            </form>
                        @endif

                        @if(isset($_POST['add_partner']))
                        <form class="form-horizontal" action="{{ route('admin.add_partner') }}" method="POST">
                            {{ csrf_field() }}
                            <fieldset>

                            <!-- Form Name -->
                            <legend>Nouveau partenaire</legend>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="social">Nom de la société</label>
                              <div class="col-md-6">
                              <input id="social" name="social" placeholder="" class="form-control input-md" required="" type="text">

                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="siret">N° de siret</label>
                              <div class="col-md-6">
                              <input id="siret" name="siret" placeholder="" class="form-control input-md" required="" type="text"/>

                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-4 control-label" for="email">Email</label>
                              <div class="col-md-6">
                              <input id="email" name="email" placeholder="" class="form-control input-md" required="" type="text"/>

                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-4 control-label" for="phone">Téléphone</label>
                              <div class="col-md-6">
                              <input id="phone" name="phone" placeholder="" class="form-control input-md" required="" type="text"/>

                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-md-4 control-label" for="address">Adresse du siège</label>
                              <div class="col-md-6">
                              <input id="address" name="address" placeholder="" class="form-control input-md" required="" type="text"/>

                              </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="month">Service</label>
                              <div class="col-md-4">
                                <select id="service" name="service" class="form-control">
                                  @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->libelle }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                              </div>
                            </div>

                            </fieldset>
                            </form>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
