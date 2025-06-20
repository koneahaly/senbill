<?php $raw_woyofal_users_demo = File::get(storage_path('classical_users.txt')); //filename inverted
$raw_classical_users_demo = File::get(storage_path('woyofal_users.txt'));
$user_cl="admin";
$user_wy="admin";
if(!empty($raw_woyofal_users_demo) and !empty($raw_classical_users_demo)){
  $classical_users_demo = substr($raw_classical_users_demo,0,-1);
  $woyofal_users_demo = substr($raw_woyofal_users_demo,0,-1);
  $classical_user_demo = explode(",", $classical_users_demo);
  $woyofal_user_demo = explode(",", $woyofal_users_demo);

  $rand_keys_cl = rand(0,count($classical_user_demo)-1);
  $rand_keys_wy = rand(0,count($woyofal_user_demo)-1);

  $user_cl = $classical_user_demo[$rand_keys_cl];
  $user_wy = $woyofal_user_demo[$rand_keys_wy];

}
//echo $rand_keys_cl.'-----'.$rand_keys_wy;
//echo $classical_user_demo[$rand_keys_cl].'****'.$woyofal_user_demo[$rand_keys_wy];
?>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-CXR499BH4X"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-CXR499BH4X');
      </script>
      <script src='https://www.google.com/recaptcha/api.js'></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-senbill-halo.png"/>
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
             <a class="s2sn-logo-elektra" href=".">
                 <img src="{{url('images/logo-s2sn.png')}}" alt="logo-senbill" width="162" height="auto" class="s2sn-img-normal">
             	   <img src="{{url('images/logo-s2sn-mediumsmall.png')}}" alt="logo-senbill" width="162" height="auto" class="s2sn-img-retina">
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
                  <li><a class="s2sn-header-link" href="./nous-contacter">Contact</a></li>
                  <li><a class="s2sn-header-link" href="#" data-toggle="modal" data-target="#modalDemo">DEMO</a></li>
                  <li class="s2sn-copyright">SERVICES2SN 2019</li>
              </ul>
          </div>
          <ul class="s2sn-navbar">
              <li><a class="s2sn-header-link" href=".">ACCUEIL &nbsp</a></li>
              <li><a class="s2sn-header-link" href="https://www.services2sn.com" target="blank">QUI SOMMES-NOUS &nbsp </a></li>
              <li><a class="s2sn-header-link" href="{{ route('what') }}">LA PLATEFORME SENBILL &nbsp </a></li>
              <li><a class="s2sn-header-link" href="{{ route('register') }}">S'INSCRIRE</a></li>
          </ul>
      </div>
         </div>
         <nav class="navbar navbar-dark s2sn-login-header-mobile">
             <a class="s2sn-logo-elektra" href=".">
                 <img src="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-s2sn.png" alt="logo-senbill" width="162" height="auto" class="s2sn-img-normal">
             	   <img src="{{ env('S3_URL')}}/{{ env('AWS_BUCKET')}}/logo-s2sn-mediumsmall.png" alt="logo-senbill" width="162" height="auto" class="s2sn-img-retina">
             </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-contrs2sn="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav">
                      <li class="nav-item"><a class="nav-link" href=".">ACCUEIL</a></li>
                     <li class="nav-item"><a class="nav-link" href="https://www.services2sn.com">QUI SOMMES-NOUS</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('what') }}">LA PLATEFORME SENBILL</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" >S'INSCRIRE</a></li>


                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalFAQ">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="./nous-contacter">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalDemo">DEMO</a></li>
                 </ul>
             </div>
         </nav>
         <!-- HEADER END -->
         <div class="s2sn-wrapper-center s2sn-wrapper-when-footer">
           <img src="{{url('images/logo-senbill-halo.png')}}" alt="logo-elektra" width="auto" height="100" class="s2sn-logo-elektra">


         <script type="text/javascript">

         function submitCredentials(){
                 return document.forms['loginForm'].submit();
                }
                function myFunction() {
                  var x = document.getElementById("PWD");
                  if (x.type === "password") {
                    x.type = "text";
                  } else {
                    x.type = "password";
                  }
                }

         </script>


         <form action="{{ route('login') }}" name="loginForm" id="loginForm" method="post" autocomplete="off">
           {{ csrf_field() }}

            @if ($errors->has('email'))
            <div class="s2sn-error-login" id="s2sn-error-login">
                <span class="help-block">
                  <span class="fa fa-exclamation-circle"></span>
                    <p>{{ $errors->first('email') }}</p>
                </span>
              </div>
            @endif
            <div class="s2sn-input-group input-group form-slider-step form-group{{ $errors->has('email') ? ' has-error' : '' }}" id="form-step-1">
             <input type="text" name="email" id="PIN" value="{{ old('email') }}" class="form-control" placeholder="Veuillez saisir votre login ou email" aria-label="Veuillez saisir votre login ou email" required>
             <div class="input-group-prepend">
                         <button class="btn s2sn-js-btn-back" type="reset" value= "Reset" ><span class="fa fa-undo"></span></button>
                     </div>
               </div>
             <div id="form-step-2" class="form-slider-step">
                <div class="s2sn-input-group input-group">
                    <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Mot de passe" name="password" id="PWD" onkeypress="if(event.keyCode==13){return submitCredentials();}" required>
                    <div class="input-group-append">
                        <button class="btn s2sn-js-btn-next" type="submit" onclick="return submitCredentials();"><span class="fa fa-arrow-right"></span></button>
                     </div>
                </div>
                <input type="checkbox" onclick="myFunction();"> Afficher mot de passe
             </div>

             <div id="captcha" class="captcha-verif">
               <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
               <div id="error" class="left red-text text-darken-2" style="color: red;font-size:12px">
               {{ $errors->first('g-recaptcha-response') }}.
               </div>
             </div>

            </form>


            <div>
              <a style="color:white;font-weight:bold;" class="btn btn-link" href="{{ route('password.request') }}">
                  Mot de passe oublié?
              </a>
            </div>
           </div>

           <!-- modal faq -->
            <div class="modal fade" id="modalFAQ" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
              <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content s2sn-modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title s2sn-modal-title-name">FAQ</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                         <p class="s2sn-modal-title">Qu'est-ce que la plateforme Senbill?</p>
                         <p class="s2sn-modal-text">Senbill est une plateforme d'accès unique à vos paiements et factures de plusieurs établissements</p>

                         <p class="s2sn-modal-title">Comment accéder à Senbill?</p>
                         <p class="s2sn-modal-text">Vous pouvez vous connecter avec vos identifiants et accéder aux services auxquels vous vous êtes abonnés.  Si vous n'avez pas de compte, vous pouvez en créer via le lien <strong>s'inscrire</strong> </p>

                         <p class="s2sn-modal-title">Combien me coûte l'utilisation de Senbill?</p>
                         <p class="s2sn-modal-text">Senbill inclut des achats intégrés (cartes, factures...) mais son utilisation est complètement gratuite</p>

                         <p class="s2sn-modal-title">Que puis-je faire lorsque je n'arrive pas à me connecter?</p>
                         <p class="s2sn-modal-text">Dans ce cas, vos identifiants sont certainement incorrects, vous pouvez les resaisir ou récupérer votre mot de passe. En cas de porblèmes, contactez le service client Services2sn</p>
                 </div>
             </div>
           </div>
         </div>
         <!-- modal demo -->
          <div class="modal fade" id="modalDemo" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content s2sn-modal-content">
               <div class="modal-header">
                   <h5 class="modal-title s2sn-modal-title-name">Se connecter en  démo</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                <div class="row">
                  <div class="col-3">
                    <p class="text-center">
                      <span class="fa fa-desktop fa-4x"></span>

                    </p>
                  </div>

                  <div class="col-9">
                    <p>Vous pouvez explorer la plateforme Senbill en vous connectant en tant qu'utilisateur démo.
                    </p>
                    <p>
                      <strong>Copiez les identifiants de connexion suivants et les utiliser pour vous connecter. Merci de les noter puisque l'identifiant sera unique et ne peut être généré qu'
                        <u>une seule fois</u>.</strong>
                    </p>
                    <p class="mb-0">Pour vous connecter en tant que client <strong>classique(postpayé)</strong>, utilisez <span class="text-info">{{ $user_wy }}</span> comme nom d'utilisateur et <span class="text-white bg-dark">demo123</span> comme mot de passe.</p>
                    <br/>
                  </div>
                </div>
               </div>
           </div>
         </div>
       </div>

         <script src="{{url('js/jquery.min.js')}}"></script>
         <script src="{{url('js/popper.min.js')}}"></script>
         <script src="{{url('js/bootstrap.min.js')}}"></script>

    </div>
    </body>
</html>
