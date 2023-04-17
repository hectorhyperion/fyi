 
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>EUPHONY</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <!-- //Meta tag Keywords -->
    <link href="//fonts.googleapis.com/css2?family=Kumbh+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style1.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
    <div class="w3l-signinform">
        <!-- container -->
        <div class="wrapper">
            <!-- main content -->
            <div class="w3l-form-info">
                <div class="w3_info">
                    <h1><a href="home.php">Welcome LOGIN </a></h1>
    <p class="sub-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                    <h2>Sign In</h2>
                    <div id="message"></div>
                    <form action="#" id="login-form">
                     
                        <div class="input-group">
                            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" name="email" placeholder=" Email" >
                            <small style="color:lavenderblush" id="email"></small>
                        </div>
                         
                        <div class="input-group two-groop">
                            <span><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="Password" name="password" placeholder="Password" >
                            <small style="color:lavenderblush" id="password"></small>
                        </div>
                        
                        <button class="btn btn-primary btn-block" type="submit">Sign IN </button>
                    </form>
                
                    <p class="account"> have an account? <a href="register.php">SignUp</a></p>
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
<script >
$(document).ready(function(){
	let btnDis = false
$('#login-form').submit(el => {
	
el.preventDefault()
btnDis = btnDis ? false : true;
    $(`#button-txt`).toggle();
    $(`#button-spinner`).toggle();
    btnDis
        ? $(`#submit-btn`).attr("disabled", true)
        : $(`#submit-btn`).removeAttr("disabled");
const formData = new FormData(el.target,);
$.ajax({
type: 'POST',
url: 'login',
data:formData,
processData: false,
contentType: false,
dataType: 'json',
success: function(response) {
        console.log(response);
if (response.status = 'success') {
    window.location.href = "home.php";
// Display the success message on the HTML pages
if (response.indexOf("success") !== -1) {
            // Redirect to home page
            window.location.href = "home.php";
        } else {
            // Display error message
            $("#error-message").html(response);
        }
}
else {
	btnDis = btnDis ? false : true;
    $(`#button-txt`).toggle();
    $(`#button-spinner`).toggle();
		  $('#email').html(response.emailError)
		  $('#password').html(response.passwordError)
		}
		setTimeout(() => {
            $("#email").html("");
                $("#password").html("");
			$("#message").html("");
			$("#message").removeClass("alert");
        }, 4000);
          
    },error: function(xhr, status, errorThrown) {

var contentType = xhr.getResponseHeader("content-type") || "";
if (contentType.indexOf('json') > -1) {
// Handle JSON response as before
try {
var message = JSON.parse(xhr.responseText).error;
$('#message').html(message).addClass('alert alert-danger');
} catch (jsonError) {  
$('#message').html('An error occurred. Please try again later.').addClass('alert alert-danger');
console.log(jsonError)
}

} else if (contentType.indexOf('html') > -1) {
// Extract error message from HTML response
try {
var htmlMessage = $(xhr.responseText);
$('#message').html('User Not Found').addClass('alert alert-danger').filter().text();
 
} catch (htmlError) {
console.log(htmlError.message);

//$('#message').html('An error occurred. Please try again later.').addClass('alert alert-danger');
}
} else {
// Unsupported response type
//$('#message').html('An error occurred. Please try again later.').addClass('alert alert-danger');
}
}    });
});

});

</script>

</html>