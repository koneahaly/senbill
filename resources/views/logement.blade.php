<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>

@extends('layouts.app', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])
<link rel="stylesheet" type="text/css" href="{{url('vendor/select2/select2.min.css')}}">
 <link rel="stylesheet" type="text/css" href="{{url('css/utilForm.css')}}">
 <link rel="stylesheet" type="text/css" href="{{url('css/mainForm.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{url('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@section('content')
<div class="container">
<div class="row rowloc rowmobile" style="margin-top:14%;z-index: 800;">
  <div class="col-md-8" style="margin-top:10px;margin-bottom:20px;text-align:center;flex-basis:100%;max-width:100%;z-index: 800;">
   <h3><strong>Détails du logement {{ $infos_log->title }}</strong></h3>
  </div>
  </div>
  @if(session('message'))
<input  type='hidden' class="mess" value="{{ session('message') }}">
<script>

 $(document).ready(function() {
  var  mess= $('.mess').val();
  showAddPropertyNotif(mess);
  });

 </script>
@endif
<ul class="pager">
  <li class="previous"><a href="/rechercher-logement"><span aria-hidden="true">&laquo;</span> Previous</a></li>
</ul>
  <div class="panel panel-default" style="background-color: #f5f9fc;z-index: 800;">
    <div class="panel-body propPanelBody row">
    <div class="col-md-9">
<!-- Carousel wrapper -->
      <div id="carouselExampleIndicators" class="carousel slide" style="width:800" data-bs-ride="carousel">

        <!-- Indicators -->
        <div class="carousel-indicators">
          <?php
            for ($x = 0; $x < count($infos_img); $x++) {
              if($x == 0)
                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$x.'" class="active" aria-current="true" aria-label="Slide '.$x.'"></button>';
              else
                echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$x.'" aria-label="Slide '.$x.'"></button>';
            }
          ?>
        </div>
        
        <!-- The slideshow -->
        <div class="carousel-inner">
          <?php $y =0; ?>
          @foreach($infos_img as $info_img)
          @if($y == 0)
            <div class="carousel-item active">
              <img src="{{ $info_img->url }}" alt="Los Angeles" width="800" height="500">
            </div>
          @endif
          @if($y > 0)
            <div class="carousel-item">
              <img src="{{ $info_img->url }}" alt="Los Angeles" width="800" height="500">
            </div>
          @endif
          <?php $y++; ?>
          @endforeach
        </div>
        
        
        <!-- Left and right controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
<!-- Carousel wrapper -->

<br />
<span class="row" style="font-size:24;margin-left:1%"> <b> {{ $infos_log->title }} </b></span>
  <span class="row" style="font-size:24;margin-left:1%"> {{ ($infos_log->nb_rooms != 'maison' OR $infos_log->nb_rooms != 'studio') ? $infos_log->nb_rooms.' chambre(s)' : $infos_log->nb_rooms}} {{ ($infos_log->housing_type =='meuble') ? 'meublée' : 'non meublée' }} • {{ $infos_log->address }} </span>
  <span class="row" style="font-size:14;margin-left:1%">  {{ $infos_log->monthly_pm }} FCFA par mois</span>
  <span class="row" style="font-size:14;margin-left:1%">  {{ 'postée il y\'a '.Carbon\Carbon::parse($infos_log->created_at)->locale('fr')->diffForHumans(null, true) }} </span>
  <hr style="width:800" />
  <span class="row" style="font-size:20;margin-left:1%"> <b> Description </b></span>
  <br/>
  <span class="row" style="font-size:14;margin-left:1%;width:800">  {{ $infos_log->description }} FCFA par mois</span>
  <hr style="width:800" />
  <span class="row" style="font-size:20;margin-left:1%"> <b> Critères </b></span>
  <br />
  <div style="font-size:14;margin-left:0%" class="row">
      <div class="col-md-3"> <div class="row"> <i class="fas fa-home fa-2x "></i>&nbsp; {{ ($infos_log->nb_rooms =='maison') ? $infos_log->nb_rooms : 'appartement' }} </div> </div>
      <div class="col-md-3"><div class="row"> <i class="fas fa-couch fa-2x "></i>&nbsp; {{ ($infos_log->housing_type =='meuble') ? 'meublée' : 'non meublée' }} </div></div>
      <div class="col-md-3"><div class="row"> <i class="fas fa-chart-area fa-2x "> </i>&nbsp; Surface de 100 m2 </div></div>
  </div>
  <br />
  <div style="font-size:14;margin-left:0%" class="row">
      <div class="col-md-3"><div class="row"> <i class="fas fa-door-open fa-2x "> </i>&nbsp; {{ ($infos_log->nb_rooms !='maison') ? $infos_log->nb_rooms : 'non renseigné' }} </div></div>
      <div class="col-md-3"><div class="row"> <i class="fas fa-coins fa-2x "> </i>&nbsp; Charges comprises : Non </div></div>
  </div>
  <hr style="width:800" />
  <span class="row" style="font-size:20;margin-left:1%"> <b> Transports en commun </b></span>
  <br/>

  <iframe
  width="600"
  height="450"
  style="border:0"
  loading="lazy"
  allowfullscreen
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBK1lhFLXgX3IbSZegrgp4i2zjj0kyYkt4
    &q={{ str_replace(' ', '+', $infos_log->address) }}&zoom=14">
