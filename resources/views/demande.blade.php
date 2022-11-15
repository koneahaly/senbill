<?php
session_start();
$notification = (isset($_SESSION["numberOfBillsNonPaid"])) ? $_SESSION["numberOfBillsNonPaid"] : '';
if (!empty(Auth::user()->date_activation_code)) $_SESSION['profilNotif'] = 0;
?>
@extends('layouts.app', ['notification' => $notification, 'service' => $_SESSION['current_service'], 'services' => $actived_services, 'profilNotif' => $_SESSION['profilNotif']])

@section('content')

<div class="container">
  <div class="row lottie-lines" style="margin-top:4%;">
  </div>
  <div class="row rowmobile" style="margin-top:10%;z-index: 1100;">
  <div class="col-md-12" style="margin-top:10px;margin-bottom:20px;text-align:center;">
   <h3><strong> Détails de la demande</strong></h3>
 </div>

 @if(!empty($message))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Félicitations {{ Auth::user()->first_name }}!</strong> {{ $message }}.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 @endif
 @if(!empty($error_message))
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
   <strong>Oups!</strong> {{ $error_message }}.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
   </button>
 </div>
 @endif

  </div>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 80px; height: 80px; position:absolute;z-index:1000;margin-left:-8%;margin-top: 15%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 100px; height: 100px; position:absolute;z-index:1000;margin-left:80%;margin-top: -1.5%;"  loop  autoplay></lottie-player>
  <lottie-player src="{{url('images/lottie/bubble.json')}}" class="lottie-bubbles" background="transparent"  speed="1"  style="width: 60px; height: 60px; position:absolute;z-index:1000;margin-left:1%;margin-top: -2%;"  loop  autoplay></lottie-player>

<ul class="pager">
  <li class="previous"><a href="/mes-demandes/servicepublic"><span aria-hidden="true">&laquo;</span> Previous</a></li>
</ul>
    <div class="row" style="margin-top:50px">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default personalInfoPanel">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                      <div class="row" style="margin-bottom:35px">
                        <div class="col-md-7" style="font-size:18px"> <strong>Informations personnelles du demandeur</strong></div>
                      </div>

                  @if(!isset($_POST['update_perso_data']))
                    <div class="col-md-12" style="margin-bottom:10px">
                      <p><strong>CIVILITE</strong></p>
                      <span class="recapData">{{ Auth::user()->civilite }}</span>
                    </div>
                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>PRENOM</strong></p>
                    <span class="recapData">{{ $infos_dem->first_name }}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>NOM</strong></p>
                    <span class="recapData">{{ $infos_dem->last_name }}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>CNI</strong></p>
                    <span class="recapData">{{$infos_dem->customer_id}}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>DATE DE NAISSANCE</strong></p>
                    <span class="recapData">{{ Carbon\Carbon::parse($infos_dem->dob)->locale('fr')->translatedFormat('d F Y') }}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>LIEU DE NAISSANCE</strong></p>
                    <span class="recapData">{{$infos_dem->pob}}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>TELEPHONE</strong></p>
                    <span class="recapData">{{$infos_dem->phone}}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>EMAIL</strong></p>
                    <span class="recapData">{{$infos_dem->email}}</span>
                  </div>


                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>ADRESSE</strong></p>
                    <span class="recapData">{{$infos_dem->physical_address}}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>NOM DU PERE</strong></p>
                    <span class="recapData">{{$infos_dem->father_last_name}}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>PRENOM DU PERE</strong></p>
                    <span class="recapData">{{$infos_dem->father_first_name}}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>NOM DE LA MERE</strong></p>
                    <span class="recapData">{{$infos_dem->mother_last_name}}</span>
                  </div>

                  <div class="col-md-6" style="margin-bottom:10px">
                    <p><strong>PRENOM DE LA MERE</strong></p>
                    <span class="recapData">{{$infos_dem->mother_first_name}}</span>
                  </div>
                  @endif

                </div>
            </div>

            <div class="panel panel-default personalInfoPanel">
              <div class="panel-body">
                <div class="row" style="margin-bottom:35px">
                  <div class="col-md-7" style="font-size:18px"> <strong>Les informations de ma demande </strong></div>
                </div>



                    <div class="col-md-6" style="margin-bottom:10px">
                      <p><strong>TYPE DE SERVICE</strong>
                      </p>
                      <span class="recapData">{{ $infos_dem->request_service_type }}</span>
          
                    </div>
                    <input type="hidden" name="update_email" value="true"/>


                    <div class="col-md-6" style="margin-bottom:10px">
                        <p><strong>NOM DU SERVICE</strong>
                        </p>
                      <span class="recapData">{{ $infos_dem->label }}</span>
                    </div>

                    <div class="col-md-6" style="margin-bottom:10px">
                        <p><strong>TYPE DE DEMANDE</strong>
                        </p>
                      <span class="recapData">{{ $infos_dem->sp_label }}</span>
                    </div>

                    <div class="col-md-6" style="margin-bottom:10px">
                        <p><strong>DATE DE LA DEMANDE</strong>
                        </p>
                      <span class="recapData">{{ Carbon\Carbon::parse($infos_dem->created_at)->locale('fr')->translatedFormat('d F Y à H\hi') }}</span>
                    </div>

                    <div class="col-md-6" style="margin-bottom:10px">
                        <p><strong>ADRESSE DU SERVICE</strong>
                        </p>
                      <span class="recapData">{{ $infos_dem->sp_physical_address }}</span>
                    </div>

                    <div class="col-md-6" style="margin-bottom:10px">
                        <p><strong>EMAIL DU SERVICE</strong>
                        </p>
                      <span class="recapData">{{ $infos_dem->sp_email }}</span>
                    </div>

                    <div class="col-md-6" style="margin-bottom:10px">
                        <p><strong>TELEPHONE DU SERVICE</strong>
                        </p>
                      <span class="recapData">{{ $infos_dem->sp_phone }}</span>
                    </div>



            </div>
        </div>
        <!-- les pièces jointes -->

        <div class="panel panel-default personalInfoPanel contractContentMobile">
          <div class="panel-body">
          
            <div class="row" style="margin-bottom:35px">
              <div class="col-md-6" style="font-size:18px"> <strong>Mes pièces jointes</strong></div>
            </div>
            <div class="wrap-input100 input100-select col-md-6">
            <ul>
            @foreach($infos_pj as $img_)
              @if($img_->id > 0)
              <li>
                <a href="{{ $img_->pj_link }}" download>{{ $img_->pj_name }} </a>
              </li>
              @endif
            @endforeach
            </ul>
        </div>
    </div>

    </div>
