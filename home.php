<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>
<!-- /banner section -->	
<!-- about section -->
<section class="about" id="about">
<div class="container">
<h2 class="text-center">About Us</h2>
<p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6 about-w3ls1">
<div class="about-agile">
<i class="fa fa-music" aria-hidden="true"></i>
<h4>Lorem ipsum dolor</h4>
<p class="about-p1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 about-w3ls1">
<div class="about-agile">
<i class="fa fa-volume-up" aria-hidden="true"></i>
<h4>consectetur adipiscing</h4>
<p class="about-p1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 about-w3ls1">
<div class="about-agile">
<i class="fa fa-headphones" aria-hidden="true"></i>
<h4>facilisis ultricies</h4>
<p class="about-p1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6 about-w3ls1">
<div class="about-agile">
<i class="fa fa-play" aria-hidden="true"></i>
<h4>Ut pharetra felis</h4>
<p class="about-p1">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
</div>
</div>
</section>
<!-- /about section -->
<!-- info section -->
<section class="info" id="info"> 
<div class="container">
<h3 class="text-center">Land Your Dream Role Now</h3>
<p class="text-center">Here Are Few Reasons</p>
<hr>
<div id="subform" class="alert aler-success"></div>
<div id="myModal" class="modal">
<div class="modal-content">
<span class="close" onclick="closeModal()">&times;</span>
<form class="form-container" id="update-form" data-id="id">
<input type="hidden" name="id" id="id">
<div class="message" id=" message"></div>
<div class="form-column">
<label for="name">Company Name</label>
<input type="text" id="name" name="company_name">
<small class="text-danger" id="company_nameError"></small>

<label for="email">Email </label>
<input type="email" id="email" name="email">
<small class="text-danger" id="emailError"></small>

<label for="location">Location </label>
<input type="text" id="location" name="location">
<small class="text-danger" id="locationError"></small>
</div>
<div class="form-column">
<label for="movie">Movie Name</label>
<input type="text" id="movie" name="movie_name">
<small class="text-danger" id="movie_nameError"></small>

<label for="roles">Roles needed </label>
<input type="text" id="roles" name="roles">
<small class="text-danger" id="rolesError"></small>

<label for="description">Job description</label>
<textarea id="body-input" name="body" rows="3" ></textarea>
<small class="text-danger" id="bodyError"></small>
</div>
<div class="form-button">
<button type="submit" id="submit-btn"><span id="submit-txt"> Submit</span>
<div class="spinner-border text-secondary" style="display:none" id="hidden" role="status">
<span class="sr-only">Loading...</span>
</div>
</div>
</form>
<div id="edit"></div>
</div>
</div>	
<div id="data-container"></div>
<script src="js/modal.js"></script>
<script src="js/jquery.js"></script>
<script src="js/functions.js"></script>
<script src="js/jwt.js"></script>
<script>
$(document).ready(function() {

function fetchData() {
$.get("job/data", function(response) {

var data = JSON.parse(JSON.stringify(response));
var html = "";
const token = getCookie('jwt');

var jwt_user_id = null;
if (token) {
  const decodedToken = jwt_decode(token);
  jwt_user_id = decodedToken.user_id;
}

for (var i in data){
var editBtn = "";
var deleteBtn = "";

if (jwt_user_id && data[i].user_id == jwt_user_id) {
editBtn = '<button style="margin:3px" data-id="' + data[i].id + '"class="btn btn-info edit">edit</button >';
deleteBtn = '<a href="#" style= "margin:3px" id ="delete" data-id="' + data[i].id + '" class="btn btn-danger delete">delete</a>';
}
html += "<div class='row'>" +
"<div class='col-lg-3 col-md-3 info-w3ls'>" +
'<div class="info-agile">' +
"<div class='hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1b'>" +
"<i class='hi-icon fa fa-cog'><a href='#'></a></i>" +
'<h4>' + data[i].company_name + '</h4>' +
'<h3 style="color:#fff">' + data[i].location + '</h3>' +
'<small style="color:white">' + data[i].roles + '</small>' +
'<p class="info-p1">' + data[i].body + '</p>' + "</div>" +
"<a href='#' style= 'margin:3px' class='btn btn-primary'>apply</a >" +
editBtn +
deleteBtn +
'<span class="line1"></span>' +
"</div>" + "</div>";
var id = data[i].id;
}
$("#data-container").html(html);
});

}
fetchData();
setInterval(fetchData, 5000);

});
$(document).on('click', '.delete', function(e){

e.preventDefault();
const jwtToken = document.cookie
.split('; ')
.find(row => row.startsWith('jwt_token='))
.split('=')[1];
const decodedToken = jwt_decode(jwtToken);
const userId = decodedToken.user_id;
var id = $(this).data('id');				 
 
$.ajax({
url: 'delete/'+id,
method: 'DELETE',
success: function(response) {
// Handle success response
alert('job deleted sucessfully!');
},
error: function(jqXHR, textStatus, errorThrown) {
alert(errorThrown);
}});
 
})
$(document).on('click','.edit', function(e){

const jwtToken = document.cookie
.split('; ')
.find(row => row.startsWith('jwt_token='))
.split('=')[1];
const decodedToken = jwt_decode(jwtToken);
const userId = decodedToken.user_id;
e.preventDefault();
var id = $(this).data('id');

openModal();
$.ajax({
url: 'fetch/'+id,
method: 'GET',
success: function(response) {
// Handle success response
var data = JSON.parse(JSON.stringify(response));
$('#name').val(data.company_name);
$('#email').val(data.email);
$('#location').val(data.location);
$('#movie').val(data.movie_name);
$('#roles').val(data.roles);
$('#body-input').val(data.body);
$("#id").val(data.id);
},
error: function(jqXHR, textStatus, errorThrown) {
}

})	

$(document).on('submit','#update-form', function(e){
e.preventDefault()
const formData = new FormData(e.target,);
$.ajax({
url: 'put/'+id,
type: "POST",  
data:formData,
processData: false,
contentType: false,
dataType: 'json',
success: function(response) {
// Handle the successful response from the server
$("#subform").html(response).delay(4000).hide(1); 
closeModal();
alert('Job Updated sucessfully')	},
error: function(xhr, status, error) {
alert(error);
}
});
})
})


