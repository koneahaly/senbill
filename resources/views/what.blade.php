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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/all.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/elektra_bis.css')}}">
        <script src="{!! mix('js/app.js') !!}"></script>

    </head>

    <script>
    $(document).ready(function(){
        $('[data-toggle="s2sn-login-header-social"]').popover({
            placement : 'bottom',
            trigger : 'hover'
        });
    });
    </script>

    <body>
      <div class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/stLouis.jpg')}});">
      	 <!-- HEADER START -->
         <div class="s2sn-login-header-desktop">
             <a class="s2sn-logo-elektra" href=".">
                 <img src="{{url('images/logo-s2sn.png')}}" alt="logo-elektra" width="162" height="auto" class="s2sn-img-normal">
             	   <img src="{{url('images/logo-s2sn-mediumsmall.png')}}" alt="logo-elektra" width="162" height="auto" class="s2sn-img-retina">
             </a>
             <div class="s2sn-login-header-nav">
          <div class="s2sn-login-header-top">
              <ul class="s2sn-login-header-social" data-toggle="s2sn-login-header-social" data-html="true" data-content="<div> Bientôt disponible </div>" >
                  <li><i class="fab fa-twitter"></i></li>
                  <li><i class="fab fa-youtube"></i></li>
                  <li><i class="fab fa-linkedin"></i></li>
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
              <li><a class="s2sn-header-link" href="{{ route('who') }}">QUI SOMMES-NOUS &nbsp </a></li>
              <li><a class="s2sn-header-link" href="{{ route('what') }}">LA PLATEFORME ELEKTRA &nbsp </a></li>
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
                      <li class="nav-item"><a class="nav-link" href=".">ACCUEIL</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('who') }}">QUI SOMMES-NOUS</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('what') }}">LA PLATEFORME ELEKTRA</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" >S'INSCRIRE</a></li>


                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal1">FAQ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal2">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal3">DEMO</a></li>
                 </ul>
             </div>
         </nav>
         <!-- HEADER END -->
         <style>
         .jumbotron {
            background: rgb(200, 54, 54); /* This is for ie8 and below */
            background: rgba(199, 206, 205, 1);
            }
         </style>
         <div class="container">
           <div class="jumbotron">
             <div class="inner">
               <br /><br /><br />
                <h1>La plateforme elektra</h1>
                <div class="">
                        <p class="s2sn-modal-title"><strong>Qu'est-ce que la plateforme Elektra?</strong></p>
                        <p class="s2sn-modal-text">Elektra est une plateforme d'accès unique à vos paiements de factures et  recharges de plusieurs établissements <br />
                        En vous inscrivant à Elektra, vos factures relatives à nos différents partenaires sont ainsi importées au sein <br />de notre plateforme. Ce qui vous ainsi la possibilité de les régler. <br />
                      Pour les offres prépayées, vous avez également la possibilité d'acheter vos recharges en ligne et de les appliquer<br /> à vos comptes (sans autre action manuelle).</p>

                      <p class="s2sn-modal-title"><strong>Les autres services</strong></p>
                      <ul>
                        <li>Numérisation des factures (Téléchargement et envoi par mail).</li>
                        <li>Envoi de notification (nouvelle facture, relance impayée, suggestion et informations utiles).</li>
                        <li>Envoi d'alertes (utilisation abusive de ressources, solde proche de zéro...)</li>
                        <li>Statitiques sur l'utilisation des ressources</li>
                      </ul>

                        <p class="s2sn-modal-title"><strong>Comment accéder à Elektra?</strong></p>
                        <p class="s2sn-modal-text">Vous pouvez vous connecter avec vos identifiants et accéder aux services auxquels vous vous êtes abonnés.  Si vous n'avez pas de compte, vous pouvez en créer via le lien <a href="{{ route('register') }}">inscription</a> </p>

                        <p class="s2sn-modal-title"><strong>Combien me coûte l'utilisation d'Elektra?</strong></p>
                        <p class="s2sn-modal-text">Elektra inclut des achats intégrés (cartes, factures...) et prend une commision de 1% au moment du paiement.</p>

                        <p class="s2sn-modal-title"><strong>Que puis-je faire lorsque je n'arrive pas à me connecter?</strong></p>
                        <p class="s2sn-modal-text">Dans ce cas, vos identifiants sont certainement incorrects, vous pouvez les resaisir ou récupérer votre mot de passe. En cas de porblèmes, contactez le service client Services2sn.</p>
                </div>
                <p><a class="btn btn-primary btn-lg" href="." role="button">Voir la démo</a></p>
              </div>
            </div>
          </div

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
                        <p class="s2sn-modal-title">Qu'est-ce que la plateforme Elektra?</p>
                        <p class="s2sn-modal-text">Elektra est une plateforme d'accès unique à vos paiements et factures de plusieurs établissements</p>

                        <p class="s2sn-modal-title">Comment accéder à Elektra?</p>
                        <p class="s2sn-modal-text">Vous pouvez vous connecter avec vos identifiants et accéder aux services auxquels vous vous êtes abonnés.  Si vous n'avez pas de compte, vous pouvez en créer via le lien <strong>s'inscrire</strong> </p>

                        <p class="s2sn-modal-title">Combien me coûte l'utilisation d'Elektra?</p>
                        <p class="s2sn-modal-text">Elektra inclut des achats intégrés (cartes, factures...) mais son utilisation est complètement gratuite</p>

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
                     <i class="fas fa-desktop fa-4x"></i>
                   </p>
                 </div>

                 <div class="col-9">
                   <p>Vous pouvez explorer la plateforme Elektra en vous connectant en tant qu'utilisateur démo.
                   </p>
                   <p>
                     <strong>Copiez les identifiants de connexion suivants et les utiliser pour vous connecter. Merci de les noter puisque l'identifiant sera unique et ne peut être généré qu'
                       <u>une seule fois</u>.</strong>
                   </p>
                   <p class="mb-0">Pour vous connecter en tant que client <strong>classique</strong>, utilisez <span class="text-info">{{ $user_cl }}</span> comme nom d'utilisateur et <span class="text-white bg-dark">demo123</span> comme mot de passe.</p>
                   <br/>
                   <p class="mb-0">Pour vous connecter en tant que client <strong>woyofal</strong>, utilisez <span class="text-info">{{ $user_wy }}</span> comme nom d'utilisateur et <span class="text-white bg-dark">demo123</span> comme mot de passe.</p>

                 </div>
               </div>
              </div>
          </div>
        </div>
      </div>

         <script src="{{url('js/jquery.min.js')}}"></script>
         <script src="{{url('js/popper.min.js')}}"></script>
         <script src="{{url('js/bootstrap.min.js')}}"></script>
         <script src="{{url('js/jquery-ui.min.js')}}"></script>

    </div>
    </body>
</html>
