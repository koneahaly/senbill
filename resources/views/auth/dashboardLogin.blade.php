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
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>
    <body class="welcome_elektra">
      <div class="s2sn-wrapper-login-container s2sn-js-login" style="background-image: url({{url('images/bare-tree.jpg')}});">
         <div class="s2sn-wrapper-center s2sn-wrapper-center-dashboard s2sn-wrapper-when-footer">
           <img src="{{url('images/logo-elektra-halo.png')}}" alt="logo-elektra" width="auto" height="100" class="s2sn-logo-elektra">
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
            <div class="s2sn-input-group s2sn-input-group-dashboard input-group form-slider-step form-group{{ $errors->has('email') ? ' has-error' : '' }}" id="form-step-1">
             <input type="text" name="email" id="PIN" value="{{ old('email') }}" class="form-control" placeholder="Veuillez saisir votre login ou email" aria-label="Veuillez saisir votre login ou email" required>
             <div class="input-group-prepend">
                         <button class="btn s2sn-js-btn-back" type="reset" value= "Reset" ><span class="fa fa-undo"></span></button>
                     </div>
               </div>
             <div id="form-step-2" class="form-slider-step">
                <div class="s2sn-input-group s2sn-input-group-dashboard input-group">
                    <input type="password" class="form-control" placeholder="Mot de passe" aria-label="Mot de passe" name="password" id="PWD" onkeypress="if(event.keyCode==13){return submitCredentials();}" required>
                    <div class="input-group-append">
                        <button class="btn s2sn-js-btn-next" type="submit" onclick="return submitCredentials();"><span class="fa fa-arrow-right"></span></button>
                     </div>
                </div>
             </div>
            </form>

           </div>

         <script src="{{url('js/jquery.min.js')}}"></script>
         <script src="{{url('js/popper.min.js')}}"></script>
         <script src="{{url('js/bootstrap.min.js')}}"></script>

    </div>
    </body>
</html>
