
<!DOCTYPE html>
<html lang="zxx">
<head>
<title>Gathering Log In form Responsive Widget Template :: W3layouts</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8" />
<!-- //Meta tag Keywords -->
<link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">
<!--/Style-CSS -->
<link rel="stylesheet" href="css/style1.css" type="text/css" media="all" />
<!--//Style-CSS -->
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
</head>
<body>
<div class="w3l-signinform">
<!-- container -->
<div class="wrapper">
<!-- main content -->
<div class="w3l-form-info">
<div class="w3_info">
    <h1>Welcome Back</h1>
    <p class="sub-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    <h2>Log In</h2>
    <div id="success"></div>
    <form action="#" id="login-form" method="">
        <div class="input-group">
            <span><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="email"name="email" placeholder="Username" >
            <strong id="errorEmail"></strong>
        </div>
        <div class="input-group two-groop">
            <span><i class="fa fa-key" aria-hidden="true"></i></span>
            <input type="Password" placeholder="Password" name="password">
            <strong id="errorPassword" ></strong>
        </div>
        <div class="form-row bottom">
            <div class="form-check">
                <input type="checkbox" id="remenber" name="remenber" value="remenber">
                <label for="remenber"> Remember me?</label>
            </div>
            <a href="#url" class="forgot">Forgot password?</a>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Log In</button>
    </form>

    <p class="account">Don't have an account? <a href="register.php">Register</a></p>
</div>
</div>
<!-- //main content -->
</div>
<!-- //container -->
<!-- footer -->
<div class="footer">
<p>&copy; 2021 Gathering Log In form. All Rights Reserved | Design by <a href="https://w3layouts.com/"
    target="blank">W3layouts</a></p>
</div>
<!-- footer -->
</div>

</body>
<script src="js/jquery.js"></script>
<script>
$(document).ready(function () {
$('#login-form').submit(e => {
e.preventDefault();

const formData = new FormData(e.target);
$.ajax({
url: 'login',
type: 'POST',
data: formData,
processData: false,
contentType: false,
dataType:'json',
success: function(response) {
if (response.status == 'success') {
    $('#success').text(response.message).addClass('alert alert-success');
}
else{
$('#errorEmail').html(response.emailError);
$('#errorPassword').html(response.passwordError);
}
setTimeout(() => {
        
			$("#errorEmail").html("");
			$("#errorPassword").html("");
			$("#message").html("");
			$("#message").removeClass("alert");
        }, 4000);
	

}

})

})

})  

</script>

</html>