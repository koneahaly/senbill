<!DOCTYPE html>
<html  >
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{url('images/logo-s2sn.png')}}" type="image/x-icon">
  <meta name="description" content="">


  <title>Plateforme SenBill</title>
  <link rel="stylesheet" href="{{url('whatFolder/assets/web/assets/mobirise-icons/mobirise-icons.css')}}">
  <link rel="stylesheet" href="{{url('whatFolder/assets/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('whatFolder/assets/bootstrap/css/bootstrap-grid.min.css')}}">
  <link rel="stylesheet" href="{{url('whatFolder/assets/bootstrap/css/bootstrap-reboot.min.css')}}">
  <link rel="stylesheet" href="{{url('whatFolder/assets/socicon/css/styles.css')}}">
  <link rel="stylesheet" href="{{url('whatFolder/assets/tether/tether.min.css')}}">
  <link rel="stylesheet" href="{{url('whatFolder/assets/dropdown/css/style.css')}}">
  <link rel="stylesheet" href="{{url('whatFolder/assets/theme/css/style.css')}}">
  <link rel="preload" as="style" href="{{url('whatFolder/assets/mobirise/css/mbr-additional.css')}}"><link rel="stylesheet" href="{{url('whatFolder/assets/mobirise/css/mbr-additional.css')}}" type="text/css">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

