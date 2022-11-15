
@extends('layouts.dashboardLayout', ['social_name' => session()->get('social_name'), 'full_name' => session()->get('full_name')])
@section('content')
<!-- Content Wrapper. Contains page content -->

<style>
h6{
        text-align: center;
    }
</style>

@if(session('message'))
<input  type='hidden' class="mess" value="{{ session('message') }}">
<script>
 $(document).ready(function() {
  var  mess= $('.mess').val();
  showAddPropertyNotif(mess);
  });
 </script>
@endif

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          @if(session()->get('service_id') != 6 AND session()->get('service_id') != 5)
            <h1 class="m-0 text-dark"> Opérations </h1>
          @endif
          @if(session()->get('service_id') == 6)
            <h1 class="m-0 text-dark"> Demandes </h1>
          @endif
          @if(session()->get('service_id') == 5)
            <h1 class="m-0 text-dark"> Déclarations </h1>
          @endif
        </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              @if(session()->get('service_id') != 6 AND session()->get('service_id') != 5)
                <li class="breadcrumb-item active"> Transactions </li>
              @endif
              @if(session()->get('service_id') == 6)
                <li class="breadcrumb-item active"> Demandes </li>
              @endif
              @if(session()->get('service_id') == 5)
                <li class="breadcrumb-item active"> Déclarations </li>
              @endif
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @if(session()->get('service_id') != 6 AND session()->get('service_id') != 5)
    <section class="content">
      <div class="container-fluid">
        <!-- /.METTRE TABLEAU ICI -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Suivi des transactions</h3> <br/>
            <p> Les paiements de vos clients effectués / en attente / impayés</p>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="clientsTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th>Date de création</th>
                <th>Type d'opération</th>
                <th>Nom Complet</th>
                <th>CNI</th>
                <th>Montant</th>
                <th>Devise</th>
                <th>Méthode de paiement</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                @foreach($transactions as $transaction)
                <tr>
                  <td>{{ $transaction->created_at }}</td>
                  <td>Mensualité</td>
                  <td> {{ $transaction->first_name.' '.$transaction->last_name }} </td>
                  <td> {{ str_replace(' ','',$transaction->customerId) }}</td>
                  <td>{{ $transaction->paid_amount }}</td>
                  <td>FCFA</td>
                  <td>{{ $transaction->payment_method }}</td>
                  <td>  <img src="{{ url('images/Orange_Money-Logo.png') }}" alt="Logo OM" class="brand-image img-circle elevation-3" style="max-height: 40px;">
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    @endif
    @if(session()->get('service_id') == 6)
    <section class="content">
      <div class="container-fluid">
        <!-- /.METTRE TABLEAU ICI -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Suivi des demandes</h3> <br/>
            <p> Les demandes de vos clients en attente </p>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="clientsTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Date de création</th>
                <th>Type de demande</th>
                <th>Nom Complet</th>
                <th>CNI</th>
                <th>Montant</th>
                <th>Devise</th>
                <th>Actions</th>
                
              </tr>
              </thead>
              <tbody>
                @foreach($transactions as $transaction)
                <tr>
                <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" style="color:#337DFF;" ></i></td>
                  <td>{{ $transaction->request_id }}</td>
                  <td>{{ $transaction->demands_created_at }}</td>
                  <td>{{ $transaction->sp_label }}</td>
                  <td> {{ $transaction->first_name.' '.$transaction->last_name }} </td>
                  <td> {{ str_replace(' ','',$transaction->customer_id) }}</td>
                  <td>200</td>
                  <td>FCFA</td>
                  <td><button href="#modal-lg" data-toggle="modal" data-target="#modal_{{$transaction->demands_id}}" class="btn btn-xs btn-primary"> Visualisez</button></td>
                  <div class="modal fade modal_1" id="modal_{{$transaction->demands_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $transaction->sp_label }} n° {{ $transaction->demands_id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h6> <u> Les informations personnelles du demandeur </u> </h6>
                        <br />
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>CIVILITE</strong></p>
                              <span class="recapData">Mr</span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>PRENOM</strong></p>
                              <span class="recapData">{{ $transaction->first_name }}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>NOM</strong></p>
                              <span class="recapData">{{ $transaction->last_name }}</span>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>DATE DE NAISSANCE</strong></p>
                              <span class="recapData">{{$transaction->dob}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>LIEU DE NAISSANCE</strong></p>
                              <span class="recapData">{{$transaction->pob}}</span>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>CNI</strong></p>
                              <span class="recapData">{{$transaction->customer_id}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>DOMICILE</strong></p>
                              <span class="recapData">{{$transaction->physical_address}}</span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>TELEPHONE</strong></p>
                              <span class="recapData">{{$transaction->phone}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>ADRESSE MAIL</strong></p>
                              <span class="recapData">{{$transaction->email}}</span>
                            </div>
                          </div>
                          <br />

                          <h6> <u> Les informations complémentaires à la demande </u> </h6>
                          <br />
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>NOM DU PERE</strong></p>
                              <span class="recapData">{{$transaction->father_last_name}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>PRENOM DU PERE</strong></p>
                              <span class="recapData">{{$transaction->father_first_name}}</span>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>NOM DE LA MERE</strong></p>
                              <span class="recapData">{{$transaction->mother_last_name}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>PRENOM DE LA MERE</strong></p>
                              <span class="recapData">{{$transaction->mother_first_name}}</span>
                            </div>
                          </div>
                          <br />

                          <h6> <u> Les pièces jointes associées à la demande </u> </h6>
                          <br />
                          <ul>
                            @foreach($pjs as $pj)
                              @foreach($pj as $j)
                                @if($j->request_id == $transaction->demands_id)
                                  <li>
                                    <a href="{{ $j->pj_link }}">{{ $j->pj_name }}</a>&nbsp;
                                    <a href="{{ $j->pj_link }}" target='_blank' download><i class="fas fa-download"></i> </a>
                                    
                                  </li>
                                @endif
                              @endforeach
                            @endforeach
                          </ul>
                          <br />
                      </div>
                      <div class="modal-footer">
                      <form method="POST" action="<?php echo e(route('transactions.dashboard')); ?>">
                        <?php echo e(csrf_field()); ?>
                          <input type="hidden" name = "id_demand_to_treat" value = "{{ $transaction->demands_id }}" />
                          <input type="hidden" name = "requester_id" value = "{{ $transaction->customer_id }}" />
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_decline" name ="action" value= "Decline" class="btn btn-danger">Décliner</button>
                          <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_accept" name ="action" value= "Accept" class="btn btn-success">Accepter</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="modal_decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $transaction->sp_label }} n° {{ $transaction->demands_id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('transactions.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                          <div class="modal-body">
                            <h6> <u> Motif de refus </u> </h6>
                            <br />
                              
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Commentaires</label>
                              <textarea class="form-control" name="comments" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $transaction->demands_id }}" />
                            <input type="hidden" name = "requester_id" value = "{{ $transaction->customer_id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name ="action" value = "Decline" class="btn btn-success">Confirmer</button>
                          </div>
                      </form>
                    </div>
                </div>
              </div>

                <div class="modal fade" id="modal_accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $transaction->sp_label }} n° {{ $transaction->demands_id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('transactions.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                          <div class="modal-body">
                            <h6> <u> Plus de détails </u> </h6>
                            <br />
                              
                            <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                              <span class="label-input100 control-label">Date de retrait *</span>
                              <input class="input100 update_deadline" type="text" name="deadline" required value="">
                              @if ($errors->has('deadline'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('deadline') }}</strong>
                                  </span>
                              @endif
                            </div>

                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $transaction->demands_id }}" />
                            <input type="hidden" name = "requester_id" value = "{{ $transaction->customer_id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name ="action" value = "Accept" class="btn btn-success">Confirmer</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                @endforeach
                </tr>
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    @endif


    @if(session()->get('service_id') == 5)
    <section class="content">
      <div class="container-fluid">
        <!-- /.METTRE TABLEAU ICI -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Suivi des Locations</h3> <br/>
            <p> Les déclarations des biens en location </p>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="clientsTable" class="table table-bordered table-striped table-hover">
              <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Date de création</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Caution</th>
                <th>Loyer</th>
                <th>Occupé</th>
                <th>Actions</th>
                
              </tr>
              </thead>
              <tbody>
                <?php $nb = 1; ?>
                @foreach($transactions as $transaction)
                <tr>
                <td style="vertical-align: middle;text-align:center;"><i class="fas fa-dice-one fa-1x" style="color:#337DFF;" ></i></td>
                  <td>{{ $nb}}</td>
                  <td>{{ $transaction->created_at }}</td>
                  <td>{{ $transaction->city }}</td>
                  <td>{{ $transaction->address }} </td>
                  <td>{{ (!empty($transaction->bail) ? $transaction->bail : '0' ) }}</td>
                  <td>{{ $transaction->monthly_pm }}</td>
                  <td>{{ ($transaction->status == 'N') ? 'Oui' : 'Non'}}</td>
                  <td><button href="#modal-lg" data-toggle="modal" data-target="#modal_{{$transaction->id}}" class="btn btn-xs btn-primary"> Visualisez</button></td>
                  <div class="modal fade modal_1" id="modal_{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> logement n° {{ $nb }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h6> <u> Les informations du propriétaire ou gérant </u> </h6>
                        <br />
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>CIVILITE</strong></p>
                              <span class="recapData">Mr</span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>PRENOM</strong></p>
                              <span class="recapData">{{ $transaction->first_name }}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>NOM</strong></p>
                              <span class="recapData">{{ $transaction->last_name }}</span>
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>CNI</strong></p>
                              <span class="recapData">{{$transaction->customer_id}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>DOMICILE</strong></p>
                              <span class="recapData">{{$transaction->physical_address}}</span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>TELEPHONE</strong></p>
                              <span class="recapData">{{$transaction->phone}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>ADRESSE MAIL</strong></p>
                              <span class="recapData">{{$transaction->email}}</span>
                            </div>
                          </div>
                          <br />

                          <h6> <u> Les informations complémentaires à la déclaration </u> </h6>
                          <br />
                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>TYPE DE LOCATION</strong></p>
                              <span class="recapData">{{$transaction->nb_rooms}}</span>
                            </div>

                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>MEUBLE</strong></p>
                              <span class="recapData">{{ ($transaction->housing_type == 'meuble' ? 'OUI' : 'NON') }}</span>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6" style="margin-bottom:10px">
                              <p><strong>DESCRIPTION</strong></p>
                              <span class="recapData">{{$transaction->description}}</span>
                            </div>

                          </div>
                          <br />


                      </div>
                      <div class="modal-footer">
                      <form method="POST" action="<?php echo e(route('transactions.dashboard')); ?>">
                        <?php echo e(csrf_field()); ?>
                          <input type="hidden" name = "id_demand_to_treat" value = "{{ $transaction->id }}" />
                          <input type="hidden" name = "requester_id" value = "{{ $transaction->customer_id }}" />
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_decline" name ="action" value= "Decline" class="btn btn-danger">Décliner</button>
                          <button href="#modal-lg" data-toggle="modal" type="button" data-target="#modal_accept" name ="action" value= "Accept" class="btn btn-success">Accepter</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="modal_decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> logement n° {{ $nb }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('transactions.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                          <div class="modal-body">
                            <h6> <u> Motif de refus </u> </h6>
                            <br />
                              
                            <div class="form-group">
                              <label for="exampleFormControlTextarea1">Commentaires</label>
                              <textarea class="form-control" name="comments" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $transaction->id }}" />
                            <input type="hidden" name = "requester_id" value = "{{ $transaction->customer_id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name ="action" value = "Decline" class="btn btn-success">Confirmer</button>
                          </div>
                      </form>
                    </div>
                </div>
              </div>

                <div class="modal fade" id="modal_accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"> logement n° {{ $nb }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form method="POST" action="<?php echo e(route('transactions.dashboard')); ?>">
                          <?php echo e(csrf_field()); ?>
                          <div class="modal-body">
                            <h6> <u> Plus de détails </u> </h6>
                            <br />
                              
                            <div class="wrap-input100 bg1 rs1-wrap-input100 form-group{{ $errors->has('deadline') ? ' has-error' : '' }}">
                              <span class="label-input100 control-label">Rendez-vous *</span>
                              <input class="input100 update_deadline" type="text" name="deadline" required value="">
                              @if ($errors->has('deadline'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('deadline') }}</strong>
                                  </span>
                              @endif
                            </div>

                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name = "id_demand_to_treat" value = "{{ $transaction->id }}" />
                            <input type="hidden" name = "requester_id" value = "{{ $transaction->customer_id }}" />
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name ="action" value = "Accept" class="btn btn-success">Confirmer</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php $nb++; ?>
                @endforeach
                </tr>
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    @endif

@if(session('message'))
<input  type='hidden' class="mess" value="{{ session('message') }}">
<script>
 $(document).ready(function() {
  var  mess= $('.mess').val();
  showAddPropertyNotif(mess);
  });
 </script>
@endif
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">Senbill-S2SN </a>.</strong>
    Tous droits réservés.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- jQuery -->
<script src="{{ url('dashboardAssets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('dashboardAssets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('dashboardAssets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('dashboardAssets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('dashboardAssets/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('dashboardAssets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('dashboardAssets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('dashboardAssets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('dashboardAssets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('dashboardAssets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('dashboardAssets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dashboardAssets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('dashboardAssets/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('dashboardAssets/dist/js/demo.js') }}"></script>
<!-- DataTables -->
<script src="{{ url('dashboardAssets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('dashboardAssets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('js/notify.js') }}"></script>

<script>

$(document).ready(function() {
  $('#modal_decline').click(function() {
    $('.modal_1').modal('hide');
  });
}); 

$(document).ready(function() {
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});
</script>
<script>
  $(function () {
    $("#clientsTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "lengthChange": true,
      "info": true,
      "ordering": true,
      language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
      }

    });
  });

  function showAddPropertyNotif(message) {
         $('.content').notify(message, {
           // whether to hide the notification on click
          clickToHide: true,
          // whether to auto-hide the notification
          autoHide: true,
          // if autoHide, hide after milliseconds
          autoHideDelay: 10000,
          // show the arrow pointing at the element
          arrowShow: true,
          // arrow size in pixels
          arrowSize: 5,
          // position defines the notification position though uses the defaults below
          position: 'top',
          // default positions
          elementPosition: 'top left',
          globalPosition: 'top left',
          // default style
          style: 'bootstrap',
          // default class (string or [string])
          className: 'success',
          // show animation
          showAnimation: 'slideDown',
          // show animation duration
          showDuration: 400,
          // hide animation
          hideAnimation: 'slideUp',
          // hide animation duration
          hideDuration: 200,
          // padding between element and notification
          gap: -2,
          });
       }
</script>
<script src="{{url('vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{url('vendor/daterangepicker/daterangepicker.js')}}"></script>
<script>
$(function() {
  $('input[name="deadline"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    timePicker: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
    locale: {
      format: 'YYYY-MM-DD HH:mm',
    separator: " - ",
        applyLabel: "Valider",
        cancelLabel: "Annuler",
        fromLabel: "De",
        toLabel: "A",
        weekLabel: "S",
        daysOfWeek: [
            "Dim",
            "Lu",
            "Ma",
            "Me",
            "Je",
            "Ve",
            "Sa"
        ],
        monthNames: [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Décembre"
        ],
        firstDay: 1
    }
  });
});
</script>