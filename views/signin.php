
<!DOCTYPE html>
<html lang="en">
<head>
<title>Project</title>
<!-- Meta tags -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Gaze Sign up & login Form Responsive Widget, Audio and Video players, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"
/>
<script>
addEventListener("load", function () { setTimeout(hideURLbar, 0); }, false); function hideURLbar() { window.scrollTo(0, 1); }
</script>
<!-- Meta tags -->
<!--stylesheets-->
<link href="css/style1.css" rel='stylesheet' type='text/css' media="all">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all">
<!--//style sheet end here-->
<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
</head>
<body>
<div class="mid-class" >
<div class="art-right-w3ls">
<h2>Sign In and Sign Up</h2>
 
<!--login form-->
<div class="letter-w3ls">
    <div id="response message"></div>
<form action="" method="POST" id="signup-form">
<div class="form-left-to-w3l">
<input type="text" name="name" placeholder="Username" >
<small id="nameError" class="text-danger"></small>
</div>
<div class="form-left-to-w3l">
<input type="text" name="phone" placeholder="Phone" >
<small class="text-danger " id="phoneError"></small>
</div>
<div class="form-left-to-w3l">
<input type="email" name="email" placeholder="Email" >
<small class="text-danger" id="emailError"></small>
</div>
<div class="form-left-to-w3l">
<input type="password" name="password" placeholder="Password" >
<small class="text-danger" id="passwordError"></small>
</div>
<div class="form-left-to-w3l margin-zero">
    <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" >
    <small class="text-danger" id="confirm_passwordError"></small>
</div>
<div class="w3layouts_more-buttn">
<h3>Don't Have an account..?
<a href="signup.php">Sign In Here  </a>
</h3>
</div>

<div class="btnn">
    <button class="btn btn-primary w-md waves-effect waves-light" id="sign-btn" type="submit">
        <span id="sign-txt">Sign up </span>
        <div class="spinner-border spinner-border-sm m-0" id="sign-spinner"
        style="display: none;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</button>
<br>
</div>
</form>
<div class="clear"></div>
</div>
<!--//login form-->
 

<!-- popup-->

<!-- //popup -->
</div>
<div class="art-left-w3ls">
<h1 class="header-w3ls">
<a href="/project/views/index.php"> Euphony</a>
</h1>
</div>
</div>
<footer class="bottem-wthree-footer">
<p>
© 2019 Gaze Sign Up & Login Form. All Rights Reserved | Design by
<a href="http://www.W3Layouts.com" target="_blank">W3Layouts</a>
</p>
</footer>

<script src="js/custom.js"></script>
<script src="js/jquery.js"></script>
<script>
$('#signup-form').submit(el => {
el.preventDefault()
spin('sign')
const formData = new FormData(el.target,);
$.ajax({
      type: 'POST',
      url: 'database.php',
      data:formData,
      processData: false,
  contentType: false,
      dataType: 'json',
      success: function(response) {
        if (response.status === 'success') {
          // Display the success message on the HTML page
      
          $('#response').html(response.message);
        } else {
          
          // Display the error messages on the HTML page
          $('#nameError').html(response.nameError);
          $('#phoneError').html(response.phoneError);
          $('#passwordError').html(response.passwordError);
          $('#emailError').html(response.emailError);
          $('#confirm_passwordError').html(response.confirm_passwordError);
          
        }
      }
    });
    if(localStorage.getItem('jwtToken') !== null) {
              window.location.href = 'index.php';
            }

    });
</script>
</body>
</html>