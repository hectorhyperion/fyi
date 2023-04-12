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
 
<!-- Button to open the modal -->
<button class="show-modal">Show modal 3</button>
<div class="modal hidden">
  <button class="close-modal">&times;</button>
  <h1>I'm a modal window 😍</h1>
  <p>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
	veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
	commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
	velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
	occaecat cupidatat non proident, sunt in culpa qui officia deserunt
	mollit anim id est laborum.
  </p>
</div>
<div class="overlay hidden"></div>
<script src="js/modal.js"></script>
 <div id="data-container">
</div>
<script src="js/jquery.js"></script>

<script>
	 $(document).ready(function() {
            // Make an AJAX request to the PHP script
            $.get("job/data", function(response) {
                // Parse the JSON response
	            var data = JSON.parse(JSON.stringify(response));
				// Loop through the data and create HTML elements to display it
				const count = data[0].count;
				var html = "";
			 
					for (var i in data){
                    html += "<div class='row'>"+ 
					"<div class='col-lg-3 col-md-3 info-w3ls'>"
					+'<div class="info-agile">'
					+"<div class='hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1b'>"
					+"<i class='hi-icon fa fa-cog'><a href='#'></a></i>"
					   +'<h4>'+ data[i].company_name+'</h4>' 
					   +'<h3 style="color:#fff">'+ data[i].location+'</h3>' 
					       +'<p class="info-p1">'+data[i].body+'</p>'+"</div>"
							+"<a href='#' style= 'margin:3px' class='btn btn-primary'>apply</a >"
						+ '<button style="margin:3px" data-id="'+ data[i].id + '"class="btn btn-info edit">edit</button >'
					    +'<a href="#" style= "margin:3px" id ="delete" data-id="' + data[i].id + '" class="btn btn-danger delete">delete</a >'
						+'<span class="line1"></span>'+
						"</div>"+ "</div>"	;
					}
					$("#data-container").html(html);
					});
					
			$(document).on('click', '.delete', function(e){
					e.preventDefault();
					var id = $(this).data('id');
					$.ajax({
			url: 'delete/'+id,
			method: 'DELETE',
			success: function(response) {
			// Handle success response
			console.log(response);
			},
			error: function(jqXHR, textStatus, errorThrown) {
			//Handle error response
			}});
			})
			$(document).on('click','.edit', function(e){
			//	e.preventDefault();
			
			var id = $(this).data('id');
					$.ajax({
			url: 'fetch/'+id,
			method: 'GET',
			success: function(response) {
			// Handle success response
			var data = JSON.parse(JSON.stringify(response));
				// Loop through the data and create HTML elements to display it
			},
			error: function(jqXHR, textStatus, errorThrown) {
			}
		})
})
// var id = $(this).data('id');
// $.ajax({
//       url:'update'+id ,
//       type: "PUT", // Use the HTTP PUT method for updating data
//       data: data,
//       success: function(response) {
//         // Handle the successful response from the server
//         $("#result").html("Data updated successfully!");
//       },
//       error: function(xhr, status, error) {
//         // Handle the error response from the server
//         console.log("Error: " + error);
//       }
//     });
        });

</script>

</div>
</section>
<!-- /info section -->
<!-- team section -->
<section class="team" id="team">
<div id="response"></div>
<form class="form-container" id="job-form">
<div class="message" id=" message"></div>
<div class="form-column">
<label for="name1">Company Name</label>
<input type="text" id="name1" name="company_name">
<small class="text-danger" id="company_nameError"></small>

<label for="email1">Email </label>
<input type="email" id="email1" name="email">
<small class="text-danger" id="emailError"></small>

<label for="location">Location </label>
<input type="text" id="location" name="location">
<small class="text-danger" id="locationError"></small>
</div>

<div class="form-column">
<label for="movie">Movie Name</label>
<input type="text" id="movie" name="movie_name">
<small class="text-danger" id="movie_nameError"></small>

<label for="rolls">Roles needed </label>
<input type="text" id="rolls" name="roles">
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
<script src="js/jquery.js"></script>
<script >
$('#job-form').submit(el => {
el.preventDefault()

$('#submit-btn').prop('disabled', true);
$('#submit-txt').hide();
$('#hiden').removeAttr('style') ;
const formData = new FormData(el.target,);
$.ajax({
type: 'POST',
url: 'job-form',
data:formData,
processData: false,
contentType: false,
dataType: 'json',
success: function(response) {
if (response.status === 'success') {
// Display the success message on the HTML page
$('#response').html(response.message).addClass('alert alert-success text-center ').delay(3000).fadeOut(1000);
$("#job-form")[0].reset();

} else {
// Display the error messages on the HTML page
// Define a named function
$('#company_nameError').html(response.company_nameError).delay(3000).fadeOut(1000);
$('#emailError').html(response.emailError).delay(3000).fadeOut(1000);
$('#locationError').html(response.locationError).delay(3000).fadeOut(1000);
$('#rolesError').html(response.rolesError).delay(3000).fadeOut(1000);
$('#bodyError').html(response.bodyError).delay(3000).fadeOut(1000);
$('#movie_nameError').html(response.movie_nameError).delay(3000).fadeOut(1000);
$('#submit-btn').prop('disabled', false);
$('#submit-txt').show();
$('#hiden').removeClass('spinner-border text-primary');
}
}
});

});
</script>
</section>
<!-- /team section -->
<!-- testimonial section -->
<section class="testimonial">
<div class="container">
<h3 class="text-center">Our Customer Reviews</h3>
<p class="text-center">Our Clients Like Us, Please Read Their Opinions</p>
<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="hover">
<!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
<div class="item active">
<div class="losange">
<div class="los1">
<img src="images/test-img1.jpg" alt="testimonial"/>
</div>
</div>
<p class="test-p1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac bibendum sem. Nullam bibendum justo eget lorem porta euismod. Donec et fringilla tortor.</p>
<hr>
<h4>Kate Winslet</h4>
<p class="test-p2">DJ Newyork</p>
</div>
<div class="item">
<div class="losange">
<div class="los1">
<img src="images/test-img2.jpg" alt="testimonial"/>
</div>
</div>
<p class="test-p1">Cras nunc nisi, sagittis et nibh in, feugiat dapibus quam. Ut pellentesque dictum massa, pellentesque aliquet nisi aliquam in. Maecenas non sollicitudin dui.</p>
<hr>
<h4>Britney Spears</h4>
<p class="test-p2">Music Director</p>
</div>
<div class="item">
<div class="losange">
<div class="los1">
<img src="images/test-img3.jpg" alt="testimonial"/>
</div>
</div>
<p class="test-p1">Mauris nec ex quis elit euismod posuere. Sed ultricies mollis turpis, a convallis diam dignissim eu. Suspendisse elit elit, suscipit eu sollicitudin facilisis.</p>
<hr>
<h4>Lady Gaga</h4>
<p class="test-p2">Piano Artist</p>
</div>
</div>
<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
</div>
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

</body>
</html>