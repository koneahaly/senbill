@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center rowContentMobile">
        <div class="col col-md-8 col-md-offset-2  p-0 mt-3 mb-2">
          <div class="panel panel-default registerPanel" style="margin-top:85px;color:black;">
              <div class="panel-heading">Créez votre compte utilisateur</div>
              <div class="panel-body">
                <p class="text-center">Remplissez les champs pour aller aux étapes suivantes</p>
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">

                <form id="msform" class="form-horizontal" method="POST" action="{{ route('register') }}">
                      {{ csrf_field() }}
                    <!-- progressbar -->
                    <ul id="progressbar" class="text-center" >
                        <li class="active" id="account"><strong>Compte</strong></li>
                        <li id="personal"><strong>Personnel</strong></li>
                        <li id="payment"><strong>Services</strong></li>
                        <li id="confirm"><strong>Récapitulatif</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-9">
                                    <h2 class="fs-title">Informations de connexion</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_just_browsing_m0vg.png')}}" height="299px" width="318px" data-component="image">
                                </div>

                            </div>

                            @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresse mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control mail" value="{{ old('email') }}" name="email" placeholder="Adresse mail" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Mot de passe</label>

                                <div class="col-md-6">
                                    <input  id="password" type="password" value="{{ old('password') }}" class="form-control" name="password" placeholder="Mot de passe" required>
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirmation de mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmation du mot de passe" required>
                                    <span toggle="#password-confirm" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                </div>
                            </div>
                        </div>
                        <input type="button" name="next" class="next action-button sv_1" value="Suivant" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Informations personnelles</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_online_information_4ui6.png')}}" height="304px" width="318px" data-component="image">
                                </div>
                                <div class="col-5">
                                  <!--  <h2 class="steps">Step 2 - 4</h2>-->
                                </div>
                            </div>

                            <div class="row">
                                  <label for="exampleFormControlSelect1" class="col-md-4 control-label">CIVILITE</label>
                                  <div class="col-md-6">
                                    <select class="form-control" name="salutation" id="exampleFormControlSelect1">
                                      <option value="" disabled="disabled">--Votre civilité--</option>
                                      <option value="Mme" selected="selected">Madame</option>
                                      <option value="Mr">Monsieur</option>
                                    </select>
                                    <br />
                                </div>
                              </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Prénom</label>

                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Prénom" required >

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nom</label>

                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control name" name="name" value="{{ old('name') }}" placeholder="Nom" required >

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customerId" class="col-md-4 control-label">Numéro d'identification</label>

                                <div class="col-md-6">
                                    <input id="customerId" type="text" class="form-control cni" placeholder="CNI" name="customerId" required>
                                    @if ($errors->has('customerId'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('customerId') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                  <label for="exampleFormControlSelect1" class="col-md-4 control-label">PAYS</label>
                                  <div class="col-md-6">
                                    <select class="form-control" name="country" id="exampleFormControlSelect1">
                                      <option value="" disabled="disabled">--Votre pays--</option>
                                      <option value="sn">Sénégal</option>
                                      <option value="ci">Côte d'ivoire</option>
                                      <option value="fr">France</option>
                                    </select>
                                    <br />
                                </div>
                              </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Numéro de téléphone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="phone" class="form-control phone" name="phone" value="{{ old('phone') }}" placeholder="Numéro de téléphone" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Adresse de facturation</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control address" name="address" placeholder="Adresse" required>
                                </div>
                            </div>

                        </div>
                        <input type="button" name="next" class="next action-button sv_2" value="Suivant" /> <input type="button" name="previous" class="previous action-button-previous" value="Précédent" />
                    </fieldset>
                    <fieldset class="f3">
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Services</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_location_review_dmxd.png')}}" height="270px" width="318px" data-component="image">

                                </div>
                                <div class="col-5">
                                    <!-- <h2 class="steps">Step 3 - 4</h2> -->
                                </div>
                            </div>
                        </div>
                        <div class="radio-group row justify-content-between px-3" style="margin-left: -3px;">
                           <div class="card-block card-body selectRegister1" style="cursor:not-allowed;">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-network-wired fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Distribution</h5>
                               </div>
                               <!-- <input class='service_1' type='hidden' name='service_1' value='eau' /> -->
                           </div>
                           <div class="card-block card-body selectRegister2" style="cursor:not-allowed;">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fab fa-galactic-republic fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Service public</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister3" style="cursor:not-allowed;">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-tv fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Télécom</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister4" style="cursor:not-allowed;">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-hospital fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Santé</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister5">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-building fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Locataire</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister6">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-building fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Propriétaire</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister7">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-university fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Scolarité</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister8" style="cursor:not-allowed;">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-running fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Sport</h5>
                               </div>
                           </div>
                       </div>
                        <input type="button" name="next" class="next action-button sv_3" value="Suivant" /> <input type="button" name="previous" class="previous action-button-previous" value="Précédent" />
                    </fieldset>


                </fieldset>
                    <fieldset>
                        <div class="form-card last_card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Récap de la souscription</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_reviewed_docs_neeb.png')}}" height="204px" width="318px" data-component="image">

                                </div>
                                <div class="col-5">
                                  <!--  <h2 class="steps">Step 4 - 4</h2> -->
                                </div>
                            </div> <br><br>
                            <div class="row" style="margin-top:0px">
                                <div class="col-md-10 col-md-offset-1">

                                  <div class="panel panel-default recapPanel">
                                    <div class="panel-body">
                                      <div class="row" style="margin-bottom:35px">
                                        <div class="col-md-7" style="font-size:18px"> <strong>Mes informations de connexion</strong></div>
                                      </div>


                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>EMAIL</strong></p>
                                            <span class="display_mail recapData">
                                             </span>
                                          </div>

                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>MOT DE PASSE</strong></p>
                                            <span class="recapData">***********</span>
                                          </div>
                                        </div>
                                      </div>
                                    <div class="panel panel-default recapPanel">
                                      <div class="panel-body">
                                        <div class="row" style="margin-bottom:35px">
                                          <div class="col-md-7" style="font-size:18px"> <strong>Mes informations personnelles</strong></div>
                                        </div>


                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>PRENOM</strong></p>
                                              <span class="display_first_name recapData"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>NOM</strong></p>
                                              <span class="display_name recapData"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>CNI</strong></p>
                                              <span class="display_cni recapData"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>TELEPHONE</strong></p>
                                              <span class="display_phone recapData"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>ADRESSE</strong></p>
                                              <span class="display_address recapData"></span>
                                            </div>


                                    </div>
                                </div>
                                <!-- les infos banciares -->

                                <div class="panel panel-default recapPanel">
                                  <div class="panel-body">
                                    <div class="row" style="margin-bottom:35px">
                                      <div class="col-md-6" style="font-size:18px"> <strong>Mes services</strong></div>
                                    </div>
                                    <div class="col-md-7" style="margin-bottom:10px;">
                                      <p><strong>SOUSCRIPTION:</strong></p>
                                        <strong><li class="display_service_1 recapData" style = "text-transform:capitalize;"></li></strong>
                                        <strong><li class="display_service_2 recapData" style = "text-transform:capitalize;"></li></strong>
                                        <strong><li class="display_service_3 recapData" style = "text-transform:capitalize;"></li></strong>
                                        <strong><li class="display_service_4 recapData" style = "text-transform:capitalize;"></li></strong>
                                        <strong><li class="display_service_5 recapData" style = "text-transform:capitalize;"></li></strong>
                                        <strong><li class="display_service_6 recapData" style = "text-transform:capitalize;"></li></strong>
                                        <strong><li class="display_service_7 recapData" style = "text-transform:capitalize;"></li></strong>
                                        <strong><li class="display_service_8 recapData" style = "text-transform:capitalize;"></li></strong>
                                      </div>
                                </div>
                            </div>

                            </div>

                        </div>
                        <div class="row justify-content-center" style="margin-left:30%">
                            <div class="col-7 text-center">
                              <div id="captcha" class="row captcha-verif">
                                <div class="g-recaptcha" data-sitekey="6LdfdNUZAAAAAJlzQvySC5f86LvXR7agH34qS9As"></div>
                                <div id="error" class="left red-text text-darken-2" style="color: red;font-size:12px">
                                {{ $errors->first('g-recaptcha-response') }}.
                                </div>
                              </div>
                            </div>
                          </div>
                          <br />
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                   <input type="button" name="previous" class="previous_last action-button-previous" value="Précédent" /> <input type='submit' class='btn btn-primary submitForm' value='Soumettre' />
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>
        </div>
          </div>
    </div>
</div>
</div>
<script src="{{ url('js/form.js') }}"></script>
<script>


 /*  $('.radio-group .selectRegister1').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_1').remove();
    $(this).removeClass('selected');
    $('.display_service_1').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister1').append("<input class='service_1' type='hidden' name='service_1' value='eau' />");
    var value = $('.service_1').val();
    $('.display_service_1').text(value);
  }
  });

  $('.radio-group .selectRegister2').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_2').remove();
    $(this).removeClass('selected');
    $('.display_service_2').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister2').append("<input class='service_2' type='hidden' name='service_2' value='electricite' />");
    var value = $('.service_2').val();
    $('.display_service_2').text(value);
  }
  });

  $('.radio-group .selectRegister3').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_3').remove();
    $(this).removeClass('selected');
    $('.display_service_3').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister3').append("<input class='service_3' type='hidden' name='service_3' value='tv' />");
    var value = $('.service_3').val();
    $('.display_service_3').text(value);
  }
  });

  $('.radio-group .selectRegister4').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_4').remove();
    $(this).removeClass('selected');
    $('.display_service_4').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister4').append("<input class='service_4' type='hidden' name='service_4' value='mobile' />");
    var value = $('.service_4').val();
    $('.display_service_4').text(value);
  }
  }); */

  $('.radio-group .selectRegister5').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_5').remove();
    $(this).removeClass('selected');
    $('.display_service_5').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister5').append("<input class='service_5' type='hidden' name='service_5' value='locataire' />");
    var value = $('.service_5').val();
    $('.display_service_5').text(value);
  }
  });

  $('.radio-group .selectRegister6').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_6').remove();
    $(this).removeClass('selected');
    $('.display_service_6').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister6').append("<input class='service_6' type='hidden' name='service_6' value='proprietaire' />");
    var value = $('.service_6').val();
    $('.display_service_6').text(value);
  }
  });

   $('.radio-group .selectRegister7').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_7').remove();
    $(this).removeClass('selected');
    $('.display_service_7').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister7').append("<input class='service_7' type='hidden' name='service_7' value='scolarite' />");
    var value = $('.service_7').val();
    $('.display_service_7').text(value);
  }
  });

  $('.radio-group .selectRegister8').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_8').remove();
    $(this).removeClass('selected');
    $('.display_service_8').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister8').append("<input class='service_8' type='hidden' name='service_8' value='sport' />");
    var value = $('.service_8').val();
    $('.display_service_8').text(value);
  }
  });

$('.sv_1').click(function(){
  var value = $('.mail').val();
  $('.display_mail').text(value);
});

$('.sv_2').click(function(){
  var value = $('.first_name').val();
  $('.display_first_name').text(value);

  var value = $('.name').val();
  $('.display_name').text(value);

  var value = $('.phone').val();
  $('.display_phone').text(value);

  var value = $('.address').val();
  $('.display_address').text(value);

  var value = $('.cni').val();
  $('.display_cni').text(value);
});

var value = $('.service_1').val();
$('.display_service_1').text(value);

$(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
</script>

@endsection
