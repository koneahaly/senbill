<form method="post" action="success" onsubmit="return submitUserForm();">
    <div class="g-recaptcha" data-sitekey="6LczmscaAAAAAOwZPalRHwqIp_cvTPHt6z0qJUVn" data-callback="verifyCaptcha"></div>
    <div id="g-recaptcha-error"></div>
    <input type="submit" name="submit" value="Submit" />
</form>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
var recaptcha_response = '';
function submitUserForm() {
    if(recaptcha_response.length == 0) {
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
        return false;
    }
    return true;
}
 
function verifyCaptcha(token) {
    recaptcha_response = token;
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
</script>