<style>
.cube {
  position:relative;
  margin:0px;
  padding:0px;
  width:500px;
  height:60px;
  margin:5rem auto;
  -webkit-transform-style:preserve-3d;
  -moz-transform-style:   preserve-3d;
  -ms-transform-style:    preserve-3d;
  -o-transform-style:     preserve-3d;
  transform-style:        preserve-3d;
  -webkit-perspective:400px;
  -moz-perspective:   400px;
  -ms-perspective:    400px;
  -o-perspective:     400px;
  perspective:        400px;
  margin-top: 1%;
}
/* positions */
.a, .b, .c, .d {
  position:absolute;
  width:0;
  height:100%;
  left:0px;
  z-index:222;
}
.a:before, .b:before, .c:before, .d:before, .a:after, .b:after {
  content:'';
  position:absolute;
  top:0px;
  left:0px;
  width:500px;
  height:60px;
}
.a:before, .b:before, .c:before, .d:before {
  z-index:111;
}
.a:after, .b:after {
  z-index:333;
}
.b {
  top:0px;
  -webkit-transform:rotateX(75deg) translateY(-60px);
  -moz-transform:   rotateX(75deg) translateY(-60px);
  -o-transform:     rotateX(75deg) translateY(-60px);
  -ms-transform:    rotateX(75deg) translateY(-60px);
  transform:        rotateX(75deg) translateY(-60px);
  -webkit-transform-origin:0% 0%;
  -moz-transform-origin:   0% 0%;
  -o-transform-origin:     0% 0%;
  -ms-transform-origin:    0% 0%;
  transform-origin:        0% 0%;
}
.c {
  top:0px;
  -webkit-transform:rotateX(75deg);
  -moz-transform:   rotateX(75deg);
  -o-transform:     rotateX(75deg);
  -ms-transform:    rotateX(75deg);
  transform:        rotateX(75deg);
  -webkit-transform-origin:100% 100%;
  -moz-transform-origin:   100% 100%;
  -o-transform-origin:     100% 100%;
  -ms-transform-origin:    100% 100%;
  transform-origin:        100% 100%;
}
.d {
  -webkit-transform:translateZ(-60px) translateY(-15px);
  -moz-transform:   translateZ(-60px) translateY(-15px);
  -o-transform:     translateZ(-60px) translateY(-15px);
  -ms-transform:    translateZ(-60px) translateY(-15px);
  transform:        translateZ(-60px) translateY(-15px);
}
/* colors */
.a, .b {
  background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(116,198,43,0.8)), to(rgba(116,198,43,0.8)));
  background-image: -webkit-linear-gradient(top, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-image:    -moz-linear-gradient(top, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-image:      -o-linear-gradient(top, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-image:         linear-gradient(to bottom, rgba(116,198,43,0.8), rgba(116,198,43,0.8));
  background-repeat:no-repeat;
  background-size:100% 100%;
  background-position:0% 0%;
}
.c, .d {
  background-image:-webkit-gradient(linear, left top, left bottom, from(rgba(116,198,43,0.5)), to(rgba(116,198,43,0.5)));
  background-image:-webkit-linear-gradient(top, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-image:   -moz-linear-gradient(top, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-image:     -o-linear-gradient(top, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-image:        linear-gradient(to bottom, rgba(116,198,43,0.5), rgba(116,198,43,0.5));
  background-repeat:no-repeat;
  background-size:100% 100%;
  background-position:0% 0%;
}
.c:before {
  -webkit-box-shadow:0px 30px 20px -20px rgba(0,0,0,0.4),
                     0px 40px 15px -15px rgba(0,0,0,0.25);
  -moz-box-shadow:   0px 30px 20px -20px rgba(0,0,0,0.4),
                     0px 40px 15px -15px rgba(0,0,0,0.25);
  box-shadow:        0px 30px 20px -20px rgba(0,0,0,0.4),
                     0px 40px 15px -15px rgba(0,0,0,0.25);
}
.a:before, .b:before, .c:before, .d:before {
  background-color:rgba(0,0,0,0.05);
}
.a:after {
  background-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,0.07)), to(rgba(0,0,0,0)));
  background-image:-webkit-linear-gradient(top, rgba(0,0,0,0.07), rgba(0,0,0,0));
  background-image:   -moz-linear-gradient(top, rgba(0,0,0,0.07), rgba(0,0,0,0));
  background-image:     -o-linear-gradient(top, rgba(0,0,0,0.07), rgba(0,0,0,0));
  background-image:        linear-gradient(to bottom, rgba(0,0,0,0.07), rgba(0,0,0,0));
}
.b:after {
  background-image:-webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,0.1)), to(rgba(255,255,255,0.25)));
  background-image:-webkit-linear-gradient(top, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
  background-image:   -moz-linear-gradient(top, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
  background-image:     -o-linear-gradient(top, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
  background-image:        linear-gradient(to bottom, rgba(255,255,255,0.1), rgba(255,255,255,0.25));
}
/* jQuery stuff */
#slider-range-min {
  position:absolute;
  width: 94%;
  left:3%;
  top:27px;
  margin: 0px;
  z-index:999;
}
.ui-slider {
  height:5px;
  border:none;
  background:rgba(0,0,0,0.1);
  -webkit-box-shadow:0px 2px 2px rgba(255,255,255,0.25),
                     inset 0px 1px 3px rgba(0,0,0,0.3);
  -moz-box-shadow:   0px 2px 2px rgba(255,255,255,0.25),
                     inset 0px 1px 3px rgba(0,0,0,0.3);
  box-shadow:        0px 2px 2px rgba(255,255,255,0.25),
                     inset 0px 1px 3px rgba(0,0,0,0.3);
}
.ui-slider:before, .ui-slider:after {
  content:'IIIIIIIIIII';
  position:absolute;
  left:2px;
  width:100%;
  font-family: 'Source Sans Pro', sans-serif;
  font-size:1.2rem;
  font-weight:300;
  color:rgba(0,0,0,0.3);
  letter-spacing:41px;
  text-shadow:1px 1px 0px rgba(255,255,255,0.2);
}
.ui-slider:before {
  top:-1.4rem;
}
.ui-slider:after {
  bottom:-1.4rem;
}
.ui-slider-range {background:transparent;}
.ui-slider .ui-slider-handle {
  top:-8px;
  width:26px;
  height:20px;
  margin-left:-15px;
  padding-left:4px;
  border:none;
  background:rgba(255,255,255,0.7);
  border-radius:2px;
  text-align:center;
  font-family: 'Anonymous Pro', sans-serif;
  font-size:1.2rem;
  line-height:20px;
  color:rgba(0,0,0,0.5);
  text-decoration:none;
  letter-spacing:3px;
  cursor:pointer;
  text-shadow:1px 1px 2px rgba(255,255,255,1);
  -webkit-box-shadow:1px 1px 8px rgba(0,0,0,0.3);
  -moz-box-shadow:   1px 1px 8px rgba(0,0,0,0.3);
  box-shadow:        1px 1px 8px rgba(0,0,0,0.3);
}
.ui-slider .ui-slider-handle:focus {
  outline:none;
}

.credits a {
  position:relative;
  display:inline-block;
  color:#529e0e;
  text-decoration:none;
}
.credits a:after {
  content:'';
  position:absolute;
  left:-1.5%;
  bottom:-1px;
  width:0%;
  height:1px;
  background:#529e0e;
  -webkit-transition:width 0.1s;
  -moz-transition:   width 0.1s;
  -o-transition:     width 0.1s;
  transition:        width 0.1s;
}
.credits a:hover::after {
  width:103%;
}
#amount {
  position:relative;
  display:inline-block;
  padding-bottom:5rem;
  text-align:center;
  font-family: 'Exo', sans-serif;
  font-weight:800;
  font-size:4rem;
  color:#529e0e;
  background:transparent;
  border:none;
}
#amount:focus {outline:none;}
/* base */
#content {
  -webkit-box-sizing:border-box;
  -moz-box-sizing:   border-box;
  box-sizing:        border-box;
  width:100%;
  height:100%;
  padding-top:5rem;
  text-align:center;

}

