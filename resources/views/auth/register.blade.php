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
                        <li id="personal"><strong>Personal</strong></li>
                        <li id="payment"><strong>Image</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
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

                            <div class="form-group{{ $errors->has('pseudo') ? ' has-error' : '' }}">
                                <label for="pseudo" class="col-md-4 control-label">Pseudo</label>

                                <div class="col-md-6">
                                    <input id="pseudo" type="text" class="form-control" name="pseudo" value="{{ old('pseudo') }}" placeholder="Pseudo" required autofocus>

                                    @if ($errors->has('pseudo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pseudo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresse mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Adresse mail" required>

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
                        <input type="button" name="next" class="next action-button" value="Next" />
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
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Prénom" required autofocus>

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
                                    <input id="lastName" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nom" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Numéro de téléphone</label>

                                <div class="col-md-6">
                                    <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Numéro de téléphone" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <!--<div class="form-group">
                                <label for="user_type" class="col-md-4 control-label">Type de client</label>

                                <div class="col-md-6">
                                    <select id="user_type" name="user_type" class="form-control" required>
                                      <option value="">--Selectionner un type d'utilisateur--</option>
                                      <option value="1">Classique</option>
                                      <option value="2">Woyofal</option>
                                    </select>
                                    @if ($errors->has('user_type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> -->

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Adresse de facturation</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" placeholder="Adresse" required>
                                </div>
                            </div>

                        </div>
                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Services</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_location_review_dmxd.png')}}" height="270px" width="318px" data-component="image">

                                </div>
                            </div>
                            <div class="radio-group row justify-content-between px-3">
                     <div class="card-block card-body selectRegister selected">
                         <div class="row justify-content-end d-flex px-3">
                             <div class="fa fa-check"></div>
                         </div>
                         <div class="row justify-content-center d-flex">
                             <div class="pic"> <img src="https://i.imgur.com/4uBi6ib.png" class="pic-0"> </div>
                             <h5 class="mb-4">Create Website</h5>
                         </div>
                     </div>
                     <div class="card-block card-body selectRegister">
                         <div class="row justify-content-end d-flex px-3">
                             <div class="fa fa-circle"></div>
                         </div>
                         <div class="row justify-content-center d-flex">
                             <div class="pic"> <img src="https://i.imgur.com/nwy6Wkh.png" class="pic-0"> </div>
                             <h5 class="mb-4">Website Relaunch</h5>
                         </div>
                     </div>
                     <div class="card-block card-body selectRegister">
                         <div class="row justify-content-end d-flex px-3">
                             <div class="fa fa-circle"></div>
                         </div>
                         <div class="row justify-content-center d-flex">
                             <div class="pic"> <img src="https://i.imgur.com/74Ez7OS.png" class="pic-0"> </div>
                             <h5 class="mb-4">Don't Know</h5>
                         </div>
                     </div>
                 </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                    <img alt="" class="form-image" style="border:0;margin-left:200px;" src="{{url('images/undraw_reviewed_docs_neeb.png')}}" height="204px" width="318px" data-component="image">

                                </div>
                                <div class="col-5">
                                  <!--  <h2 class="steps">Step 4 - 4</h2> -->
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
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
<script>
  $('.radio-group .selectRegister').click(function(){
  $('.selected .fa').removeClass('fa-check');
  $('.selected .fa').addClass('fa-circle');
  $('.selectRegister').removeClass('selected');
  $(this).addClass('selected');
  $('.selected .fa').removeClass('fa-circle');
  $('.selected .fa').addClass('fa-check');
  });
</script>
@endsection