</script>
</div>
</section>
<!-- /info section -->
<!-- team section -->
<section class="team" id="team">
<div id="message"></div>
<form class="form-container" id="job-form">
<input type="hidden" id="user_id"  name="hidden">
<div class="message" id=" message"></div>
<div class="form-column">
<label for="name1">Company Name</label>
<input type="text" id="name1" name="company_name">
<small class="text-danger" id="company_name"></small>

<label for="email1">Email </label>
<input type="email" id="email1" name="email">
<small class="text-danger" id="email-id"></small>

<label for="location">Location </label>
<input type="text" id="location" name="location">
<small class="text-danger" id="location-id"></small>
</div>
<div class="form-column">
<label for="movie">Movie Name</label>
<input type="text" id="movie" name="movie_name">
<small class="text-danger" id="movie_name"></small>

<label for="rolls">Roles needed </label>
<input type="text" id="rolls" name="roles">
<small class="text-danger" id="roles-id"></small>

<label for="description">Job description</label>
<textarea id="body-input" name="body" rows="3" ></textarea>
<small class="text-danger" id="body"></small>
</div>

<div class="form-button">
<button type="submit" id="submit-btn"><span id="button-txt"> Submit</span> 
<div id="button-spinner"  class="spin-button" 
style="display: none;" role="status">
<span class="sr-only">Loading...</span>
</div>
</button>
</form>
<script src = "js/jwt.js"></script>
<script src="js/jquery.js"></script>
<script src="js/functions.js"></script>
<script >
$(document).ready(function(){
let btnDis = false
$('#job-form').submit(el => {
el.preventDefault()

btnDis = btnDis ? false : true;
$(`#button-txt`).toggle();
$(`#button-spinner`).toggle();
btnDis
? $(`#submit-btn`).attr("disabled", true)
: $(`#submit-btn`).removeAttr("disabled");
const jwt = getCookie('jwt');
if (jwt) {
const formData= new FormData(el.target);
const jwtToken = document.cookie
.split('; ')
.find(row => row.startsWith('jwt_token='))
.split('=')[1];
const decodedToken = jwt_decode(jwtToken);
const userId = decodedToken.user_id;

$.ajax({
type: 'POST',
url: 'job-form/'+userId,
data:formData,
processData: false,
contentType: false,
dataType: 'json', 
success: function(response) {
if (response.status == 'success') {
// Display the success message on the HTML page
$('#message').html(response.message).addClass('alert alert-success text-center');
$("#job-form")[0].reset();
btnDis = btnDis ? false : true;
$(`#button-txt`).toggle();
$(`#button-spinner`).toggle();
}
else {
btnDis = btnDis ? false : true;
$(`#button-txt`).toggle();
$(`#button-spinner`).toggle();
$('#company_name').html(response.company_nameError)
$('#email-id').html(response.emailError)
$('#roles-id').html(response.rolesError)
$('#body').html(response.bodyError)
$('#movie_name').html(response.movie_nameError)
$('#location-id').html(response.locationError)
}
setTimeout(() => {
$("#company_name").html("");
$("#email-id").html("");
$("#location-id").html("");
$("#roles-id").html("");
$("#body").html("");
$("#movie_name").html("");
$("#message").html("");
$("#message").removeClass("alert");
}, 4000);

},error: function(xhr, status, error) {
console.log(error);
}

})
} 
else {
btnDis = btnDis ? false : true;
$(`#button-txt`).toggle();
$(`#button-spinner`).toggle();
location.href= '/fyi/login.php';
}
});


});

</script>
</section>

<!-- /team section -->
<!-- testimonial section -->
<section class="testimonial">
<div class="container">
<h3 class="text-center">Find Talent </h3>
<p class="text-center">Check out Our list of top Talent</p>
 
