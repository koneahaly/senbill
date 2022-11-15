<?php
session_start();
$_SESSION["numberOfBillsNonPaid"]=$numberOfBillsNonPaid;
$_SESSION["profilNotif"]=$profilNotif;
$service =explode('/',$_SERVER['REQUEST_URI']);
$_SESSION['current_service'] = $service[2];
if(strpos($service[2],'?') !== false){
  $clean_service = explode('?',$service[2]);
  $_SESSION['current_service'] = $clean_service[0];
}

$months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
$mapping_type_services = ['distribution' => 'type_service_1', 'servicepublic' => 'type_service_2', 'telecom' => 'type_service_3', 'sante' => 'type_service_4',
                          'locataire' => 'type_service_5', 'proprietaire' => 'type_service_6', 'scolarite' => 'type_service_7',
                          'sport' => 'type_service_8'];

?>
@extends('layouts.app', ['notification' => $numberOfBillsNonPaid, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')
<div class="container">

          <div class="row lottie-lines" style="margin-top:4%;">
          </div>
          <div class="row rowmobile" style="margin-top:10%">
            <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
              @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid')
                <h3><strong>Mes paiements</strong></h3>
              @endif
              @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'postpaid')
                <h3><strong>Mes factures</strong></h3>
              @endif
              @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} != 'postpaid' and $actived_services->{$mapping_type_services[$_SESSION['current_service']]} != 'prepaid')
                <h3><strong>Mes factures et paiements</strong></h3>
              @endif
           </div>
          </div>
              <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 80px; height: 80px; position:absolute;z-index:1000;margin-left:-8%;margin-top: 15%;"  loop  autoplay></lottie-player>
              <lottie-player src="{{url('images/lottie/bubble.json')}}"  class="lottie-bubbles" background="transparent"  speed="1"  style="width: 100px; height: 100px; position:absolute;z-index:1000;margin-left:80%;margin-top: -1.5%;"  loop  autoplay></lottie-player>
              <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 60px; height: 60px; position:absolute;z-index:1000;margin-left:1%;margin-top: -2%;"  loop  autoplay></lottie-player>

          <div class="row" style="font-size:20px;margin-bottom:20px;text-align:center;">
            <div class="col-md-12">
              <!-- if prepaid client-->
          @if (!empty($user->date_verify_email) or strpos($user->email,"user") != false or strpos($user->email,"stat") != false)
            @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid' and (!empty($data) || $data != NULL))
              <span><strong> Tous vos achats  </strong></span>
              <span class="text-success"><strong> à ce jour ! </strong></span>
            @endif
            <!-- if prepaid client-->
            @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid' and (empty($data) || $data == NULL))
              <span><strong> Aucun achat de recharge  </strong></span>
              <span class="text-success"><strong> à ce jour ! </strong></span>
            @endif
            <!-- if postpaid client-->
            @if((!empty($data) and $data != NULL) and $numberOfBillsNonPaid == 0)
              <span><strong> Tous vos paiements sont </strong></span>
              <span class="text-success"><strong> à jour ! </strong></span>
            @endif
            <!-- if postpaid client-->
            @if((!empty($data) and $data != NULL) and $numberOfBillsNonPaid > 0)
              <span><strong> Vous avez </strong></span>
              <span class="text-danger"><strong> {{ $numberOfBillsNonPaid }} <?php $lib_bill = ($numberOfBillsNonPaid == 1) ? 'facture' : 'factures'; echo $lib_bill; ?></strong></span>
              <span><strong> en attente de paiement ! </strong></span>
            @endif
            <!-- if postpaid client-->
            @if(empty($data) || $data == NULL)
              <span><strong> Aucune facture à ce jour ! </strong></span>
            @endif
          @endif
            </div>
            @if (empty($user->date_verify_email) and ((strpos($user->email,"user") === false) and (strpos($user->email,"stat") === false)))
                <div class="alert alert-success">
                    <p>Veuillez valider votre adresse mail pour utiliser l'ensemble des services.<br/>
                    Un mail de vérification vous a été envoyé à l'adresse suivante : <strong> {{ $user->email }} <strong>.</p>
                </div>
            @endif
          </div>
@if(session()->has('msg_mdp'))
    <div class="alert alert-success">
        {{ session()->get('msg_mdp') }}
    </div>
@endif
          <div class="row" style="z-index:1001">
		        <div class="col-md-12">
              <!-- if postpaid client-->
            @if(!empty($data) and $data != NULL and (!empty($user->date_verify_email) or strpos($user->email,"user") === 0 or strpos($user->email,"stat") === 0))
                <!--<h4>Paiements déjà réalisés</h4> -->
              <br/>

              <table id="billsTable" class="mdl-data-table" style="width:100%">
                <thead style="background: rgba(137,180,213,1);color:#fff">
                    <tr>
                      <!--<th>Prévu le</th> -->
                      <th> # </th>
                      <th>&Eacute;chéance</th>
                      <th>Montant</th>
                      <th>&Eacute;tat</th>
                      <th>Moyen de paiement</th>
                    </tr>
                </thead>
                <tbody style="background-color:#fff;color:#455469">
                <?php $i = 1; ?>
                  @foreach($data as $value)
                    <tr>
                      <td> <?php echo $i; ?> </td>
                      <!--<td id="{{$value->month}}"> {{$value->year}} {{$value->month}} </td>-->
                      <td>{{$value->month}} {{$value->year}} </td>
                      <td id="{{$value->month}}_amount" style="text-align:center;font-weight: 700;"> {{$value->amount}} FCFA </td>
                      @if($value->status == "paid")
                        <td id="{{$value->month}}_status" style="color:#28863e;font-weight: 700;width:20%;"> <span title="payée" class=" glyphicon btn-lg glyphicon-ok-circle text-success"></span> <br /> <span style="font-size:0.7em;font-weight: lighter;color:black;">  le {{$value->updated_at}} <span> </td>
                        <td style="width:20%;"> {{$value->payment_method}} </td>
                      @endif
                      @if($value->status != "paid")
                      <!--<td><button data-toggle="modal" data-target="#pay_bill" class="btn btn-danger btn-xs"> Régler</button> <br /> <span style="font-size:0.7em;font-weight: lighter;color:black;"> avant le {{$value->created_at}} <span></td>
                      -->
                      <td> <button class="buy btn btn-danger" onclick="callpaytech(this)" data-item-id="{{ trim($value->order_number) }}-{{$value->amount}}" >Payez
                        </button> <br /> <span style="font-size:0.7em;font-weight: lighter;color:black;"> avant le {{ Carbon\Carbon::parse($value->deadline)->locale('fr')->translatedFormat('d F Y à H\hi')  }} <span> </td>
                      
                    <!--  <td><input class="btn btn-danger btn-xs" type=button onclick='sendPaymentInfos(new Date().getTime(),"SNBIL11162", "NTrmzaD4WyiAKaTa9-8Vjc^$ijuP-ut0oY2J^drhn$v9qTWJC@","senbill.sn","https://www.senbill.com/mes-factures/{{ $_SESSION["current_service"] }}?order={{ $value->order_number }}","https://www.senbill.com/mes-factures/{{ $_SESSION["current_service"] }}?order={{ $value->order_number }}", {{ $value->amount }}, "dakar", "{{ Auth::user()->email }}","{{ Auth::user()->first_name }}", "{{ Auth::user()->name }}",  "{{ substr(Auth::user()->phone,4,12) }}" )' value=payez /> </td> -->
                      
                      <!--  POUR REGLER VIA PAYDUNYA SANS REDIRECTION COMMENTER LA LIGNE DU DESSUS ET DECOMMENTER CELLE EN DESSOUS ET DECOMMENTER DANS LAYOUT.app LE CSS de PAYDUNYA, en bas le script paydunya
                       <td><button class="pay" id="regler1" onclick="" data-ref="102" data-fullname="Alioune Faye" data-email="aliounefaye@gmail.com" data-phone="774563209">Régler PD</button><br /> <span style="font-size:0.7em;font-weight: lighter;color:black;"> avant le {{$value->created_at}} <span></td>-->
                        <td> n/a </td>
                        <input type='hidden' id="{{$value->month}}_status" value="{{$value->status}}" />
                      @endif
                      <input type="hidden" class="{{$value->month}}_year_j" name="{{$value->month}}_year_j" value="{{$value->year}}">
                      <input type="hidden" class="{{$value->month}}_creation_date_j" name="{{$value->month}}_creation_date_j" value="{{ substr($last_row_data->created_at,8,2)."/".substr($last_row_data->created_at,5,2)."/".substr($last_row_data->created_at,0,4) }}">
                    </tr>
                    <?php $i++; ?>
                  @endforeach
                </tbody>
              </table>

                <div class="mobile-table">
                @foreach($data as $value)
                  <div class="panel" >
  					             <div class="panel-heading text-left" style="background-color:#455469 !important;color:#fff !important">
                         <h3 class="panel-title" ><i class="fas fa-file-invoice"></i> Facture de {{$value->month}} {{$value->year}}
                         <i data-toggle="collapse" data-target="#{{ $value->id}}" id="clickbtn_{{ $value->id}}" class="fas fa-chevron-circle-down pull-right clickbtn"></i></h3></div>
  					                  <div class="panel-body collapse" id="{{ $value->id}}">
  						                        <div class="row">
                                        <div class="col-xs-3"> <strong>Montant</strong> </div>
                                        <div class="col-xs-3"> {{$value->amount}} FCFA </div>
                                        <div class="col-xs-3"><strong>Unité(s) consommée(s)</strong></div>
                                        <div class="col-xs-3"> {{$value->units}} </div>
                                        <input type="hidden" class="recup_id" value="{{ $value->id }}" />
                                      </div>
                                      <br />

                                      <div class="row">
                                        <div class="col-xs-3"> <strong>Paiement</strong> </div>
                                        @if($value->status == "paid")
                                          <div class="col-xs-3" style="margin-top:-13px;margin-left:-15px"> <span title="payée le {{$value->updated_at}}" class=" glyphicon btn-lg glyphicon-ok-circle text-success"></span></div>
                                        @endif
                                        @if($value->status != "paid")
                                        <div> <button class="buy btn btn-danger" style="background-color:red;color:#fff" onclick="callpaytech(this)" data-item-id="{{ trim($value->order_number) }}-{{$value->amount}}" >Payez
                                          </button> </div>
                                        @endif
                                        <div class="col-xs-3" style="margin-left:15px"><strong> Type :</strong></div>
                                        <div class="col-xs-3"> <?php if(!empty($value->title)) echo $value->title; else echo 'non renseigné'; ?> </div>
                                      </div>
                                      <br />
                                      <div class="row">
                                        <div class="col-xs-3"> <strong>Moyen de paiement</strong> </div>
                                        <div class="col-xs-3"> <?php if(!empty($value->payment_method)) echo $value->payment_method; else echo 'non renseigné'; ?> </div>
                                        <div class="col-xs-3"><strong>Numéro de facture</strong></div>
                                        <div class="col-xs-3"> <?php if(!empty($value->order_number)) echo $value->order_number; else echo 'non renseigné'; ?> </div>
                                      </div>
                                      <br />
  					                  </div>
  				        </div>
              @endforeach
            </div>
            @endif