.ui-slider .ui-slider-handle {
    width: 16px;
    height: 36px;
    margin-left: -5px;
    top: -18px;
    border: none;
    background: white;
    font-size:0rem;
}
.show-lottie{
    display:block !important;
}

</style>

</head>
<body>
  <section class="menu cid-s2zqGqEYp5" once="menu" id="menu1-0">



    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm" style="background:#f0f4f5;">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href=".">
                         <img src="{{url('images/hexagon.svg')}}" alt="SenBill" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap">
                    <a class="navbar-caption text-black display-4" href=".">
                        SENBILL
                    </a>
                </span>
            </div>
        </div>

    </nav>
</section>

<section class="engine"></section><section class="header6 mbr-fullscreen" style="background-image: url({{url('images/3587377.svg')}});"  id="header6-2">



    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(255, 255, 255);">
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-4" style="padding-top: 7%;">
          <div class="row justify-content-md-center">
              <div class="col-md-10">
                  <h2 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style" style="margin: 0 0 25px;font-size: 3rem;">
                      Toutes les factures en une plateforme
                  </h2>
                  <p class="mbr-text align-center pb-3 mbr-fonts-style display-6">
                      SenBill simplifie les paiements de vos factures au Sénégal et en Afrique. Dîtes adieu aux factures impayées ou oubliées.
                  </p>
                  <div class="mbr-section-btn align-center"><a class="btn btn-md btn-primary display-4" href=".">DÉMO LIVE</a>
                          </div>
              </div>
          </div>
          </div>
          <div class="lottie anim col-md-8">
            <lottie-player src="{{url('images/lottie/what.json')}}" id=icon10  background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          </div>
        </div>
    </div>

    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="mbri-down mbr-iconfont"></i>
        </a>
    </div>
</section>

