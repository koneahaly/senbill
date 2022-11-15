<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-elektra-halo.png"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/all.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/elektra_bis.css')}}">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body class="welcome_elektra">
      <div class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/stLouis.jpg')}});">
      	 <!-- HEADER START -->
         <div class="s2sn-login-header-desktop">
             <a class="s2sn-logo-elektra" href="{{ env('APP_URL') }}">
                 <img src="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-s2sn.png" alt="logo-elektra" width="162" height="auto" class="s2sn-img-normal">
             	   <img src="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-s2sn-mediumsmall.png" alt="logo-elektra" width="162" height="auto" class="s2sn-img-retina">
             </a>
             <div class="s2sn-login-header-nav">
          <div class="s2sn-login-header-top">
              <ul class="s2sn-login-header-social">
                  <li><a class="s2sn-header-link s2sn-twitter" href="https://twitter.com/" target="_blank"><span class="fa fa-twitter"></span></a></li>
                  <li><a class="s2sn-header-link s2sn-youtube" href="https://www.youtube.com/" target="_blank"><span class="fa fa-youtube"></span></a></li>
                  <li><a class="s2sn-header-link s2sn-linkedin" href="https://www.linkedin.com/" target="_blank"><span class="fa fa-linkedin"></span></a></li>
              </ul>
              <ul class="s2sn-login-header-modals">
                  <li><a class="s2sn-header-link" href="#" data-toggle="modal" data-target="#modalFAQ">FAQ</a></li>
                  <li><a class="s2sn-header-link" href="#" data-toggle="modal" data-target="#modal2">Contact</a></li>
                  <li><a class="s2sn-header-link" href="#" data-toggle="modal" data-target="#modalDemo">DEMO</a></li>
                  <li class="s2sn-copyright">SERVICES2SN 2019</li>
              </ul>
          </div>
          <ul class="s2sn-navbar">
              <li><a class="s2sn-header-link" href=".">ACCUEIL &nbsp</a></li>
              <li><a class="s2sn-header-link" href="https://www.services2sn.com" target="blank">QUI SOMMES-NOUS &nbsp </a></li>
              <li><a class="s2sn-header-link" href="{{ route('what') }}">LA PLATEFORME ELEKTRA &nbsp </a></li>
              <li><a class="s2sn-header-link" href="{{ route('register') }}">S'INSCRIRE</a></li>
          </ul>
      </div>
         </div>
         <nav class="navbar navbar-dark s2sn-login-header-mobile">
             <a class="s2sn-logo-elektra" href="{{ env('APP_URL') }}">
                 <img src="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-s2sn.png" alt="logo-elektra" width="162" height="auto" class="s2sn-img-normal">
             	   <img src="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-s2sn-mediumsmall.png" alt="logo-elektra" width="162" height="auto" class="s2sn-img-retina">
             </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-contrs2sn="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav">
                      <li class="nav-item"><a class="nav-link" href=".">ACCUEIL</a></li>
                     <li class="nav-item"><a class="nav-link" href="www.services2sn.com">QUI SOMMES-NOUS</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('what') }}">LA PLATEFORME ELEKTRA</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" >S'INSCRIRE</a></li>


                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalFAQ">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal2">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalDemo">DEMO</a></li>
                 </ul>
             </div>
         </nav>
<div class="container">
    <div class="row">
      <div class="col-md-4"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div style="font-weight:bold;margin-left:4%;" class="panel-heading">Réinitialiser votre mot de passe</div>
                <br />

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-8">

                            <div class="col-md-6 s2sn-input-group input-group">
                                <input id="email" type="email" placeholder="Veuillez saisir votre adresse mail" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-8">

                            <div class="col-md-6 s2sn-input-group input-group">
                                <input id="password" type="password" placeholder="Veuillez saisir votre nouveau mot de passe" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} col-md-8">
                            <div class="col-md-6 s2sn-input-group input-group">
                                <input id="password-confirm" type="password" placeholder="Veuillez confirmer votre mot de passe" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Réinitialiser le mot de passe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