<!-- Modal -->

@if(Auth::user()->mdp_modified != 1)
<?php  $uri = $_SERVER['REQUEST_URI']; 
                    $uriArray = explode('/', $uri);
                    $page = implode('/',$uriArray);
              ?>

  <div class="modal fade" style="z-index : 1540 !important" id="ContactFormModal" tabindex="-1" role="dialog" 
      aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
            <form class="form-horizontal" id="formcontact" role="form" method="post" action="{{ $page }}">
              {{csrf_field()}}
                <!-- Modal Header -->
              <div class="modal-header">
                  <button type="button" class="close" 
                    data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">
                      Changer votre mot de passe
                  </h4>
              </div>
              

              <!-- Modal Body -->
              <div class="modal-body">
                  
                <div class="form-group">
                  <label  class="col-sm-2 control-label"
                            for="inputName"></label>
                  <div class="col-sm-10">
                      <input id="mdp" name="mdp" type="password" class="form-control" 
                      placeholder="Nouveau mot de passe..."/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"
                        for="inputEmail" ></label>
                    <div class="col-sm-10">
                        <input id="mdp_2" name="mdp_2" type="password" class="form-control"
                            placeholder="Confirmer mot de passe..."/>
                    </div>
                </div>

    
              </div>
              
              <!-- Modal Footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-default"
                          data-dismiss="modal">
                              Fermer
                  </button>
                  <button type="submit" name="reset_mdp" id="reset_mdp" class="btn btn-primary">
                      Modifier le mot de passe
                  </button>
                  <input type="hidden" name="change_mdp" value="true" />
              </div>
            </form>
          </div>
      </div>
  </div>
  <br />