</iframe>

   </div>
   <div class="col-md-3">
    <div  class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header"> Annonceur</div>
    <br />
      <div class="card-body">
      <div class="profile-img">
        <a  title="Voir/gérer profil">
            <avatar name="profile-photo"  width="70" size="tiny" class="m-avatar">
              <!----> <!--Si civilité = homme alors -->
              @if($infos_pro->civilite == 'Mr')
                <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/icon-homme.png')}}">
              @endif
              @if($infos_pro->civilite == 'Mme')
                <img imageonload="" class="img-responsive s-image--loading_success" alt="avatar" src="{{url('images/icon-femme.png')}}">
              @endif
            </avatar>
        </a>
      </div>
        <h5 class="card-title"> {{ $infos_pro->first_name.' '.$infos_pro->name }}</h5>
        <br />
        <p class="card-text"></p>
        <input type="hidden" class="tel_hidden" name="tel_hidden" value="{{ $infos_pro->phone }}" />
        <div>
          <button type="button" data-toggle="modal" data-target="#ContactFormModal"class="btn btn-primary btn-sm btn-block w-auto"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Envoyer un message</button>
        </div>
        <br class="div_msg"/>
        <div class="div_show_tel">
          <button type="button" value="Voir le numéro" class="btn btn-secondary btn-sm btn-block show_tel"><span class="glyphicon glyphicon-earphone"></span>&nbsp;Voir le numéro</button>
        </div>
      </div>
    </div>
   </div>
   </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ContactFormModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <form class="form-horizontal" id="formcontact" role="form" method="post" action="{{ route('contact.email') }}">
            {{csrf_field()}}
              <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                  data-dismiss="modal">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Contacter l'annonceur
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
              <div class="form-group">
                <label  class="col-sm-2 control-label"
                          for="inputName">Nom Complet</label>
                <div class="col-sm-10">
                    <input id="client" name="client" type="name" class="form-control" 
                    placeholder="Votre nom complet..."/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"
                      for="inputEmail" >Email</label>
                  <div class="col-sm-10">
                      <input id="email" name="email" type="text" class="form-control"
                           placeholder="Votre adresse email..."/>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"
                      for="inputPhone" >Téléphone</label>
                <div class="col-sm-10">
                    <input id="phone" name="phone" type="tel" class="form-control"
                         placeholder="Votre numéro de téléphone..."/>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label"
                      for="inputMsg" >Message</label>
                <div class="col-sm-10">
                    <textarea id="msg" name="msg" rows="10" class="form-control" placeholder="Votre message..."></textarea>
                </div>
              </div>
              <input type="hidden" id="proprio" name="proprio" value="{{ $infos_pro->first_name }}" />
   
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                            Fermer
                </button>
                <button type="submit" id="sendcontactmail" class="btn btn-primary">
                    Envoyer
                </button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
  var tel_hidden = $('.tel_hidden').val();
  var btn_val = $('.show_tel').val();
  $('.caret').remove();
  console.log(btn_val);
  $('.div_show_tel').click(function(){
    $(this).remove();
    $("<button type='button' class='btn btn-secondary btn-sm btn-block'><span class='glyphicon glyphicon-earphone'></span>&nbsp;"+tel_hidden+"</button>").insertAfter('.div_msg');

  });

});
</script>

@endsection