</div>
</div>


@endsection

@section('scripts')
      <!--=============DROPZONE SCRIPT============-->
<script src="{{ url('/js/dropzone/jquery.js') }}"></script>
<script src="{{ url('/js/dropzone/dropzone.js') }}"></script>
<script>
$(document).ready(function () {
      var total_photos_counter = 0;
      var name = "";
  
  var new_img_modif = {};
  var img_id_m = {};
  var index = 0;
  var idx = 0;
    
    $(".modify_image").each(function(index) {
      new_img_modif[index] = $(this).val();

      console.log('gill');
      console.log(new_img_modif[index]);
    });

    $(".image_id").each(function(idx) {
      img_id_m[idx] = $(this).val();
    });


    $("#dZUploadMd").dropzone({
      headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
        method: "POST",
        url: "{{ route('mes-demandes') }}",
        uploadMultiple: false,
        autoProcessQueue: true,
        parallelUploads: 4,
        maxFilesize: 16,
        addRemoveLinks: true,
        removedfile: function(file) {
          var fileName = file.name;
          var image_id = fileName.split(' ');
          console.log(image_id[1]);
          $.ajax({
            type: 'POST',
            headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
            url: "{{ route('mes-images.delete') }}",
            data: {name: fileName,request: 'delete',image_id: image_id[1]},
            sucess: function(data){
                console.log('success: ' + data);
            }
          });
          var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        dictRemoveFile: "Enlever l'image",
        dictFileTooBig: "L'image est supérieure à 16 Mo",
        timeout: 10000,
        renameFile: function (file) {
        name = new Date().getTime() + Math.floor((Math.random() * 100) + 1) + '_' + file.name;
        return name;
      },
        
    init: function () {
        var myDropzone = this;
        // Create the mock file:
        for (pic in new_img_modif){
          var img = new Image();
          img.size = 12345;
          img.src = pic;
          console.log('good');
          console.log(pic);
          img.name = 'Photo';
          img.height = 944;
          img.width = 698;

          // Call the default addedfile event handler
          myDropzone.emit("addedfile", img);

          // And optionally show the thumbnail of the file:
          myDropzone.emit("thumbnail", img, img.src);

          myDropzone.emit("complete", img);
          $('img').css({"max-width": "100%", "max-height": "100%"});
          $('.dz-image').css({"width": "120", "height": "120"});

        }



        this.on("sending", function(file, xhr, formData){
            $('#update_logement').find('input').each(function() {
                formData.append( $(this).attr('name'), $(this).val() );
            });
        });
        this.on("success", function(file, response) {
          $('.dz-image').css({"width":"100%", "height":"auto"});
          var imgName = response;
            file.previewElement.classList.add("dz-success");
            console.log("Successfully uploaded :" + imgName);
            total_photos_counter++;
            $("#counter").text("# " + total_photos_counter + "  images(s) au total" );
            file["customName"] = name;
            console.log(response);
        });
        this.on("error", function(file, response) {
          console.log(response);
          file.previewElement.classList.add("dz-error");
        });
      
    },
      
    });
});
</script>

@endsection