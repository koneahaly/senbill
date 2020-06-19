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
        <link rel="icon" type="image/png" href="https://elektra.s3.amazonaws.com/images/icons/logo-elektra-halo.png"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/all.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/elektra_bis.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Oswald|PT+Sans" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>

    <script>
    $(document).ready(function(){
        $('[data-toggle="s2sn-login-header-social"]').popover({
            placement : 'bottom',
            trigger : 'hover'
        });
    });
    </script>
    <style>
          .pd-2{
        padding:2%;
      }
      .pd-r-2{
        padding-right:2%;
      }
      .pd-l-2{
        padding-left:2%;
      }
      .pd-t-2{
        padding-top:2%;
      }
      .pd-b-2{
        padding-bottom:2%;
      }
      body{
        font-family: 'PT Sans', sans-serif;
      }
      h1,h2,h3,h4,h5,.lead,div[data-toggle="collapse"]{
        font-family: 'Oswald', sans-serif;
      }
      ul li{
        list-style:none;
      }
      div[data-toggle="collapse"]{
       border-bottom:1px solid #BBDEFB;
       width:100%;
       cursor:pointer;
       padding:1%;
      }
      .collapse{
        background:#F5F5F5;
      }
      .bg-info {
    background-color: #BBDEFB!important;
}
    </style>

    <body style="height:100%">
      <div style="background-image: url({{url('images/stLouis.jpg')}});" class="s2sn-wrapper-login-container s2sn-js-login">
        <!-- HEADER START -->
        <div class="s2sn-login-header-desktop">
            <a class="s2sn-logo-elektra" href=".">
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
             <li><a class="s2sn-header-link" href="{{ route('register') }}">S'INSCRIRE</a></li>
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


                   <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalFAQ">FAQ</a></li>
                   <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modal2">Contact</a></li>
                   <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#modalDemo">DEMO</a></li>
                </ul>
            </div>
        </nav>
        <!-- HEADER END -->

        <div class="container s2sn-wrapper-center whatMobileContent" style="background:#ffffff">
            	<div class="row bg-info card my-4 mb-3 pd-l-2" style="padding-right: 2%;">
            		<h3>
            		    <span class="fa fa-question-circle text-white" ></span>
            		    La plateforme Elektra
            		</h3>
            	</div>

            	<div class="row">

            	    <ul id="accordion" class="col-sm-6 col-md-12">
            	        <!-- Question one -->
            	        <li>
            	            <div id="choose" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
            	                Qu'est-ce que la plateforme Elektra ?
            	                <span class="fa fa-chevron-up fa-1x text-info pull-right"></span>
            	            </div>
            	            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                                Elektra est une plateforme d'accès unique à vos paiements de factures et  recharges de plusieurs établissements <br />
                                En vous inscrivant à Elektra, vos factures relatives à nos différents partenaires sont ainsi importées au sein <br />de notre plateforme. Ce qui vous ainsi la possibilité de les régler. <br />
                              Pour les offres prépayées, vous avez également la possibilité d'acheter vos recharges en ligne et de les appliquer<br /> à vos comptes (sans autre action manuelle).
                              <p><strong>Les autres services : </strong></p>
                              <ul style="list-style: circle;margin-left: 5%;">
                                <li style="list-style: circle;">Numérisation des factures (Téléchargement et envoi par mail).</li>
                                <li style="list-style: circle;">Envoi de notification (nouvelle facture, relance impayée, suggestion et informations utiles).</li>
                                <li style="list-style: circle;">Envoi d'alertes (utilisation abusive de ressources, solde proche de zéro...)</li>
                                <li style="list-style: circle;">Statitiques sur l'utilisation des ressources</li>
                              </ul>
                              </div>
                            </div>
            	        </li>

            	        <!-- Question two -->
            	        <li>
            	            <div class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            	                Comment accéder à Elektra ?
            	                <span class="fa fa-chevron-down fa-1x text-info pull-right"></span>
            	            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                              <div class="card-body">
                                Vous pouvez vous connecter avec vos identifiants et accéder aux services auxquels vous vous êtes abonnés. <br />
                                 Si vous n'avez pas de compte, vous pouvez en créer via le lien <a href="{{ route('register') }}">inscription</a>
                              </div>
                            </div>
            	        </li>

            	        <!-- Question three -->
            	        <li>
            	            <div class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            	                Combien me coûte l'utilisation d'Elektra ?
            	                <span class="fa fa-chevron-down fa-1x text-info pull-right"></span>
            	            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                              <div class="card-body">
                                Elektra inclut des achats intégrés (cartes, factures...) et prend une commision de 1% au moment du paiement.
                              </div>
                            </div>
            	        </li>

            	        <!-- Question Four -->
            	        <li>
            	            <div class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            	                Que puis-je faire lorsque je n'arrive pas à me connecter ?
            	                <span class="fa fa-chevron-down fa-1x text-info pull-right"></span>
            	            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                              <div class="card-body">
                                Dans ce cas, vos identifiants sont certainement incorrects, vous pouvez les resaisir ou récupérer votre mot de passe.<br />
                                 En cas de porblèmes, contactez le service client Services2sn.
                              </div>
                            </div>
            	        </li>
            	    </ul>
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
                   <p class="mb-0">Pour vous connecter en tant que client <strong>classique</strong>, utilisez <span class="text-info">{{ $user_wy }}</span> comme nom d'utilisateur et <span class="text-white bg-dark">demo123</span> comme mot de passe.</p>
                   <br/>
                   <p class="mb-0">Pour vous connecter en tant que client <strong>woyofal</strong>, utilisez <span class="text-info">{{ $user_cl }}</span> comme nom d'utilisateur et <span class="text-white bg-dark">demo123</span> comme mot de passe.</p>

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
    <script>
    $(document).ready(function() {
          //$(".chevron-down").
          $("div[data-toggle=collapse]").click(function(){
              $(this).children('span').toggleClass("fa-chevron-down fa-chevron-up");
          });
    });
</script>
</html>
