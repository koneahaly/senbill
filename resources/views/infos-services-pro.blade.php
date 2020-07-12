<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
?>
@extends('layouts.realEstate', ['notification' => $notification, 'services' => $actived_services])

@section('content')


<div class="container">
  <div class="row rowloc rowmobile" style="margin-top:14%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
   <h3><strong>Mes services</strong></h3></div>
  </div>

    <div class="row" style="margin-top:50px;z-index: 1100;">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default personalInfoPanel">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="msform" class="form-horizontal" method="POST" action="{{ route('infos-services-pro.update') }}">
                      {{csrf_field()}}
                      <fieldset class="f3">
                          <div class="form-card">
                              <div class="row">
                                  <div class="col-7">
                                      <img alt="" class="form-image"  src="{{url('images/undraw_location_review_dmxd.png')}}" height="270px" width="318px" data-component="image">

                                  </div>
                                  <div class="col-5">
                                      <!-- <h2 class="steps">Step 3 - 4</h2> -->
                                  </div>
                              </div>
                          </div>
                          <div class="radio-group row justify-content-between px-3" style="margin-left: 10%;">
                             <div class="card-block card-body selectRegister1 {{ (empty($actived_services->service_1) || $actived_services->service_1 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_1) || $actived_services->service_1 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-faucet fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Eau</h5>
                                 </div>
                                 @if(!empty($actived_services->service_1) && $actived_services->service_1 != 'NULL')
                                  <input class='service_1' type='hidden' name='service_1' value='eau' />
                                  @endif
                             </div>
                             <div class="card-block card-body selectRegister2 {{ (empty($actived_services->service_2) || $actived_services->service_2 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_2) || $actived_services->service_2 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-plug fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Electricité</h5>
                                 </div>
                                 @if(!empty($actived_services->service_2) && $actived_services->service_2 != 'NULL')
                                  <input class='service_2' type='hidden' name='service_2' value='electricite' />
                                  @endif
                             </div>
                             <div class="card-block card-body selectRegister3 {{ (empty($actived_services->service_3) || $actived_services->service_3 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_3) || $actived_services->service_3 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-tv fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Television</h5>
                                 </div>
                                 @if(!empty($actived_services->service_3) && $actived_services->service_3 != 'NULL')
                                  <input class='service_3' type='hidden' name='service_3' value='tv' />
                                  @endif
                             </div>
                             <div class="card-block card-body selectRegister4 {{ (empty($actived_services->service_4) || $actived_services->service_4 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_4) || $actived_services->service_4 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-mobile-alt fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Mobile & Internet</h5>
                                 </div>
                                 @if(!empty($actived_services->service_4) && $actived_services->service_4 != 'NULL')
                                  <input class='service_4' type='hidden' name='service_4' value='mobile' />
                                  @endif
                             </div>
                             <div class="card-block card-body selectRegister5 {{ (empty($actived_services->service_5) || $actived_services->service_5 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_5) || $actived_services->service_5 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-building fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Locataire</h5>
                                 </div>
                                 @if(!empty($actived_services->service_5) && $actived_services->service_5 != 'NULL')
                                  <input class='service_5' type='hidden' name='service_5' value='locataire' />
                                  @endif
                             </div>
                             <div class="card-block card-body selectRegister6 {{ (empty($actived_services->service_6) || $actived_services->service_6 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_6) || $actived_services->service_6 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-building fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Propriétaire</h5>
                                 </div>
                                 @if(!empty($actived_services->service_6) && $actived_services->service_6 != 'NULL')
                                  <input class='service_6' type='hidden' name='service_6' value='proprietaire' />
                                  @endif
                             </div>
                             <div class="card-block card-body selectRegister7 {{ (empty($actived_services->service_7) || $actived_services->service_7 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_7) || $actived_services->service_7 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-university fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Scolarité</h5>
                                 </div>
                                 @if(!empty($actived_services->service_7) && $actived_services->service_7 != 'NULL')
                                  <input class='service_7' type='hidden' name='service_7' value='scolarite' />
                                  @endif
                             </div>
                             <div class="card-block card-body selectRegister8 {{ (empty($actived_services->service_8) || $actived_services->service_8 == 'NULL') ? '' : 'selected' }}">
                                 <div class="row justify-content-end d-flex px-3">
                                     <div class="fa fa-{{ (empty($actived_services->service_8) || $actived_services->service_8 == 'NULL') ? 'circle' : 'check' }}"></div>
                                 </div>
                                 <div class="row justify-content-center d-flex">
                                     <div class="pic"> <i class="fas fa-running fa-5x pic-0" style="margin-left:25%;"></i> </div>
                                     <h5 class="mb-4" style="color:black;text-align:center;">Sport</h5>
                                 </div>
                                 @if(!empty($actived_services->service_8) && $actived_services->service_8 != 'NULL')
                                  <input class='service_8' type='hidden' name='service_8' value='sport' />
                                  @endif
                             </div>
                             <div class="row justify-content-center" style="margin-left: -10%;">
                                 <div class="col-7 text-center">
                                     <input type='submit' name='action' class='btn btn-primary submitForm' value='Enregistrer' />
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

  $('.radio-group .selectRegister5').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_5').remove();
    $(this).removeClass('selected');
    $('.display_service_5').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister5').append("<input class='service_5' type='hidden' name='service_5' value='locataire' />");
    var value = $('.service_5').val();
    $('.display_service_5').text(value);
  }
  });

  $('.radio-group .selectRegister6').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_6').remove();
    $(this).removeClass('selected');
    $('.display_service_6').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister6').append("<input class='service_6' type='hidden' name='service_6' value='proprietaire' />");
    var value = $('.service_6').val();
    $('.display_service_6').text(value);
  }
  });

  $('.radio-group .selectRegister7').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_7').remove();
    $(this).removeClass('selected');
    $('.display_service_7').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister7').append("<input class='service_7' type='hidden' name='service_7' value='scolarite' />");
    var value = $('.service_7').val();
    $('.display_service_7').text(value);
  }
  });

  $('.radio-group .selectRegister8').click(function(){
  if($(this).hasClass('selected')){
      $(this).find(".fa").removeClass('fa-check');
      $(this).find(".fa").addClass('fa-circle');
      $('.service_8').remove();
    $(this).removeClass('selected');
    $('.display_service_8').text('');
  }
  else {
    $(this).addClass('selected');
    $('.selected .fa').removeClass('fa-circle');
    $('.selected .fa').addClass('fa-check');
    $('.selectRegister8').append("<input class='service_8' type='hidden' name='service_8' value='sport' />");
    var value = $('.service_8').val();
    $('.display_service_8').text(value);
  }
  });

</script>

@endsection