<section class="features6 cid-s2zsdet9N1" id="features6-3">




    <div class="container">
        <div class="media-container-row">

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-img pb-3">
                    <span class="mbri-bootstrap mbr-iconfont"></span>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-7">
                        Votre entreprise est gratuitement intégrée
                    </h4>
                    <p class="mbr-text mbr-fonts-style display-7">
                       SenBill offre un onboarding spécialement conçu pour votre entreprise sans coût. Démarquez vous,  contactez nous et devenez notre partenaire et laissez SenBill apporter de la valeur à votre business.
                    </p>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-img pb-3">
                    <span class="mbri-touch mbr-iconfont"></span>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-7">
                        Vos coûts sont largement réduits et maitrisés
                    </h4>
                    <p class="mbr-text mbr-fonts-style display-7">
                       Les clients reçoivent automatiquement les factures dans leur espace. Vous ne gérez plus de ressources non nécessaires pour des services manuels, coûteux et chronophages.
                    </p>
                </div>
            </div>

            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-img pb-3">
                    <span class="mbri-responsive mbr-iconfont"></span>
                </div>
                <div class="card-box">
                    <h4 class="card-title py-3 mbr-fonts-style display-7">
                        Vos clients sont notifiés ou relancés si nécessaire
                    </h4>
                    <p class="mbr-text mbr-fonts-style display-7">
                       Les clients peuvent suivre leurs factures et sont notifiés des factures impayés. SenBill offre aussi la possibilité de mettre en place des paiements récurrents. Plus d'excuses pour justifier une facture impayée.
                    </p>
                </div>
            </div>



        </div>

    </div>

</section>

<section class="features11 cid-s2zt0G9su6" id="features11-5">





    <div class="container">
        <div class="col-md-12">
            <div class="media-container-row">
                <div class="mbr-figure m-auto" style="width: 50%;">
                    <img src="{{url('whatFolder/assets/images/industries.png')}}" alt="entreprises et industries" title="">
                </div>
                <div class=" align-left aside-content">
                    <h2 class="mbr-title pt-2 mbr-fonts-style display-2">
                      Spécialement adapté à votre entreprise
                    </h2>
                    <div class="mbr-section-text">
                        <p class="mbr-text mb-5 pt-3 mbr-light mbr-fonts-style display-5">
                        Une plateforme dédiée peut être conçue quelque soit le domaine de votre entreprise. SenBill vous accompagne à accroître votre business.
                        </p>
                    </div>

                    <div class="block-content">
                        <div class="card p-3 pr-3">
                            <div class="media">
                                <div class=" align-self-center card-img pb-3">
                                    <span class="mbri-devices mbr-iconfont"></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title mbr-fonts-style display-7">
                                        Digitalisation des factures
                                    </h4>
                                </div>
                            </div>

                            <div class="card-box">
                                <p class="block-text mbr-fonts-style display-7">
                                   Des factures électroniques sont présentées au client avant chaque date d'échéance. Elles restent consultables et téléchargeables par vos clients à tout moment.
                                </p>
                            </div>
                        </div>

                        <div class="card p-3 pr-3">
                            <div class="media">
                                <div class="align-self-center card-img pb-3">
                                    <span class="mbri-drag-n-drop2 mbr-iconfont"></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="card-title mbr-fonts-style display-7">
                                        Traçabilité des paiements
                                    </h4>
                                </div>
                            </div>

                            <div class="card-box">
                                <p class="block-text mbr-fonts-style display-7">
                                    La collecte de vos paiements est facilité grâce aux moyens de paiement locaux déjà intégrés dans l'espace du client. Le processus de paiement
                                    est transparent pour vous, vous ne gérez plus qu'un tableau de bord pour tous vos paiements.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonials3 cid-s2zttbvYmL" id="testimonials3-7">





    <div class="container">
        <div class="media-container-row">
            <div class="media-content px-3 align-self-center mbr-white py-2">
                <h2 class="mbr-title pt-2 mbr-fonts-style display-2 mbr-black">
                  <strong style="font-weight: 500;">Un</strong> compte, <br/> <strong style="font-weight: 500;">Plusieurs</strong> services
                </h2>
                <p class="mbr-text testimonial-text mbr-fonts-style display-7">
                   L'inscription ne prend que 3 minutes et l'application est simple à utiliser. Vous pouvez retrouver toutes vos factures  en une seule application.
                </p>
                <p class="mbr-author-name pt-4 mb-2 mbr-fonts-style display-7">

                </p>
                <p class="mbr-author-desc mbr-fonts-style display-7">
                   A chaque service, son espace dédiée.
                </p>
            </div>

            <div class="mbr-figure pl-lg-5" style="width: 130%;">
              <img src="{{url('whatFolder/assets/images/mobilepubwoman.png')}}">
            </div>
        </div>
    </div>
