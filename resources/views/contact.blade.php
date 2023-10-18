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
.rentwelcome
{
    background-color: #0c0319;
    color:white;
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    z-index: 0;
    pointer-events: none;
}
.custom-shape-divider-bottom-1606678211 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-bottom-1606678211 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 150px;
}

.custom-shape-divider-bottom-1606678211 .shape-fill {
    fill: #EFEFEF;
}
.cid-s2zsdet9N1 {
  background-color: rgb(241, 242, 245);
}
.text_contact {
    margin-left: -20%;
    padding-top: 10%;
}

.cid-s5anz4skym {
  background-image: url("../../../assets/images/background4.jpg");
}
.cid-sikoFCOI6U {
  padding-top: 90px;
  padding-bottom: 90px;
  background-color: #ffffff;
}
.cid-sikoFCOI6U .title {
  padding-bottom: 2.5rem;
}
.cid-sikoFCOI6U .mbr-text {
  color: #767676;
  margin: 0;
  padding-top: 0.5rem;
}
.cid-sikoFCOI6U .iconfont-wrapper {
  display: flex;
  align-items: center;
  width: 2rem;
  height: 2rem;
  margin-right: 2rem;
}
.cid-sikoFCOI6U .iconfont-wrapper .amp-iconfont {
  font-size: 2rem;
}
.cid-sikoFCOI6U .wrapper {
  display: flex;
  padding: 1rem 0;
}
.cid-sikoFCOI6U .wrapper .b-info {
  width: 100%;
}
@media (max-width: 767px) {
  .cid-sikoFCOI6U .iconfont-wrapper {
    display: none;
  }
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

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
            </ul>
        </div>

    </nav>
</section>
<section class="mbr-section contacts3 cid-sikoFCOI6U" id="contacts3-6">
    <!---->
    
    <!---->
    <!--Overlay-->
    
    <!--Container-->
    <div class="container">
        <div class="row">
            <!--Titles-->
            <div class="title col-12">
                <h2 class="align-left mbr-fonts-style display-1">
                    Nos Contacts
                </h2>
                
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="wrapper">
                            <span class="iconfont-wrapper">
                                <span class="amp-iconfont icon fa-thumbs-o-up fa"></span>
                            </span>
                            <div class="b-info b-adress">
                                <h5 class="align-left mbr-fonts-style display-5">
                                    Siège:
                                </h5>
                                <p class="mbr-text align-left mbr-fonts-style display-7">
                                    Dakar, Sénégal
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="wrapper">
                            <span class="iconfont-wrapper">
                                <span class="amp-iconfont icon fa-phone fa"></span>
                            </span>
                            <div class="b-info b-phone">
                                <h5 class="align-left mbr-fonts-style display-5">
                                    Appelez nous:
                                </h5>
                                <p class="mbr-text align-left mbr-fonts-style display-7">
                                    +221781947400
                                </p>
                                <p class="mbr-text align-left mbr-fonts-style display-7">
                                    +33625325445
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="wrapper">
                            <span class="iconfont-wrapper">
                                <span class="amp-iconfont icon fa-comment-o fa"></span>
                            </span>
                            <div class="b-info b-mail">
                                <h5 class="align-left mbr-fonts-style display-5">
                                   Envoyez nous un e-mail:
                                </h5>
                                <p class="mbr-text align-left mbr-fonts-style display-7">
                                    contact@services2sn.com
                                </p>
                                <p class="mbr-text align-left mbr-fonts-style display-7">
                                    admin@services2sn.com
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="wrapper">
                            <span class="iconfont-wrapper">
                                <span class="amp-iconfont icon fa-th-large fa"></span>
                            </span>
                            <div class="b-info b-mail">
                                <h5 class="align-left mbr-fonts-style display-5">
                                    Horaires:
                                </h5>
                                <p class="mbr-text align-left mbr-fonts-style display-7">
                                   Support 24h/24
                                   7j/7
                                </p>
                            </div>
                        </div>
                    </div>
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
                    Site web: https://www.services2sn.com
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

  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-7f4df5c8-975b-47dc-b530-174427a6e7a2"></div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@0.4.0/dist/lottie-player.js"></script>
</html>
