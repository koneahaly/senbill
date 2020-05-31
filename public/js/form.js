$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var myEmail, myPassword, myPasswordConfirm; //fields step 1
var myFistName, myLastName, myCNI, myPhone, myAddress; //fields step 2
var myService_1, myService_2, myService_3, myService_4; //fields step 3

var opacity;
var current = 1;
var steps = $("fieldset").length;


setProgressBar(current);

$(".sv_1").click(function(){

myEmail = $('#email').val();
myPassword = $('#password').val();
myPasswordConfirm = $('#password-confirm').val();

current_fs = $(this).parent();
next_fs = $(this).parent().next();

if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myEmail)){
  myEmail = myEmail;

  if(/^(?=.*[0-9])[a-zA-Z0-9]{7,15}$/.test(myPassword)){
    myPassword = myPassword;
  }
  else{
    $('#password').css("border","1px solid red");
    $("#password")
          .popover({content: "Le mot de passe doit contenir 7 caractères ou plus avec un chiffre au moins.",placement:'top' });
    $("#password").popover('show');
    $("#password").blur(function(){
      $("#password").popover('hide');
  });
  }

}
else{
  $('#email').css("border","1px solid red");
  $("#email")
        .popover({content: "L'adresse mail n'est pas valide.",placement:'top' });
  $("#email").popover('show');
  $("#email").blur(function(){
    $("#email").popover('hide');
    $('#email').css("border","1px solid #ccc");
});
}


if(myPasswordConfirm != myPassword){
  $('#password-confirm').css("border","1px solid red");
  $("#password-confirm")
        .popover({content: "Les deux mots de passe ne sont pas identiques.",placement:'top' });
  $("#password-confirm").popover('show');
  $("#password-confirm").blur(function(){
    $("#password-confirm").popover('hide');
});
}


if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myEmail) && /^(?=.*[0-9])[a-zA-Z0-9]{7,15}$/.test(myPassword) && myPasswordConfirm == myPassword){
  //Add Class Active
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
  step: function(now) {
  // for making fielset appear animation
  opacity = 1 - now;

  current_fs.css({
  'display': 'none',
  'position': 'relative'
  });
  next_fs.css({'opacity': opacity});
  },
  duration: 500
  });
  setProgressBar(++current);
}
});

$(".sv_2").click(function(){

myFistName = $('.first_name').val();
myLastName = $('.name').val();
myCNI = $('.cni').val();
myPhone = $('.phone').val();
myAddress = $('.address').val();
const regexAddr = RegExp("^[0-9]{1,3}(([,. ]?){1}[-a-zA-Zàâäéèêëïîôöùûüç']+)*$");
const regexPhone = RegExp('^(\\+[1-9]{1}[0-9]{3,14}) |([0-9]{9,14})$');


current_fs = $(this).parent();
next_fs = $(this).parent().next();

if(/^[a-zA-Z ]{2,30}$/.test(myFistName)){
  myFistName = myFistName;

  if(/^[a-zA-Z ]{2,30}$/.test(myLastName)){
    myLastName = myLastName;


    if(/^\d{13}$/.test(myCNI)){
      myCNI = myCNI;


      if(regexPhone.test(myPhone)){
        myPhone = myPhone;


        if(regexAddr.test(myAddress)){
          myAddress = myAddress;
        }

        else{
          $('.address').css("border","1px solid red");
          $(".address")
                .popover({content: "L'adresse fournie n'est pas valide.",placement:'top' });
          $(".address").popover('show');
          $(".address").blur(function(){
            $(".address").popover('hide');
        });
        }
      }

      else{
        $('.phone').css("border","1px solid red");
        $(".phone")
              .popover({content: "Le numéro de téléphone fourni n'est pas valide." ,placement:'top'});
        $(".phone").popover('show');
        $(".phone").blur(function(){
          $(".phone").popover('hide');
      });
      }
    }

    else{
      $('.cni').css("border","1px solid red");
      $(".cni")
            .popover({content: "Le numéro d'identification fourni n'est pas valide.",placement:'top' });
      $(".cni").popover('show');
      $(".cni").blur(function(){
        $(".cni").popover('hide');
    });
    }
  }

  else{
    $('.name').css("border","1px solid red");
    $(".name")
          .popover({content: "Le nom fourni n'est pas valide." ,placement:'top'});
    $(".name").popover('show');
    $(".name").blur(function(){
      $(".name").popover('hide');
  });
  }
}

else{
  $('.first_name').css("border","1px solid red");
  $(".first_name")
        .popover({content: "Le prénom fourni n'est pas valide." ,placement:'top'});
  $(".first_name").popover('show');
  $(".first_name").blur(function(){
    $(".first_name").popover('hide');
});
}



if(/^[a-zA-Z ]{2,30}$/.test(myFistName) && /^[a-zA-Z ]{2,30}$/.test(myLastName) && /^\d{13}$/.test(myCNI) && regexPhone.test(myPhone) && regexAddr.test(myAddress)){
  //Add Class Active
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
  step: function(now) {
  // for making fielset appear animation
  opacity = 1 - now;

  current_fs.css({
  'display': 'none',
  'position': 'relative'
  });
  next_fs.css({'opacity': opacity});
  },
  duration: 500
  });
  setProgressBar(++current);
}
});


$(".sv_3").click(function(){

myService_1 = $('.service_1').val()+'wt';
myService_2 = $('.service_2').val()+'wt';
myService_3 = $('.service_3').val()+'wt';
myService_4 = $('.service_4').val()+'wt';


current_fs = $(this).parent();
next_fs = $(this).parent().next();


if(myService_1 != 'undefinedwt' || myService_2 != 'undefinedwt' || myService_3 != 'undefinedwt' || myService_4 != 'undefinedwt'){ // undefined + wt
  //Add Class Active
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
  step: function(now) {
  // for making fielset appear animation
  opacity = 1 - now;

  current_fs.css({
  'display': 'none',
  'position': 'relative'
  });
  next_fs.css({'opacity': opacity});
  },
  duration: 500
  });
  setProgressBar(++current);
}
else{
  $('.card-body').css("border","4px solid red");

}
});


$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 500
});
setProgressBar(--current);
});

function setProgressBar(curStep){
var percent = parseFloat(100 / steps) * curStep;
percent = percent.toFixed();
$(".progress-bar")
.css("width",percent+"%")
}

$(".submit").click(function(){
return false;
})

});