</section>

<section class="step2 cid-s2zszP35jl" id="step2-4">





    <div class="container" id="sliderDiv">
        <h2 class="mbr-section-title pb-3 mbr-fonts-style align-center display-2">
            Enrichissez votre espace
        </h2>
        <h3 class="mbr-section-subtitle pb-5 mbr-fonts-style align-center display-5">
            Déplacez le curseur pour voir tous nos services intégrés
        </h3>

          <div class="cube sliderDiv1">
            <div class="a"></div>
            <div class="b"></div>
            <div class="c"></div>
            <div class="d"></div>
            <div id="slider-range-min"></div>
          </div>
          <input type="text" id="amount"/>
          <div>
          <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_B5Myck.json" id=icon10  style=" display:none;width:40%;height:50%;margin-top: -15%;position: absolute; margin-left:-4%"  background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_hNoxLl.json" id=icon20 style=" display:none;width:40%;height:50%;margin-top: -17%;position: absolute;margin-left:8.5%"  background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_RiUyLc.json" id=icon30 style="display:none;width:100%;height:50%;margin-top: -15%;position: absolute;margin-left:17%"  background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_JZgHTl.json" id=icon40 style="display:none;width:35%;height:50%;margin-top: -17%;position: absolute;margin-left:29.5%"  background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          <lottie-player src="https://assets9.lottiefiles.com/datafiles/8u37p2tbCdZBjf4/data.json" id=icon50 style="display:none;width:35%;height:50%;margin-top: -15%;position: absolute;margin-left:42% " background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_nh3GKA.json" id=icon60 style="display:none;width:35%;height:50%;margin-top: -16%;position: absolute;margin-left:54.5% " background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_rgAxjD.json" id=icon70 style="display:none;width:40%;height:50%;margin-top: -15%;position: absolute;margin-left:67% " background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
          <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_d7MXh8.json" id=icon80 style="display:none;width:40%;height:50%;margin-top: -15%;position: absolute;margin-left:83.5% " background="transparent"  speed="1" class="space-logo"   loop  autoplay></lottie-player>
        </div>
        <div class="step-container row justify-content-center">
            <div class="card col-12 col-md-12 separline">
                <div class="step-element">
                    <div class="step-text-content align-center">
                        <h4 class="mbr-step-title pb-3 mbr-fonts-style display-5">
                          Eau, Electricité, Mobile, Internet, Location, Scolarité, Télévision, Sport...
                        </h4>
                        <p class="mbr-step-text mbr-fonts-style display-7">
                            La plateforme SenBill vous permet de voir et payer toutes vos factures via votre mobile ou ordinateur grâce à un seul compte.</p>
                    </div>
                </div>
            </div>














        </div>
    </div>
</section>