@endif

            <!-- if prepaid client-->
            @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid' and (!empty($data) and $data != NULL) and (!empty($user->date_verify_email) or strpos($user->email,"user") === 0 or strpos($user->email,"stat") === 0))
                  <!--<h4>Achats déjà effectués</h4>-->
                <br/>
                <table id="buysTable" class="mdl-data-table" style="width:100%">
                    <!-- <caption><h4>Achats déjà effectués</h4></caption> -->
                  <thead style="background: rgba(137,180,213,1);color:#fff">
                      <tr>
                      <!--  <th>Prévu le</th>-->
                        <th>Motif</th>
                        <th>Montant</th>
                        <th>&Eacute;tat</th>
                        <th>Moyen de paiement</th>
                      </tr>
                  </thead>
                  <tbody style="background-color:#fff;color:#455469">
                      @foreach($data as $value)
                        @foreach($value as $v)
                          <tr>
                          <!--  <td> {{$v->creation_date}} </td>-->
                            <td> Achat de carte prépayée </td>
                            <td id="{{$months[(int)substr($v->creation_date,5,2) -1] }}_amount" style="text-align:center;font-weight: 700;"> {{$v->amount}} FCFA </td>
                            <td id="{{$months[(int)substr($v->creation_date,5,2) -1] }}_status" style="color:#28863e;font-weight: 700;width:20%;"> <span title="payée" class=" glyphicon btn-lg glyphicon-ok-circle text-success"></span> <br /> <span style="font-size:0.7em;font-weight: lighter;color:black;"> le {{$v->creation_date}} <span></td>
                            <td style="width:20%;"> {{$v->payment_method}} </td>
                            <input type="hidden" class="{{$months[(int)substr($v->creation_date,5,2) -1] }}_year_j" name="{{$months[(int)substr($v->creation_date,5,2) -1] }}_year_j" value="{{substr($v->creation_date,0,4)}}" />
                            <input type="hidden" class="{{$months[(int)substr($v->creation_date,5,2) -1] }}_creation_date_j" name="{{$months[(int)substr($v->creation_date,5,2) -1] }}_creation_date_j" value="{{ substr($v->creation_date,8,2)."/".substr($v->creation_date,5,2)."/".substr($v->creation_date,0,4) }}" />
                            <input type='hidden' id="{{$months[(int)substr($v->creation_date,5,2) -1] }}_status" value="paid" />
                          </tr>
                          @endforeach
                      @endforeach
                  </tbody>
                </table>

                <div class="mobile-table">
                  @foreach($data as $value)
                    @foreach($value as $v)
                  <div class="panel" >
  					             <div class="panel-heading text-left" style="background-color:#455469 !important;color:#fff !important">
                         <h3 class="panel-title" ><i class="fas fa-receipt"></i> Reçu de {{$v->creation_date}}
                         <i data-toggle="collapse" data-target="#{{ $v->id}}" id="clickbtn_{{ $v->id}}" class="fas fa-chevron-circle-down pull-right clickbtn"></i></h3></div>
					                  <div class="panel-body collapse" id="{{ $v->id}}">
				                        <div class="row">
                                  <div class="col-xs-3"> <strong>Montant</strong> </div>
                                  <div class="col-xs-3"> {{$v->amount}} FCFA </div>
                                  <input type="hidden" class="recup_id" value="{{ $v->id }}" />
                                </div>
                                <br />

                                <div class="row">
                                  <div class="col-xs-3"> <strong>Paiement</strong> </div>
                                  <div class="col-xs-3" style="margin-top:-13px;margin-left:-15px"> <span title="payée le {{$v->creation_date}}" class=" glyphicon btn-lg glyphicon-ok-circle text-success"></span></div>
                                  <div class="col-xs-3" style="margin-left:15px"><strong> Type :</strong></div>
                                  <div class="col-xs-3"> <?php if(!empty($v->title)) echo $v->title; else echo 'non renseigné'; ?> </div>
                                </div>
                                <br />
                                <div class="row">
                                  <div class="col-xs-3"> <strong>Moyen de paiement</strong> </div>
                                  <div class="col-xs-3"> <?php if(!empty($v->payment_method)) echo $v->payment_method; else echo 'non renseigné'; ?> </div>
                                </div>
                                <br />
					                  </div>
  				        </div>
                  @endforeach
              @endforeach
            </div>

              @endif
          </div>
          <br />
          <!-- if prepaid client-->
          @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid' and (!empty($user->date_verify_email) or strpos($user->email,"user") === 0 or strpos($user->email,"stat") === 0))
          <div class=" buydiv row panel-heading" style="margin-top:10px;margin-bottom:20px">
           <button class="btnBuy" data-toggle="modal" data-target="#buy_card">
             <span class="circle">
               <span class="icon arrow"></span>
             </span>
             <span class="button-text">Acheter une carte</span>
           </button>
          </div>
          </div>

          @endif

          @if(!empty($last_row_data) and !empty($user->date_verify_email))
          <div class="row">
            <!-- if postpaid client-->
            @if((!empty($user->date_verify_email) or strpos($user->email,"user") === 0 or strpos($user->email,"stat") === 0))
              <div class="col-md-8 col-md-offset-2 picker">
                @if(!empty($last_row_data->month))
                  <input type="hidden" class="slider-input" value={{ date('n',strtotime($last_row_data->month)) }} />
                @endif
                @if(empty($last_row_data->month))
                  <input type="hidden" class="slider-hide" value="{{ date('n') }}" />
                @endif
              </div>
            @endif
            <!-- if prepaid client-->
            @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid' and (!empty($user->date_verify_email) or strpos($user->email,"user") === 0 or strpos($user->email,"stat") === 0))
              <div class="col-md-8 col-md-offset-2 picker_2">
                @if(!empty($last_row_data->month))
                  <input type="hidden" class="slider-input" value={{ date('n',strtotime($last_row_data->month)) }} />
                @endif
                @if(empty($last_row_data->month))
                  <input type="hidden" class="slider-hide" value="{{ date('n') }}" />
                @endif
              </div>
            @endif
            <br />
            <!-- if postpaid client-->
            @if((!empty($user->date_verify_email) or strpos($user->email,"user") === 0 or strpos($user->email,"stat") === 0))
            <br/>
              <div class="col-md-4 col-md-offset-4 ticket" style="text-align:center;margin-top:25px">
                <form class="form-inline" action="../mes-factures/{{ $_SESSION['current_service'] }}/pdf_bill" method="POST" target="_blank">
                    {{csrf_field()}}
                <div class="large-main-panel" style="background-color:#fff;">
                  <div>
                    <i class="fas fa-paperclip fa-3x" style="margin-right:98%;margin-top: -200px;"></i>
                    <br/>
                    <span class="tl_fac"> Facture du mois de {{$last_row_data->month}} &nbsp;</span>
                    @if($last_row_data->status != "paid")
                      <span class="status_j glyphicon glyphicon-remove-circle text-danger">Impayée</span>
                    @endif

                    @if($last_row_data->status == "paid")
                      <span class=" status_j glyphicon glyphicon-ok-circle text-success">Payée</span>
                    @endif

                    <br />
                    <br />
                    <span class="amount_j" style="font-size:30px"> {{$last_row_data->amount}} FCFA</span>
                    <br />
                    <br />
                    <hr>
                    <p class="tl_echeance"><strong> Echéance de {{$last_row_data->month}} {{$last_row_data->year}} </strong></p>
                    @if($last_row_data->status == "paid")
                      <span class="tl_paiement" style="font-size:10px"> paiement effectué le @php echo substr($last_row_data->updated_at,8,2)."/"; echo substr($last_row_data->created_at,5,2)."/"; echo substr($last_row_data->created_at,0,4); @endphp </span>
                    @endif
                    @if($last_row_data->status != "paid")
                      <span class="tl_paiement" style="font-size:10px"> &Agrave; régler avant le @php echo Carbon\Carbon::parse($value->deadline)->locale('fr')->translatedFormat('d F Y à H\hi'); @endphp </span>
                    @endif
                    <br />
                    <br />
                    <div class="row toPay">
                      @if($last_row_data->status == "paid")
                        <!--<button class="btn rgmail" style="background-color:rgba(137,180,213,1);color:#fff"> Envoyer par mail </button>-->
                        <button type="submit" target ="_blank" class="btn rgdown" style="background-color:rgba(137,180,213,1);color:#fff"> Télécharger</button>
                        <input type="hidden" name="id_bill" value="{{$last_row_data->id}}" />
                        <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
                      @endif
                    </div>
                    </div></div>
                    </form>
                      @if($last_row_data->status != "paid")
                        <!--<button data-toggle="modal" data-target="#pay_bill" class="btn btn-danger rgfac">Régler ma facture</button> -->
                        <button class="buy btn btn-danger" onclick="callpaytech(this)" data-item-id="{{ trim($value->order_number) }}-{{$value->amount}}" >Régler ma facture
                                          </button>
                      @endif
                    <br />
                    <br />

              </div>

            @endif

          @endif

          <script>
            var screen_width = $(window).width();
            var slider_width = 800;
            var step_def = 1;
            if(screen_width <= 480 && screen_width > 320){
              slider_width = 330;
              step_def = 0.2;
            }
            if(screen_width <= 1024 && screen_width > 768){
              slider_width = 680;
              step_def = 0.5;
            }
            $('.slider-input').jRange({
                from: 1,
                to: 12,
                step: step_def,
                scale: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                format: '%s',
                width: slider_width,
                showLabels: false,
                snap: true
            });
          </script>
          <div>

          </div>
          <br />
        <form class="form-inline" action="{{ route('mes-factures.pdf_buy')}}" method="GET">
            {{csrf_field()}}
            <!-- if prepaid client-->
            @if($actived_services->{$mapping_type_services[$_SESSION['current_service']]} == 'prepaid' and (!empty($data) and $data != NULL) and (!empty($user->date_verify_email) or strpos($user->email,"user") === 0 or strpos($user->email,"stat") === 0))
              <div class="col-md-4 col-md-offset-4 ticket  rowContentMobile" style="text-align:center;">
                <div class="large-main-panel" style="background-color:#fff;">
                  <div>
                    <i class="fas fa-paperclip fa-3x" style="margin-right:98%;margin-top: -200px;"></i>
                    <br/>
                    <span class="tl_fac"> Reçu du {{$last_row_data['creation_date']}} &nbsp;</span>
                    <span class=" status_j glyphicon glyphicon-ok-circle text-success">Payée</span>

                    <br />
                    <br />
                    <span class="amount_j" style="font-size:30px"> {{$last_row_data['amount']}} FCFA</span>
                    <br />
                    <br />
                    <hr>
                    <p class="tl_echeance"><strong> Achat du {{$last_row_data['creation_date']}} </strong></p>
                    <span class="tl_paiement" style="font-size:10px"> paiement effectué le @php echo $last_row_data['creation_date'] @endphp </span>

                    <br />
                    <br />
                    <div class="row">
                        <!--<button class="btn" style="background-color:rgba(137,180,213,1);color:#fff"> Envoyer par mail </button>-->
                        <button type="submit" target='_blank' class="btn" style="background-color:rgba(137,180,213,1);color:#fff"> Télécharger</button>
                        <input type="hidden" name="id_buy" value="{{$last_row_data['id']}}" />
                        <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
                    </div>
                    <br />
                    <br />
                  </div>

                </div>

              </div>
            @endif
          </form>
            </div>
          <br />
          <br />

          @if(!empty($last_row_data) and !empty($user->date_verify_email))
          <div class="modal fade" id="pay_bill" tabindex="-1" role="dialog" style="z-index:1300;overflow-x: hidden;overflow-y: auto;" aria-labelledby="pay_bill_title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 style="text-align:center" class="modal-title" id="pay_bill_title"><strong>Régler votre facture</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active buycb" id="cb" href="#paiement">Carte Bancaire</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" class="close buyom" data-dismiss="modal" data-toggle="modal" data-target="#om" href="#paiement">OrangeMoney</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" class="close buyfc" data-dismiss="modal" data-toggle="modal" data-target="#fc" href="#paiement">FreeCash</a>
                  </li>
                </ul>

                <div class="row">
                    <div class="col-xs-12 col-md-8">


                    <!-- CREDIT CARD FORM STARTS HERE -->
                    <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table" >
                    <div class="row display-tr" >

                    <h3 class="panel-title display-td" > Details de paiement par CB</h3>
                    <div class="display-td" >
                    <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">
                    </div>
                    </div>
                    </div>
                    <div class="panel-body">
                    <form method="post" action="../mes-factures/{{ $_SESSION['current_service'] }}/pay">
                      {{ csrf_field() }}
                    <div class="row">
                    <div class="col-xs-12">
                    <div class="form-group">
                    <label for="cardNumber">CARD NUMBER</label>
                    <div class="input-group">
                    <input
                    pattern="(?:4[0-9]{12}(?:[0-9]{3})?)"
                    title="le numéro de carte bancaire n'est pas valide."
                    class="form-control cardNumber"
                    name="cardNumber"
                    placeholder="Valid Card Number"
                    autocomplete="cc-number"
                    required
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
                    pattern="(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})"
                    title="la date d'expiration n'est pas valide."
                    class="form-control cardExpiry"
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
                    pattern="[0-9]{3}"
                    title="le cv code n'est pas valide."
                    class="form-control cardCVC"
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
                      @if(!empty($last_row_data))
                        <?php $amount = (Auth::user()->user_type == 2) ? $last_row_data['amount'] : $last_row_data->amount; ?>
                        <?php $id_bill = (Auth::user()->user_type == 2) ? $last_row_data['id'] : $last_row_data->id; ?>
                        <?php $order_number = (Auth::user()->user_type == 2) ? 'n/a' : $last_row_data->order_number; ?>
                      @endif
                      @if($last_row_data == NULL)
                      <?php $amount = 0;
                            $id_bill = 0;
                            $order_number = 0;
                      ?>
                      @endif
                    <button class="btn btn-success btn-lg btn-block" type="submit">Payez {{ $amount }} fcfa

                    </button>
                    </div>
                    </div>
                    <div class="row" style="display:none;">
                    <div class="col-xs-12">
                    <p class="payment-errors"></p>
                    </div>
                    </div>
                    <input type="hidden" name="payment_method" value="CB" />
                    <input type="hidden" name="payment_amount" value="{{ $amount }}" />
                    <input type="hidden" name="order_number" value="{{ $order_number }}" />
                    <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
                    <input type="hidden" name='id_bill' value="{{ (!empty($id_bill)) ? $id_bill : '0' }}" />
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}" />
                    <input type="hidden" name="first_name" value="{{ Auth::user()->first_name }}" />
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
                    </form>
                    </div>
                    </div>
                    <!-- CREDIT CARD FORM ENDS HERE -->


                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        @endif

        @if(!empty($last_row_data) and !empty($user->date_verify_email))
        <div class="modal fade" id="om" tabindex="-1" style="overflow-x: hidden;overflow-y: auto;z-index:1300;" role="dialog" aria-labelledby="om_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 style="text-align:center" class="modal-title" id="om_title"><strong>Régler votre facture</strong></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" class="close buycb" data-dismiss="modal" data-toggle="modal" data-target="#pay_bill" href="#paiement">Carte Bancaire</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active buyom" data-target="#om" href="#paiement">OrangeMoney</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" class="close buyfc" data-dismiss="modal" data-toggle="modal" data-target="#fc" href="#paiement">FreeCash</a>
                </li>
              </ul>

              <div class="row">
                  <div class="col-xs-12 col-md-8">


                  <!-- CREDIT CARD FORM STARTS HERE -->
                  <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                    <h3 class="panel-title display-td" > Details de paiement OrangeMoney</h3>
                    <div class="display-td">
                      <img class="img-responsive pull-right" src="{{ asset('images/om_1.png') }}" width="75" height="75">
                    </div>
                    </div>
                    </div>
                    <div class="panel-body">
                      <div class="container">
                        <div class="row">
                        <!-- You can make it whatever width you want. I'm making it full width
                        on <= small devices and 4/12 page width on >= medium devices -->
                        <div class="col-xs-12 col-md-3">


                        <!-- CREDIT CARD FORM STARTS HERE -->
                        <div class="panel panel-default credit-card-box">

                        <div class="panel-body">
                        <form method="post" action="../mes-factures/{{ $_SESSION['current_service'] }}/pay">
                          {{ csrf_field() }}
                        <div class="row">
                        <div class="col-xs-12">
                        <div class="form-group">
                        <label for="phoneNumber">MOBILE PHONE NUMBER*</label>
                        <div class="input-group">
                        <input
                        pattern="(\+[1-9]{1}[0-9]{3,14}) |([0-9]{9,14})"
                        title="le numéro de téléphone n'est pas valide."
                        class="form-control phoneNumber"
                        name="phoneNumber"
                        placeholder="Valid mobile phone number"
                        autocomplete="cc-number"
                        required
                        />
                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                        </div>
                        </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-xs-12">
                        <div class="form-group">
                        <label for="paymentCode">PAYMENT CODE*</label>
                        <input pattern="[0-9]{4}" title="le code de paiement n'est pas valide." class="form-control paymentCode" name="paymentCode" required/>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-12">
                        <button class="btn btn-lg btn-block" type="submit" style="background-color:#FE9A2E;color:black">Payez {{ $amount }} fcfa
                        </button>
                        </div>
                        </div>
                        <div class="row" style="display:none;">
                        <div class="col-xs-12">
                        <p class="payment-errors"></p>
                        </div>
                        </div>
                        <input type="hidden" name="payment_method" value="OrangeMoney" />
                        <input type="hidden" name="payment_amount" value="{{ $amount }}" />
                        <input type="hidden" name="order_number" value="{{ $order_number }}" />
                        <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
                        <input type="hidden" name='id_bill' value="{{ (!empty($id_bill)) ? $id_bill : '0' }}" />
                        <input type="hidden" name="email" value="{{ Auth::user()->email }}" />
                        <input type="hidden" name="first_name" value="{{ Auth::user()->first_name }}" />
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
                        </form>
                        </div>
                        </div>
                        <!-- CREDIT CARD FORM ENDS HERE -->


                        </div>



                        </div>
                        </div>
                    </div>

                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

      @if(!empty($last_row_data) and !empty($user->date_verify_email))
      <div class="modal fade" id="fc" tabindex="-1" style="overflow-x: hidden;overflow-y: auto;z-index:1300;" role="dialog" aria-labelledby="fc_title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 style="text-align:center" class="modal-title" id="fc_title"><strong>Régler votre facture</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link" class="close buycb" data-dismiss="modal" data-target="#pay_bill" href="#paiement">Carte Bancaire</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" class="close buyom" data-dismiss="modal" data-toggle="modal" data-target="#om" href="#paiement">OrangeMoney</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active buyfc"  data-target="#fc" href="#paiement">FreeCash</a>
              </li>
            </ul>

            <div class="row">
                <div class="col-xs-12 col-md-8">


                <!-- CREDIT CARD FORM STARTS HERE -->
                <div class="panel panel-default credit-card-box">
                  <div class="panel-heading display-table" >
                  <div class="row display-tr" >
                  <h3 class="panel-title display-td" > Details de paiement FreeCash</h3>
                  <div class="display-td">
                    <img class="img-responsive pull-right" src="{{ asset('images/free.png') }}" width="75" height="75">
                  </div>
                  </div>
                  </div>
                  <div class="panel-body">
                    <div class="container">
                      <div class="row">
                      <!-- You can make it whatever width you want. I'm making it full width
                      on <= small devices and 4/12 page width on >= medium devices -->
                      <div class="col-xs-12 col-md-3">


                      <!-- CREDIT CARD FORM STARTS HERE -->
                      <div class="panel panel-default credit-card-box">

                      <div class="panel-body">
                      <form method="post" action="../mes-factures/{{ $_SESSION['current_service'] }}/pay">
                        {{ csrf_field() }}
                      <div class="row">
                      <div class="col-xs-12">
                      <div class="form-group">
                      <label for="phoneNumber">MOBILE PHONE NUMBER*</label>
                      <div class="input-group">
                      <input
                      pattern="(\+[1-9]{1}[0-9]{3,14}) |([0-9]{9,14})"
                      title="le numéro de téléphone n'est pas valide."
                      class="form-control phoneNumber"
                      name="phoneNumber"
                      placeholder="Valid mobile phone number"
                      autocomplete="cc-number"
                      required
                      />
                      <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                      </div>
                      </div>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-xs-12">
                      <div class="form-group">
                      <label for="paymentCode">PAYMENT CODE*</label>
                      <input pattern="[0-9]{4}" title="le code de paiement n'est pas valide." class="form-control paymentCode" name="paymentCode" required/>
                      </div>
                      </div>
                      </div>
                      <div class="row">
                      <div class="col-xs-12">
                      <button class="btn btn-lg btn-block" type="submit" style="background-color:#FE2E2E;color:white">Payez {{ $amount }} fcfa
                      </button>
                      </div>
                      </div>
                      <div class="row" style="display:none;">
                      <div class="col-xs-12">
                      <p class="payment-errors"></p>
                      </div>
                      </div>
                      <input type="hidden" name="payment_method" value="FreeCash" />
                      <input type="hidden" name="payment_amount" value="{{ $amount }}" />
                      <input type="hidden" name="order_number" value="{{ $order_number }}" />
                      <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
                      <input type="hidden" name='id_bill' value="{{ (!empty($id_bill)) ? $id_bill : '0' }}" />
                      <input type="hidden" name="email" value="{{ Auth::user()->email }}" />
                      <input type="hidden" name="first_name" value="{{ Auth::user()->first_name }}" />
                      <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
                      </form>
                      </div>
                      </div>
                      <!-- CREDIT CARD FORM ENDS HERE -->


                      </div>



                      </div>
                      </div>
                  </div>

                </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endif

