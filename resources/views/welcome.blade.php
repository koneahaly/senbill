<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/all.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/elektra.css')}}">
        <script src="{!! mix('js/app.js') !!}"></script>

    </head>

    <body>
      <div class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/stLouis.jpg')}});">
      	 <!-- HEADER START -->
         <div class="s2sn-login-header-desktop">
             <a class="s2sn-logo-elektra" href="https://www.services2sn.com/" target="_blank">
                 <img src="{{url('images/logo-s2sn.png')}}" alt="logo-elektra" width="162" height="auto" class="s2sn-img-normal">
             	   <img src="{{url('images/logo-s2sn-mediumsmall.png')}}" alt="logo-elektra" width="162" height="auto" class="s2sn-img-retina">
             </a>
             <div class="s2sn-login-header-nav">
          <div class="s2sn-login-header-top">
              <ul class="s2sn-login-header-social">
                  <li><a class="s2sn-header-link s2sn-twitter" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></li>
                  <li><a class="s2sn-header-link s2sn-youtube" href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
                  <li><a class="s2sn-header-link s2sn-linkedin" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
              </ul>
              <ul class="s2sn-login-header-modals">
                  <li><a class="s2sn-header-link" href="#" data-toggle="modal" data-target="#modal1">FAQ</a></li>
                  <li><a class="s2sn-header-link" href="#" data-toggle="modal" data-target="#modal2">Contact</a></li>
                  <li><a class="s2sn-header-link" href="#" data-toggle="modal" data-target="#modal3">DEMO</a></li>
                  <li class="s2sn-copyright">SERVICES2SN 2019</li>
              </ul>
          </div>
          <ul class="s2sn-navbar">
              <li><a class="s2sn-header-link" href="https://www.services2sn.com/#a_propos" target="_blank">QUI SOMMES-NOUS &nbsp </a></li>
              <li><a class="s2sn-header-link" href="https://www.services2sn.com/#projets" target="_blank">LA PLATEFORME ELEKTRA &nbsp </a></li>
              <li><a class="s2sn-header-link" href="{{ route('register') }}" >S'INSCRIRE</a></li>
          </ul>
      </div>
         </div>
         <nav class="navbar navbar-dark s2sn-login-header-mobile">
             <a class="s2sn-logo-elektra" href="https://www.elektra.com/" target="_blank">
                 <img src="{{url('images/logo-s2sn.png')}}" alt="logo-elektra" width="162" height="auto" class="s2sn-img-normal">
             	   <img src="{{url('images/logo-s2sn-mediumsmall.png')}}" alt="logo-elektra" width="162" height="auto" class="s2sn-img-retina">
             </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-contrs2sn="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav">
                     <li class="nav-item"><a class="nav-link" href="https://www.services2sn.com/#a_propos" target="_blank">QUI SOMMES-NOUS</a></li>
                     <li class="nav-item"><a class="nav-link" href="https://www.services2sn.com/" target="_blank">LA PLATEFORME ELEKTRA</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" >S'INSCRIRE</a></li>


                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal1">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal2">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal3">DEMO</a></li>
                 </ul>
             </div>
         </nav>
         <!-- HEADER END -->
         <div class="s2sn-wrapper-center s2sn-wrapper-when-footer">
           <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="auto" height="100" class="s2sn-logo-elektra">


         <script type="text/javascript">

         function submitCredentials(){
                 return document.forms['loginForm'].submit();
                }

         </script>


         <form action="{{ route('login') }}" name="loginForm" id="loginForm" method="post" autocomplete="off">
           {{ csrf_field() }}

            @if ($errors->has('email'))
                <span class="help-block">
                  <i class="fas fa-exclamation-circle"></i>
                    <strong style="color:red">{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <div class="s2sn-input-group input-group form-slider-step form-group{{ $errors->has('email') ? ' has-error' : '' }}" id="form-step-1">
             <input type="text" name="email" id="PIN" value="{{ old('email') }}" class="form-control" placeholder="Veuillez saisir votre login ou email" aria-label="Veuillez saisir votre login ou email" required>
             <div class="input-group-prepend">
                         <button class="btn s2sn-js-btn-back" type="reset" value= "Reset" ><i class="fas fa-undo-alt"></i></button>
                     </div>
               </div>
             <div id="form-step-2" class="form-slider-step">
                <div class="s2sn-input-group input-group">
                    <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Mot de passe" name="password" id="PWD" onkeypress="if(event.keyCode==13){return submitCredentials();}">
                    <div class="input-group-append">
                        <button class="btn s2sn-js-btn-next" type="submit" onclick="return submitCredentials();"><i class="fas fa-arrow-right"></i></button>
                     </div>
                </div>
             </div>
            </form>

           </div>

         <script src="{{url('js/jquery.min.js')}}"></script>
         <script src="{{url('js/popper.min.js')}}"></script>
         <script src="{{url('js/bootstrap.min.js')}}"></script>
         <script src="{{url('js/jquery-ui.min.js')}}"></script>

    </div>
    </body>
</html>