<section class="features11 cid-s2zt0G9su6" id="features11-5" style="background-color: #f3f4f6;">





    <div class="container">
        <div class="col-md-12">
            <div class="media-container-row">
                <div class="mbr-figure m-auto" style="width: 70%;">
                    <img src="{{url('whatFolder/assets/images/pcpub.png')}}" alt="Pub PC" title="">
                </div>
                <div class=" align-left aside-content"  style="margin-top: 15%;">
                    <h2 class="mbr-title pt-2 mbr-fonts-style display-2">
                      Vous êtes une entreprise?
                    </h2>
                    <a class="btn btn-sm btn-primary display-4" href="https://www.services2sn.com/#contact">
                        <span class="mbri-calendar mbr-iconfont mbr-iconfont-btn "></span>
                        Demandez un rdv
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="cid-s2ztfY9NDI" id="footer1-6">





    <div class="container">
        <div class="media-container-row content text-white">
            <div class="col-12 col-md-3">
                <div class="media-wrap">
                    <a href="./">
                        <img src="{{url('images/logo-s2sn.png')}}" alt="logo S2SN">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Adresse
                </h5>
                <p class="mbr-text">
                    4 avenue du général leclerc
                    <br>77500, Chelles
                </p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Contacts
                </h5>
                <p class="mbr-text">
                    Site web: www.services2sn.com
                    <br>Phone: +33 (0) 6 25 32 54 45

                </p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Liens  utiles
                </h5>
                <p class="mbr-text">
                    <a class="text-primary" href="./">SenBill</a>
                    <br><a class="text-primary" href="https://www.services2sn.com">Services2sn</a>

                </p>
            </div>
        </div>
        <div class="footer-lower">
            <div class="media-container-row">
                <div class="col-sm-12">
                    <hr>
                </div>
            </div>
            <div class="media-container-row mbr-white">
                <div class="col-sm-6 copyright">
                    <p class="mbr-text mbr-fonts-style display-7">
                        © Copyright 2020 S2SN - Tous droits réservés
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="social-list align-right">
                        <div class="soc-item">
                            <a href="." target="_blank">
                                <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="." target="_blank">
                                <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="." target="_blank">
                                <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                        <div class="soc-item">
                            <a href="." target="_blank">
                                <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <script src="{{url('whatFolder/assets/web/assets/jquery/jquery.min.js')}}"></script>
  <script src="{{url('whatFolder/assets/popper/popper.min.js')}}"></script>
  <script src="{{url('whatFolder/assets/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{url('whatFolder/assets/smoothscroll/smooth-scroll.js')}}"></script>
  <script src="{{url('whatFolder/assets/tether/tether.min.js')}}"></script>
  <script src="{{url('whatFolder/assets/touchswipe/jquery.touch-swipe.min.js')}}"></script>
  <script src="{{url('whatFolder/assets/ytplayer/jquery.mb.ytplayer.min.js')}}"></script>
  <script src="assets/vimeoplayer/jquery.mb.vimeo_player.js')}}"></script>
  <script src="{{url('whatFolder/assets/dropdown/js/nav-dropdown.js')}}"></script>
  <script src="{{url('whatFolder/assets/dropdown/js/navbar-dropdown.js')}}"></script>
  <script src="{{url('whatFolder/assets/theme/js/script.js')}}"></script>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@0.4.0/dist/lottie-player.js"></script>
<script>
 $(document).ready(function() {
   function iconDisplayer(value,maxlength) {
     var i;
     var j;
     for (i = 10; i <= value; i+=10) {
       $('#icon'+i).addClass('show-lottie');
     }
     for (j = value+10; j <= maxlength; j+=10) {
       $('#icon'+j).removeClass('show-lottie');
     }
   }

    $(function() {
       $( "#slider-range-min" ).slider({
         range: "min",
         //value: 40, //changer le width de a,b,c,et d si je change ici
         min: 0,
         max: 80,
         step: 10,

         slide: function( event, ui ) {
           $(".a, .b, .c, .d").width(ui.value*5/4 + "%"); //pour 8 services, je multiplie par 5/4, pour 10 services, je multiplie par 1
          iconDisplayer(ui.value,80);

        },
        change: function( event, ui ) {
          $(".a, .b, .c, .d").width(ui.value*5/4 + "%"); //pour 8 services, je multiplie par 5/4, pour 10 services, je multiplie par 1
         iconDisplayer(ui.value,80);

       }

       });
     });

          var scrollEventHandler = function() {
        	if(isScrolledIntoView(document.getElementById('slider-range-min'))) {
            var val = 0;
             var timer = setInterval(function() {
                 if (val <= 80) {
                     $("#slider-range-min").slider("value", val);
                     val += 10;
                 }
                 else {
                     clearInterval(timer);
                 }
             }, 200);

            unbindScrollEventHandler();
          } else {
          }
        }

        function unbindScrollEventHandler() {
        	$(document).unbind('scroll', scrollEventHandler);
        }

        $(document).scroll(scrollEventHandler);

        function isScrolledIntoView(el) {
            var elemTop = el.getBoundingClientRect().top;
            var elemBottom = el.getBoundingClientRect().bottom;

            var isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
            return isVisible;
        }

  });





</script>
</html>