<div class="modal fade" id="buy_card" tabindex="-1" style="overflow-x: hidden;overflow-y: auto;z-index:1300;" role="dialog" aria-labelledby="buy_card_title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buy_card_title" style="text-align:center"><strong>Acheter une carte de recharge</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="recharge-box">
          <div class="title-card" style="font-size:14px">
            <strong>Choix de la recharge</strong>
            <hr>
            <br />
          </div>
          <div class="content products-list" style="border:1px solid black;">
            <br/>
            <div class="row">
              <div class="col-md-3 col-md-offset-1" style="border:1px solid black;height:200px;">
                <p style="font-size:10px">5000 fcfa</p>
                <br />
                <a data-dismiss="modal" data-toggle="modal" data-target="#recharge_1" href="#recharge">
                  <img src="{{ asset('images/prepaid_card_5000.png') }}" srcset="{{ asset('images/prepaid_card_5000.png') }} 2x" alt="eLECTRA Max 5€" width="114" height="150">
                </a>
                <br />
              </div>
              <div class="col-md-3" style="border:1px solid black;margin-left:15px;height:200px;">
                <p style="font-size:10px">10000 fcfa</p>
                <br />
                <a data-dismiss="modal" data-toggle="modal" data-toggle="modal" data-target="#recharge_2" href="#recharge">
                  <img src="{{ asset('images/prepaid_card_10000.png') }}" srcset="{{ asset('images/prepaid_card_10000.png') }} 2x" alt="eLECTRA Max 10€" width="114" height="150">
                </a>
                  <br />
              </div>
              <div class="col-md-3" style="border:1px solid black;margin-left:15px;height:200px;">
                <p style="font-size:10px">15000 fcfa</p>
                <br />
                <a data-dismiss="modal" data-toggle="modal" data-toggle="modal" data-target="#recharge_3" href="#recharge">
                  <img src="{{ asset('images/prepaid_card_15000.png') }}" srcset="{{ asset('images/prepaid_card_15000.png') }} 2x" alt="eLECTRA Max 20€" width="114" height="150">
                </a>
                  <br />
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-3 col-md-offset-1" style="border:1px solid black;height:200px;">
                <p style="font-size:10px">25000 fcfa</p>
                <br />
                <a  data-dismiss="modal" data-toggle="modal" data-toggle="modal" data-target="#recharge_4" href="#recharge">
                  <img src="{{ asset('images/prepaid_card_25000.png') }}" srcset="{{ asset('images/prepaid_card_25000.png') }} 2x" alt="Mobicarte Max 30€" width="114" height="150">                <br />
                </a>
              </div>
              <div class="col-md-3" style="border:1px solid black;margin-left:15px;height:200px;">
                <p style="font-size:10px">35000 fcfa</p>
                <br />
                <a  data-dismiss="modal" data-toggle="modal" data-toggle="modal" data-target="#recharge_5" href="#recharge">
                  <img src="{{ asset('images/prepaid_card_35000.png') }}" srcset="{{ asset('images/prepaid_card_35000.png') }} 2x" alt="mobicarte monde 15" width="114" height="150">                  <br />
                </a>
              </div>
              <div class="col-md-3" style="border:1px solid black;margin-left:15px;height:200px;">
                <p style="font-size:10px">50000 fcfa</p>
                <br />
                <a  data-dismiss="modal" data-toggle="modal" data-target="#recharge_6" href="#recharge">
                  <img src="{{ asset('images/prepaid_card_50000.png') }}" srcset="{{ asset('images/prepaid_card_50000.png') }} 2x" alt="mobicarte monde 15" width="114" height="150">                  <br />
                </a>
              </div>
            </div>
            <br/>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>