<!-- Wrapper for slides -->
 <div id="talent"></div>
<!-- Left and right controls -->
 
</div>
</div>

<script>

        $(document).ready(function() {
			$.get("talents", function(response) {
				 var data = JSON.parse(JSON.stringify(response));
				 var html = ''
				 for (var i in data) {
				html+= "<div class='row'>" +
"<div class='col-lg-3 col-md-3 info-w3ls'>" +
'<div class="info-agile">' +
"<div class='hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1b'>" +
"<i class='hi-icon fa fa-cog'><a href='#'></a></i>" +
'<h4>' + data[i].name + '</h4>' +
'<h3 style="color:#fff">' + data[i].phone + '</h3>' +
'<small style="color:white">' + data[i].email + '</small>' +
'<p class="info-p1">' + data[i].location + '</p>' + "</div>" +

'<span class="line1"></span>' +
"</div>" + "</div>";
 }
 $('#talent').html(html);

			}
			)
        });
    </script>
</section>
<!-- /testimonial section -->
<!-- work section -->
<section class="work" id="work">
<div class="container">
<h3 class="text-center">Our Works</h3>
<p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
<section>
<div class="tabs tabs-style-iconbox">
<nav>
<ul>
<li><a href="#section-iconbox-1" class="icon"><span>All</span></a></li>
<li><a href="#section-iconbox-2" class="icon"><span>Singers</span></a></li>
<li><a href="#section-iconbox-3" class="icon"><span>Guitarist</span></a></li>
<li><a href="#section-iconbox-4" class="icon"><span>DJ's</span></a></li>
<li><a href="#section-iconbox-5" class="icon"><span>Drummer</span></a></li>		
</ul>
</nav>
<div class="content-wrap">
<section id="section-iconbox-1">
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img1-1.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img1.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>DJ</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>	
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img2-2.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img2.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img3-3.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img3.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img4-4.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img4.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img5-5.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img5.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>DJ</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img6-6.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img6.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Drummer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img7-7.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img7.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Drummer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img8-8.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img8.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img9-9.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img9.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Drummer & DJ</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img10-10.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img10.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img11-11.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img11.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer & Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img12-12.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img12.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
</section>
<section id="section-iconbox-2">
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img2-2.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img2.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img3-3.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img3.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img10-10.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img10.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img11-11.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img11.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer & Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
</section>
<section id="section-iconbox-3">
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img4-4.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img4.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img8-8.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img8.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img11-11.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img11.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Singer & Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img12-12.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img12.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Guitarist</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
</section>
<section id="section-iconbox-4">
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img1-1.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img1.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>DJ</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img5-5.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img5.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>DJ</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img9-9.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img9.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Drummer & DJ</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
</section>
<section id="section-iconbox-5">
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img6-6.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img6.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Drummer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img7-7.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img7.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Drummer</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 works-w3ls">
<a href="images/work-img9-9.jpg" class="lightninBox" data-lb-group="1">
<img src="images/work-img9.jpg" alt="work">
<div class="b-wrapper">
<i class="fa fa-search-plus" aria-hidden="true"></i>
<h5>Drummer & DJ</h5>
<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>
</div>
</a>
</div>
</section>
</div><!-- /content -->
</div><!-- /tabs -->
</section>
</div>
</section>
<!-- /work section -->
<!-- map section -->
<div class="map">
<iframe class="googlemaps" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d380510.6741687111!2d-88.01234121699822!3d41.83390417061058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1455598377120" style="border:0" allowfullscreen></iframe>
</div>
<!-- /map section -->
<!-- subscribe section -->
<section class="subs">
<div class="container">
<div class="col-lg-6">
<h3>Make Yourself Available, Subscribe To Us</h3>
</div>
<div class="col-lg-6">
<div class="subscribe">
<form action="#" method="post">
<div class="form-group1">
<input class="form-control" id="email" name="email" placeholder="myemail@example.com" type="email" required>
</div>
<div class="form-group2">
<button class="btn btn-outline btn-lg" type="submit">Subscribe</button>
</div>
<div class="clear-fix"></div>
</form>
</div>	
</div>
</div>
</section>
<!-- /subscribe section -->
<!-- footer section -->
<?php include 'includes/footer.php'; ?>
<!-- /footer section -->

<script>
$(document).ready(()=>{
// Get the JWT token from the cookie
const jwtToken = document.cookie
.split('; ')
.find(row => row.startsWith('jwt_token='))
.split('=')[1];
// Use the JWT token in your API requests
fetch('home.php', {
headers: {
'Authorization': `Bearer ${jwtToken}`
}
}).then(response => {

});
function getCookie(name) {
const cookieValue = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
return cookieValue ? cookieValue.pop() : '';
}
if (document.cookie.includes("jwt_token") >= 0) {
document.getElementById('joinus').style.display = 'none';

}
else {
$("#find").style.display = "none"; 
}
})
$('#logout').click(e=> {
e.preventDefault();

document.cookie = 'jwt_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
// Redirect the user to the home page 
window.location.href = 'home.php';
}) 

</script>
</body>
</html>