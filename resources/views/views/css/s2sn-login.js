$(document).ready(function(){

	//$(" .ols-input-group i.fa-times, .ols-js-x-1, .ols-js-x-2, .ols-js-x-3").hide();
    //$(".ols-js-login #form-step-2").hide();
    //$(".ols-js-login .ols-keyboard-list").hide();
    //$(".ols-js-login #form-step-2 .ols-input-group i").hide();

    //simple jquery just to show fonctionnality
    /*$(".ols-js-login #form-step-1 .ols-js-btn-next").on("click", function( event ){
        event.preventDefault();
        $("#form-step-2").show();
        if ($("#form-step-1 .ols-js-btn-next").html() == "Go") {
            $("#form-step-2").show();
            $("#form-step-1 .ols-js-btn-next").html(" <i class='fas fa-undo-alt'></i> ");
            $("#form-step-1 .form-control").prop('readonly', true);
        } else {
            $("#form-step-1 .ols-js-btn-next").html("Go");
            $("#form-step-2").hide();
            $("#form-step-1 .form-control").prop('readonly', false);
        }

    });*/

    $(window).on("scroll", function() {
    		if($(window).scrollTop() > 50) {
    				$(".ols-login-header-desktop").addClass("active");
    		} else {
    				//remove the background property so it comes transparent again (defined in your css)
    			 $(".ols-login-header-desktop").removeClass("active");
    		}
    });





/*$( "#form-step-2 input" ).focusin(function() {
    $(".ols-js-login .ols-keyboard-list").show();
});


$( "#form-step-2 input" ).keyup(function() {
    if($(".ols-js-login #form-step-2 input").val() != "" ){
        $(".ols-js-login #form-step-2 .ols-input-group i.fa-times").show();
    }
});

function checkValue( number ) {
    if($(".ols-js-change-password #form-step-"+number+" input").val() != "" ){
        $( ".ols-js-x-"+number ).show();
    }
}

function deleteInputValue( icon, field ) {
    $( icon ).on("click", function( event ){
        //console.log("toto")
        event.preventDefault();
        event.stopPropagation();
        $( field ).val("");
        $(this).hide();
        if(document.forms['frmLogin']!=null){
        	document.forms['frmLogin'].elements['PWD'].value = "";
        	PWD_DISPLAY_VALUE="";
        	document.getElementById("PWD_DISPLAY").value = "";
        }

        if(icon == ".ols-js-x-1"){
        	if(document.forms['changepwdForm'].elements['PWDA']!=null){
            	PWD_DISPLAY_VALUE1 = "";
            	document.getElementById("ancien").value = "";
            	document.forms['changepwdForm'].elements['PWDA'].value="";

            }
        }

        if(icon == ".ols-js-x-2"){

        	if(document.forms['changepwdForm'].elements['PWDC']!=null){
            	PWD_DISPLAY_VALUE3 = "";
            	document.getElementById("confirmation").value = "";
            	document.forms['changepwdForm'].elements['PWDC'].value="";

            }
        }

        if(icon == ".ols-js-x-3"){

        	if(document.forms['changepwdForm'].elements['PWDN']!=null){
            	PWD_DISPLAY_VALUE2 = "";
            	document.getElementById("nouveau").value = "";
            	document.forms['changepwdForm'].elements['PWDN'].value="";
            }
        }


    });
}

$(".ols-keyboard-list li").on("click", function( event ){
    event.stopPropagation();

    if($(".ols-js-login #form-step-2 input").val() != "" ){
        $(".ols-js-login .ols-input-group i.fa-times").show();
    }
    checkValue("1");
    checkValue("2");
    checkValue("3");
});

deleteInputValue(".ols-js-login #form-step-2 .ols-input-group i.fa-times", ".ols-js-login #form-step-2 input");
deleteInputValue(".ols-js-x-1", ".ols-js-change-password #form-step-1 input");
deleteInputValue(".ols-js-x-2", ".ols-js-change-password #form-step-2 input");
deleteInputValue(".ols-js-x-3", ".ols-js-change-password #form-step-3 input");

//just for example change password page. to do : create functions
$(".ols-js-change-password #form-step-2, .ols-js-change-password #form-step-3").hide();

$(".ols-js-change-password #form-step-1 .ols-js-btn-next").on("click", function( event ){
    event.preventDefault();
    $("#form-step-3").show();
    if ($("#form-step-1 .ols-js-btn-next").html() == "Go") {
        $("#form-step-3").show();
        $("#form-step-1 .ols-js-btn-next").html(" <i class='fas fa-undo-alt'></i> ");
    } else {
        $("#form-step-1 .ols-js-btn-next").html("Go");
        $("#form-step-3").hide();
        $("#form-step-2").hide();
    }
});

$(".ols-js-change-password #form-step-3 .ols-js-btn-next").on("click", function( event ){
    event.preventDefault();
    $("#form-step-2").show();
    if ($("#form-step-3 .ols-js-btn-next").html() == "Go") {
        $("#form-step-2").show();
        $("#form-step-3 .ols-js-btn-next").html(" <i class='fas fa-undo-alt'></i> ");
        $(".ols-js-change-password #form-step-1 .ols-js-btn-next").hide();
    } else {
        $("#form-step-3 .ols-js-btn-next").html("Go");
        $("#form-step-2").hide();
        $(".ols-js-change-password #form-step-1 .ols-js-btn-next").show();
    }
});*/
});