@php
$length = 7;
$i=1;
while($i<$length){ @endphp
  <div class="modal fade" id="recharge_{{ $i }}" style="overflow-x: hidden;overflow-y: auto;z-index:1300;" tabindex="-1" role="dialog" aria-labelledby="recharge_{{ $i }}_title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recharge_{{ $i }}_title" style="text-align:center"><strong>Recharge de {{$i * 5000}} fcfa</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="recharge-box">
          <div class="title-card" style="font-size:14px">
            <strong>Choix de la recharge</strong>
            <hr>
            <br />
          </div>

          @if($i == 1)
            <div class="content row">
              <div class="col-md-6">
                <img id="image" alt="eLECTRA 5000 fcfa" title="eLECTRA 5000 fcfa" src="{{ asset('images/prepaid_card_5000.png') }}" srcset="{{ asset('images/prepaid_card_5000.png') }} 2x">
              </div>
              <div class="col-md-6 product-details">
                <div class="panel panel-info">
                  <div class="panel-heading" style="font-size:15px">Carte de recharge <strong>prépayée eLECTRA </strong>, Sénégal.<br /> <strong>Valable</strong> chez tous nos partenaires.</div>
                  <div class="panel-body"><strong>Contenu :</strong> 5000 fcfa de recharge utilisable chez tous nos partenaires (Senelec, SDE, Canal+...)<br><strong>Durée de validité :</strong> Illimitée</div>
                </div>
                <br />
              </div>
            </div>
          @endif
          @if($i == 2)
            <div class="content row">
              <div class="col-md-6">
                <img id="image" alt="Mobicarte Max 10€" title="Mobicarte Max 10€" src="{{ asset('images/prepaid_card_10000.png') }}" srcset="{{ asset('images/prepaid_card_10000.png') }} 2x">
              </div>
              <div class="col-md-6 product-details">
                <div class="panel panel-info">
                  <div class="panel-heading" style="font-size:15px">Carte de recharge <strong>prépayée eLECTRA </strong>, Sénégal.<br /> <strong>Valable</strong> chez tous nos partenaires.</div>
                  <div class="panel-body"><strong>Contenu :</strong> 10000 fcfa de recharge utilisable chez tous nos partenaires (Senelec, SDE, Canal+...)<br><strong>Durée de validité :</strong> Illimitée</div>
                </div>
                <br />
              </div>
            </div>
          @endif
          @if($i == 3)
              <div class="content row">
                <div class="col-md-6">
                  <img id="image" alt="Mobicarte Max 20€" title="Mobicarte Max 20€" src="{{ asset('images/prepaid_card_15000.png') }}" srcset="{{ asset('images/prepaid_card_15000.png') }} 2x">
                </div>
                <div class="col-md-6 product-details">
                  <div class="panel panel-info">
                    <div class="panel-heading" style="font-size:15px">Carte de recharge <strong>prépayée eLECTRA </strong>, Sénégal.<br /> <strong>Valable</strong> chez tous nos partenaires.</div>
                    <div class="panel-body"><strong>Contenu :</strong> 15000 fcfa de recharge utilisable chez tous nos partenaires (Senelec, SDE, Canal+...)<br><strong>Durée de validité :</strong> Illimitée</div>
                  </div>
                  <br />
                </div>
              </div>
          @endif
          @if($i == 4)
            <div class="content row">
              <div class="col-md-6">
                <img id="image" alt="mobicarte 25€" title="mobicarte 25€" src="{{ asset('images/prepaid_card_25000.png') }}" srcset="{{ asset('images/prepaid_card_25000.png') }} 2x">
              </div>
              <div class="col-md-6 product-details">
                <div class="panel panel-info">
                  <div class="panel-heading" style="font-size:15px">Carte de recharge <strong>prépayée eLECTRA </strong>, Sénégal.<br /> <strong>Valable</strong> chez tous nos partenaires.</div>
                  <div class="panel-body"><strong>Contenu :</strong> 25000 fcfa de recharge utilisable chez tous nos partenaires (Senelec, SDE, Canal+...)<br><strong>Durée de validité :</strong> Illimitée</div>
                </div>
                <br />
              </div>
            </div>
          @endif
          @if($i == 5)
            <div class="content row">
              <div class="col-md-6">
                <img id="image" alt="Mobicarte Max 30€" title="Mobicarte Max 30€" src="{{ asset('images/prepaid_card_35000.png') }}" srcset="{{ asset('images/prepaid_card_35000.png') }} 2x">
              </div>
              <div class="col-md-6 product-details">
                <div class="panel panel-info">
                  <div class="panel-heading" style="font-size:15px">Carte de recharge <strong>prépayée eLECTRA </strong>, Sénégal.<br /> <strong>Valable</strong> chez tous nos partenaires.</div>
                  <div class="panel-body"><strong>Contenu :</strong> 35000 fcfa de recharge utilisable chez tous nos partenaires (Senelec, SDE, Canal+...)<br><strong>Durée de validité :</strong> Illimitée</div>
                </div>
                <br />
              </div>
            </div>
          @endif
          @if($i == 6)
            <div class="content row">
              <div class="col-md-6">
                <img id="image" alt="Mobicarte 50€ + 20€ de crédit offert" title="Mobicarte 50€ + 20€ de crédit offert" src="{{ asset('images/prepaid_card_50000.png') }}" srcset="{{ asset('images/prepaid_card_50000.png') }} 2x">
              </div>
              <div class="col-md-6 product-details">
                <div class="panel panel-info">
                  <div class="panel-heading" style="font-size:15px">Carte de recharge <strong>prépayée eLECTRA </strong>, Sénégal.<br /> <strong>Valable</strong> chez tous nos partenaires.</div>
                  <div class="panel-body"><strong>Contenu :</strong> 50000 fcfa de recharge utilisable chez tous nos partenaires (Senelec, SDE, Canal+...)<br><strong>Durée de validité :</strong> Illimitée</div>
                </div>
                <br />
              </div>
            </div>
          @endif
          <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
        </form>

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button data-dismiss="modal" data-toggle="modal" data-toggle="modal" data-target="#last_buy_step_{{ $i }}" type="button" class="btn btn-primary rchrg">Acheter</button>
      </div>
    </div>
  </div>
  </div>

@php
$t = $i;
$limit = 6;
if($i == 4){
  $t = $i + 1;
}
if($i == 5){
  $t = $i + 2;
}

if($i == $limit){
  $t = $i + 4;
}
@endphp
    <div class="modal fade" id="last_buy_step_{{ $i }}" style="overflow-x: hidden;overflow-y: auto;z-index:1300;" tabindex="-1" role="dialog" aria-labelledby="last_buy_step_{{ $i }}_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="text-align:center" class="modal-title" id="last_buy_step_{{ $i }}_title"><strong>Acheter votre carte de recharge</strong></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active buycb" id="cb_buy_{{ $i }}" href="#paiement">Carte Bancaire</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" class="close buyom" data-dismiss="modal" data-toggle="modal" data-target="#om_buy_{{ $i }}" href="#paiement">OrangeMoney</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" class="close buyfc" data-dismiss="modal" data-toggle="modal" data-target="#fc_buy_{{ $i }}" href="#paiement">FreeCash</a>
            </li>
          </ul>

          <div class="row">
              <div class="col-xs-12 col-md-8">


              <!-- CREDIT CARD FORM STARTS HERE -->
              <div class="panel panel-default credit-card-box">
              <div class="panel-heading display-table" >
              <div class="row display-tr" >

              <h3 class="panel-title display-td" > Details de paiement par CB</h3>
              <div class="display-td" >
              <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">
              </div>
              </div>
              </div>
              <div class="panel-body">
              <form method="post" action="../mes-factures/{{ $_SESSION['current_service'] }}/buy">
                {{ csrf_field() }}
              <div class="row">
              <div class="col-xs-12">
              <div class="form-group">
              <label for="cardNumber">CARD NUMBER</label>
              <div class="input-group">
              <input
              pattern="(?:4[0-9]{12}(?:[0-9]{3})?)"
              title="le numéro de carte bancaire n'est pas valide."
              class="form-control cardNumber"
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
              pattern="(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})"
              title="la date d'expiration n'est pas valide."
              class="form-control cardExpiry"
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
              pattern="[0-9]{3}"
              title="le cv code n'est pas valide."
              class="form-control cardCVC"
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
              <button class="btn btn-success btn-lg btn-block paycb" type="submit">Payez {{ $t * 5000}} fcfa

              </button>
              </div>
              </div>
              <div class="row" style="display:none;">
              <div class="col-xs-12">
              <p class="payment-errors"></p>
              </div>
              </div>
              <input type="hidden" name="montant_recharge" value="{{ $t * 5000}}" />
              <input type="hidden" name="payment_method" value="CB" />
              <input type="hidden" name="payment_amount" value="{{ $t * 5000}}" />
              <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
              <input type="hidden" name='id_bill' value="{{ (!empty($id_bill)) ? $id_bill : '0' }}" />
              <input type="hidden" name="email" value="{{ Auth::user()->email }}" />
              <input type="hidden" name="first_name" value="{{ Auth::user()->first_name }}" />
              <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
              </form>
              </div>
              </div>
              <!-- CREDIT CARD FORM ENDS HERE -->


              </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="om_buy_{{ $i }}" style="overflow-x: hidden;overflow-y: auto;z-index:1300;" tabindex="-1" role="dialog" aria-labelledby="om_buy_{{ $i }}_title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 style="text-align:center" class="modal-title" id="om_buy_{{ $i }}_title"><strong>Régler votre facture</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" class="close buycb" data-dismiss="modal" data-toggle="modal" data-target="#last_buy_step_{{ $i }}" href="#paiement">Carte Bancaire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active buyom" data-target="#om_buy_{{ $i }}" href="#paiement">OrangeMoney</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" class="close buyfc" data-dismiss="modal" data-toggle="modal" data-target="#fc_buy_{{ $i }}" href="#paiement">FreeCash</a>
          </li>
        </ul>
        <form method="post" action="../mes-factures/{{ $_SESSION['current_service'] }}/buy">
          {{ csrf_field() }}

        <div class="row">
            <div class="col-xs-12 col-md-8">


            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
              <div class="panel-heading display-table" >
              <div class="row display-tr" >
              <h3 class="panel-title display-td" > Details de paiement OrangeMoney</h3>
              <div class="display-td">
                <img class="img-responsive pull-right" src="{{ asset('images/om_1.png') }}" width="75" height="75">
              </div>
              </div>
              </div>
              <div class="panel-body">
                <div class="container">
                  <div class="row">
                  <!-- You can make it whatever width you want. I'm making it full width
                  on <= small devices and 4/12 page width on >= medium devices -->
                  <div class="col-xs-12 col-md-3">


                  <!-- CREDIT CARD FORM STARTS HERE -->
                  <div class="panel panel-default credit-card-box">

                  <div class="panel-body">

                  <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group">
                  <label for="phoneNumber">MOBILE PHONE NUMBER*</label>
                  <div class="input-group">
                  <input
                  pattern="(\+[1-9]{1}[0-9]{3,14}) |([0-9]{9,14})"
                  title="le numéro de téléphone n'est pas valide."
                  class="form-control phoneNumber"
                  name="phoneNumber"
                  placeholder="Valid mobile phone number"
                  autocomplete="cc-number"
                  required
                  />
                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                  </div>
                  </div>
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group">
                  <label for="paymentCode">PAYMENT CODE*</label>
                  <input pattern="[0-9]{4}" title="le code de paiement n'est pas valide." class="form-control paymentCode" name="paymentCode" required/>
                  </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-xs-12">
                  <button class="btn btn-lg btn-block" type="submit" style="background-color:#FE9A2E;color:black">Payez {{ $t * 5000}} fcfa
                  </button>
                  </div>
                  </div>
                  <div class="row" style="display:none;">
                  <div class="col-xs-12">
                  <p class="payment-errors"></p>
                  </div>
                  </div>

                <input type="hidden" name="montant_recharge" value="{{ $t * 5000}}" />
                <input type="hidden" name="payment_method" value="OrangeMoney" />
                <input type="hidden" name="payment_amount" value="{{ $t * 5000}}" />
                <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
                <input type="hidden" name='id_bill' value="{{ (!empty($id_bill)) ? $id_bill : '0' }}" />
                <input type="hidden" name="email" value="{{ Auth::user()->email }}" />
                <input type="hidden" name="first_name" value="{{ Auth::user()->first_name }}" />
                <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
                </form>
                  </div>
                  </div>
                  <!-- CREDIT CARD FORM ENDS HERE -->


                  </div>



                  </div>
                  </div>
              </div>

            </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>

  <div class="modal fade" id="fc_buy_{{ $i }}" style="overflow-x: hidden;overflow-y: auto;z-index:1300;" tabindex="-1" role="dialog" aria-labelledby="fc_buy_{{ $i }}_title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 style="text-align:center" class="modal-title" id="fc_buy_{{ $i }}_title"><strong>Régler votre facture</strong></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" class="close buycb" data-dismiss="modal" data-target="#last_buy_step_{{ $i }}" href="#paiement">Carte Bancaire</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" class="close buyom" data-dismiss="modal" data-toggle="modal" data-target="#om_buy_{{ $i }}" href="#paiement">OrangeMoney</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active buyfc"  data-target="#fc_buy_{{ $i }}" href="#paiement">FreeCash</a>
        </li>
      </ul>

      <form method="post" action="../mes-factures/{{ $_SESSION['current_service'] }}/buy">
        {{ csrf_field() }}

      <div class="row">
          <div class="col-xs-12 col-md-8">


          <!-- CREDIT CARD FORM STARTS HERE -->
          <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table" >
            <div class="row display-tr" >
            <h3 class="panel-title display-td" > Details de paiement FreeCash</h3>
            <div class="display-td">
              <img class="img-responsive pull-right" src="{{ asset('images/free.png') }}" width="75" height="75">
            </div>
            </div>
            </div>
            <div class="panel-body">
              <div class="container">
                <div class="row">
                <!-- You can make it whatever width you want. I'm making it full width
                on <= small devices and 4/12 page width on >= medium devices -->
                <div class="col-xs-12 col-md-3">


                <!-- CREDIT CARD FORM STARTS HERE -->
                <div class="panel panel-default credit-card-box">

                <div class="panel-body">
                <div class="row">
                <div class="col-xs-12">
                <div class="form-group">
                <label for="phoneNumber">MOBILE PHONE NUMBER*</label>
                <div class="input-group">
                <input
                pattern="(\+[1-9]{1}[0-9]{3,14}) |([0-9]{9,14})"
                title="le numéro de téléphone n'est pas valide."
                class="form-control phoneNumber"
                name="phoneNumber"
                placeholder="Valid mobile phone number"
                autocomplete="cc-number"
                required
                />
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                </div>
                </div>
                </div>
                </div>

                <div class="row">
                <div class="col-xs-12">
                <div class="form-group">
                <label for="paymentCode">PAYMENT CODE*</label>
                <input pattern="[0-9]{4}" title="le code paiement n'est pas valide." class="form-control paymentCode" name="paymentCode" required/>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-xs-12">
                <button class="btn btn-lg btn-block" type="submit" style="background-color:#FE2E2E;color:white">Payez {{ $t * 5000}} fcfa
                </button>
                </div>
                </div>
                <div class="row" style="display:none;">
                <div class="col-xs-12">
                <p class="payment-errors"></p>
                </div>
                </div>
                <input type="hidden" name="montant_recharge" value="{{ $t * 5000}}" />
                <input type="hidden" name="payment_method" value="FreeCash" />
                <input type="hidden" name="payment_amount" value="{{ $t * 5000}}" />
                <input type="hidden" name="service" value="{{ $_SESSION['current_service'] }}"/>
                <input type="hidden" name='id_bill' value="{{ (!empty($id_bill)) ? $id_bill : '0' }}" />
                <input type="hidden" name="email" value="{{ Auth::user()->email }}" />
                <input type="hidden" name="first_name" value="{{ Auth::user()->first_name }}" />
                <input type="hidden" name="name" value="{{ Auth::user()->name }}" />
                </form>
                </div>
                </div>
                <!-- CREDIT CARD FORM ENDS HERE -->


                </div>



                </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

</div>
@php $i++; } @endphp
@endsection
@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.material.min.js"></script>
<!-- <script src="https://paydunya.com/assets/psr/js/psr.paydunya.min.js"></script> -->
<script>

