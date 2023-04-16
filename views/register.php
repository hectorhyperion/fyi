
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
                    <h1>Welcome Join Us</h1>
                    <p class="sub-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                    <h2>Sign up</h2>
                    <div id="message"></div>
                    <form action="#" id="signup-form">
                        <div class="input-group">
                            <span><i class="fa fa-user" aria-hidden="true"></i></span>
                            <input type="text" name="name" placeholder=" Username" >
                            <small style="color:lavenderblush" id="name"></small>
                        </div>
                        <div class="input-group">
                            <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" name="email" placeholder=" Email" >
                            <small style="color:lavenderblush" id="email"></small>
                        </div>
                        <div class="input-group ">
                            <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                            <input type="text" name="phone" placeholder=" Phone" >
                            <small style="color:lavenderblush" id="phone"></small>
                        </div>
                        <div class="input-group two-groop">
                            <span><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="Password" name="password" placeholder="Password" >
                            <small style="color:lavenderblush" id="password"></small>
                        </div>
                        
                        <button class="btn btn-primary btn-block" type="submit">Sign Up </button>
                    </form>
                
                    <p class="account"> have an account? <a href="login.php">Login</a></p>
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
$('#signup-form').submit(el => {
	
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
url: 'create',
data:formData,
processData: false,
contentType: false,
dataType: 'json',
success: function(response) {
if (response.status == 'success') {
// Display the success message on the HTML page
$('#message').html(response.message).addClass('alert alert-success text-center');
$("#signup-form")[0].reset();
btnDis = btnDis ? false : true;
    $(`#button-txt`).toggle();
    $(`#button-spinner`).toggle();
    window.location.href = 'login.php';
}
else {
	btnDis = btnDis ? false : true;
    $(`#button-txt`).toggle();
    $(`#button-spinner`).toggle();
	$('#name').html(response.nameError)
	  $('#email').html(response.emailError)
	  $('#phone').html(response.phoneError)
	  $('#password').html(response.passwordError)
		}
		setTimeout(() => {
            $("#name").html("");
			$("#email").html("");
			$("#phone").html("");
			$("#password").html("");
			$("#message").html("");
			$("#message").removeClass("alert");
        }, 4000);
    },error: function(xhr, status, error){
                    var message = JSON.parse(xhr.responseText).error;
                   $('#message').html(message).addClass('alert alert-danger');
        setTimeout(()=>{
            $('#message').html("");
            $('#message').removeClass('alert');
        } , 4000);
                }
    })
});

});

</script>

</html>