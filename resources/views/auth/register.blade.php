@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-8 col-md-offset-2  p-0 mt-3 mb-2">
          <div class="panel panel-default" style="margin-top:85px;color:black;">
              <div class="panel-heading">Crées ton compte utilisateur</div>
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

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresse mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control mail" name="email" placeholder="Adresse mail" required>

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
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe" required>

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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation du mot de passe" required>
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

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Numéro de téléphone</label>

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
                                    <h2 class="fs-title" style="margin-left: 40%;">Services</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_location_review_dmxd.png')}}" height="270px" width="318px" data-component="image">

                                </div>
                                <div class="col-5">
                                    <!-- <h2 class="steps">Step 3 - 4</h2> -->
                                </div>
                            </div>
                        </div>
                        <div class="radio-group row justify-content-between px-3" style="margin-left: -3px;">
                           <div class="card-block card-body selectRegister1 selected">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-check"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-faucet fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Eau</h5>
                               </div>
                               <input class='service_1' type='hidden' name='service_1' value='eau' />
                           </div>
                           <div class="card-block card-body selectRegister2">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-plug fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Electricité</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister3">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-tv fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Television</h5>
                               </div>
                           </div>
                           <div class="card-block card-body selectRegister4">
                               <div class="row justify-content-end d-flex px-3">
                                   <div class="fa fa-circle"></div>
                               </div>
                               <div class="row justify-content-center d-flex">
                                   <div class="pic"> <i class="fas fa-mobile-alt fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                   <h5 class="mb-4" style="color:black;text-align:center;">Mobile & Internet</h5>
                               </div>
                           </div>
                       </div>
                        <input type="button" name="next" class="next action-button sv_3" value="Suivant" /> <input type="button" name="previous" class="previous action-button-previous" value="Précédent" />
                    </fieldset>


                </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title" style="margin-left: 30%;">Récap de la souscription</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_reviewed_docs_neeb.png')}}" height="204px" width="318px" data-component="image">

                                </div>
                                <div class="col-5">
                                  <!--  <h2 class="steps">Step 4 - 4</h2> -->
                                </div>
                            </div> <br><br>
                            <div class="row" style="margin-top:0px">
                                <div class="col-md-10 col-md-offset-1">

                                  <div class="panel panel-default">
                                    <div class="panel-body">
                                      <div class="row" style="margin-bottom:35px">
                                        <div class="col-md-7" style="font-size:18px"> <strong>Mes informations de connexion</strong></div>
                                      </div>


                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>EMAIL</strong></p>
                                            <span class="display_mail">
                                             </span>
                                          </div>

                                          <div class="col-md-6" style="margin-bottom:10px">
                                            <p><strong>MOT DE PASSE</strong></p>
                                            <span>***********</span>
                                          </div>
                                        </div>
                                      </div>
                                    <div class="panel panel-default">
                                      <div class="panel-body">
                                        <div class="row" style="margin-bottom:35px">
                                          <div class="col-md-7" style="font-size:18px"> <strong>Mes informations personnelles</strong></div>
                                        </div>


                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>PRENOM</strong></p>
                                              <span class="display_first_name"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>NOM</strong></p>
                                              <span class="display_name"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>CNI</strong></p>
                                              <span class="display_cni"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>TELEPHONE</strong></p>
                                              <span class="display_phone"></span>
                                            </div>

                                            <div class="col-md-6" style="margin-bottom:10px">
                                              <p><strong>ADRESSE</strong></p>
                                              <span class="display_address"></span>
                                            </div>


                                    </div>
                                </div>
                                <!-- les infos banciares -->

                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="row" style="margin-bottom:35px">
                                      <div class="col-md-6" style="font-size:18px"> <strong>Mes services</strong></div>
                                    </div>
                                    <div class="col-md-7" style="margin-bottom:10px;">
                                      <p><strong>SOUSCRIPTION:</strong></p>
                                        <strong><li class="display_service_1"></li></strong>
                                        <strong><li class="display_service_2"></li></strong>
                                        <strong><li class="display_service_3"></li></strong>
                                        <strong><li class="display_service_4"></li></strong>
                                      </div>
                                </div>
                            </div>

                            </div>
                        </div>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <input type='submit' class='btn btn-primary submitForm' value='Soumettre' />
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

<script src="{{ url('js/form.js') }}"></script>
<script>


  $('.radio-group .selectRegister1').click(function(){
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

</script>
@endsection