$(document).ready(function() {
    $('#regler').click(function(){
      var theClass = this.className;
      var classList = theClass.split('_');
      var pd_id_bill = classList[1];
      if (!window.location.href.split('?')[0].endsWith("/"))
        window.location.href = window.location.href.split('?')[0] + "/payviaPD?"  + pd_id_bill;
      else
        window.location.href = window.location.href.split('?')[0] + "payviaPD?"  + pd_id_bill;

    });

    $('#regler1').click(function(){

        PayDunya.setup({
            selector: $('#regler1'),
            url: "https://localhost:8000/mes-factures/tv/paydunya-api",
            method: "GET",
            displayMode: PayDunya.DISPLAY_IN_POPUP,
            beforeRequest: function() {
                console.log("About to get a token and the url");
            },
            onSuccess: function(token) {
                console.log("Token: " +  token);
            },
            onTerminate: function(ref, token, status) {
                console.log(ref);
                console.log(token);
                console.log(status);
            },
            onError: function (error) {
                alert("Unknown Error ==> ", error.toString());
            },
            onUnsuccessfulResponse: function (jsonResponse) {
                console.log("Unsuccessful response ==> " + jsonResponse);
            },
            onClose: function() {
                console.log("Close");
            }
        }).requestToken();
    });
} );
$(document).ready(function() {
    $('#billsTable').DataTable( {
        autoWidth: true,
        columnDefs: [
            {
                targets: [ 4 ],
                className: 'mdc-data-table__cell'
            }
        ],
        "paging":   true,
        "lengthChange": false,
        "pageLength": 5,
        "info":     false,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
        }
    } );
} );

$(document).ready(function() {
    $('#buysTable').DataTable( {
        autoWidth: true,
        columnDefs: [
            {
                targets: ['_all'],
                className: 'mdc-data-table__cell'
            }
        ],
        "paging":   true,
        "lengthChange": false,
        "pageLength": 5,
        "info":     false,
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
        }
    } );

} );

$(document).ready(function() {

    $('.clickbtn').click(function() {
      var recup_id = $('.recup_id').val();
      if($(this).hasClass( "fa-chevron-circle-down")){
        $(this).removeClass("fa-chevron-circle-down");
        $(this).addClass("fa-chevron-circle-up");
      }
      else{
        $(this).removeClass("fa-chevron-circle-up");
        $(this).addClass("fa-chevron-circle-down");
      }
  });

  $('.picker').click(function(){
    var month_value = $('.slider-input').val();
    var months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    var tag_month = months[Math.round(month_value) - 1];
    var ech_value = $('#'+tag_month).html();
    var montant_value = $('#'+tag_month+"_amount").html();
    var status_value = $('#'+tag_month+"_status").html();
    var year_value = $('.'+tag_month+"_year_j").val();
    var creation_date_value = $('.'+tag_month+"_creation_date_j").val();

    if(typeof status_value === "undefined"){
      status_value = 'vide';

    }

    if(status_value.includes('paid') || status_value.includes('payée')){
      $('.status_j').removeClass('glyphicon-remove-circle');
      $('.status_j').removeClass('text-danger');
      $('.status_j').addClass('glyphicon-ok-circle');
      $('.status_j').addClass('text-success');
      $('.tl_paiement').html('paiement effectué le '+creation_date_value);
      $('.status_j').html('payée');
    }
    else{
      $('.status_j').removeClass('glyphicon-ok-circle');
      $('.status_j').removeClass('text-success');
      $('.status_j').addClass('glyphicon-remove-circle');
      $('.status_j').addClass('text-danger');
      $('.tl_paiement').html('&Agrave; régler avant le '+creation_date_value);
      $('.status_j').html('En attente');
    }
    if(status_value == 'vide'){
      $('.tl_fac').html("<strong>Pas de facture pour le mois de "+tag_month+ "&nbsp;</strong>");
      $('.amount_j').html('');
      $('.status_j').html('');
      $('.tl_echeance').html("");
      $('.tl_paiement').html('');
      $('.rgmail, .rgfac, .rgdown').attr('disabled','disabled');
      $('.status_j').removeClass('glyphicon-ok-circle');
      $('.status_j').removeClass('text-success');
      $('.status_j').removeClass('glyphicon-remove-circle');
      $('.status_j').removeClass('text-danger');
    }
    else{
      $('.tl_fac').html("Facture du mois de "+tag_month+ "&nbsp;");
      $('.amount_j').html(montant_value);
      $('.tl_echeance').html("<strong>Echéance de "+tag_month+" "+year_value+"</strong>");
      $('.rgmail, .rgfac, .rgdown').removeAttr('disabled');
    }

  });

  $('.picker_2').click(function(){
    var month_value = $('.slider-input').val();
    var months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    var tag_month = months[Math.round(month_value) - 1];
    var ech_value = $('#'+tag_month).html();
    var montant_value = $('#'+tag_month+"_amount").html();
    var status_value = $('#'+tag_month+"_status").html();
    var year_value = $('.'+tag_month+"_year_j").val();
    var creation_date_value = $('.'+tag_month+"_creation_date_j").val();

    if(typeof status_value === "undefined"){
      status_value = 'vide';

    }

    if(status_value.includes('paid') || status_value.includes('payée')){
      $('.status_j').removeClass('glyphicon-remove-circle');
      $('.status_j').removeClass('text-danger');
      $('.status_j').addClass('glyphicon-ok-circle');
      $('.status_j').addClass('text-success');
      $('.tl_paiement').html('achat effectué le '+creation_date_value);
    }
    else{
      $('.status_j').removeClass('glyphicon-ok-circle');
      $('.status_j').removeClass('text-success');
      $('.status_j').addClass('glyphicon-remove-circle');
      $('.status_j').addClass('text-danger');
      $('.tl_paiement').html('&Agrave; régler avant le '+creation_date_value);
    }
    if(status_value == 'vide'){
      $('.tl_fac').html("<strong>Pas de reçu pour le mois de "+tag_month+ "&nbsp;</strong>");
      $('.amount_j').html('');
      $('.status_j').html('');
      $('.tl_echeance').html("");
      $('.tl_paiement').html('');
      $('.rgmail, .rgfac, .rgdown').attr('disabled','disabled');
      $('.status_j').removeClass('glyphicon-ok-circle');
      $('.status_j').removeClass('text-success');
      $('.status_j').removeClass('glyphicon-remove-circle');
      $('.status_j').removeClass('text-danger');
    }
    else{
      $('.tl_fac').html("Facture du mois de "+tag_month+ "&nbsp;");
      $('.amount_j').html(montant_value);
      $('.status_j').html('payée');
      $('.tl_echeance').html("<strong>Echéance de "+tag_month+" "+year_value+"</strong>");
      $('.rgmail, .rgfac, .rgdown').removeAttr('disabled');
    }

  });

});
</script>
<script src="https://paytech.sn/cdn/paytech.min.js"></script>
<script>
    function callpaytech(btn) {
      var idTransaction = pQuery(btn).attr('data-item-id');
        (new PayTech({
          idTransaction           :   idTransaction,
        })).withOption({
            requestTokenUrl           :   '/paytech',
            method              :   'POST',
            headers             :   {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Access-Control-Allow-Origin": "*",
                "Accept"          :    "text/html",
            },
            prensentationMode   :   PayTech.OPEN_IN_POPUP,
            willGetToken        :   function () {

            },
            didGetToken         : function (token, redirectUrl) {

            },
            didReceiveError: function (error) {

            },
            didReceiveNonSuccessResponse: function (jsonResponse) {

            }
        }).send();

        //.send params are optional
    }
</script>
<script> 
$('#ContactFormModal').modal('show');
</script>

@endsection
