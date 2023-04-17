<section class="footer" id="contact">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 footer-agile">
				<h3>About Us</h3>
				<p class="footer-p1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
				<ul class="social-icons3">
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
					<li><a href="#"><i class="fa fa-youtube"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
				</ul>	
			</div>
			<div class="col-lg-4 col-md-4 footer-agile">
				<h3>Customer Feed</h3>
				<p class="footer-p2">" Lorem ipsum dolor sit amet, consectetur adipiscing elit. In elit leo, congue ut rhoncus id, egestas id diam. Suspendisse non lectus id lorem ornare molestie nec in felis. "</p>
				<p class="footer-p3"><a href="#">#John Doe</a>, <span>5 Hours ago</span></p>
			</div>
			<div class="col-lg-4 col-md-4 footer-agile">
				<h3>Our Links</h3>
				<div class="contact-w3ls">
					<div class="row">	
						<div class="col-xs-4 contact-agile1">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
						</div>
						<div class="col-xs-8 contact-agile2">
							<div class="address">
								<h4>Visit Us</h4>
								<p>Jack street,Chicago,USA.</p>
							</div>	
						</div>	
					</div>
					<div class="row">
						<div class="col-xs-4 contact-agile1">
							<i class="fa fa-envelope-o" aria-hidden="true"></i>
						</div>
						<div class="col-xs-8 contact-agile2">
							<div class="address">
								<h4>Mail Us</h4>
								<p><a href="mailto:email@example.com">email@example.com</a></p>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 contact-agile1">
							<i class="fa fa-mobile" aria-hidden="true"></i>
						</div>
						<div class="col-xs-8 contact-agile2">
							<div class="address">
								<h4>Call Us</h4>
								<p>+01 0101 01010101</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 contact-agile1">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
						</div>
						<div class="col-xs-8 contact-agile2">
							<div class="address">
								<h4>Our Working Hours</h4>
								<p>Monday - Friday : 08 AM - 07 PM</p>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>	
		<hr>
		<p class="copyright">&copy; 2016 Euphony. All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
	</div>
</section>
<a href="#0" class="cd-top">Top</a>
<!-- js files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/SmoothScroll.min.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a").on('click', function(event) {

   // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {

    // Store hash
    var hash = this.hash;

    // Using jQuery's animate() method to add smooth page scroll
    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){

      // Add hash (#) to URL when done scrolling (default click behavior)
      window.location.hash = hash;
      });
    } // End if
  });
})
</script>
<!-- back to top -->
<script src="js/main.js"></script> 
<!-- /back to top -->
<!-- js for work section -->
<script src="js/jQuery.lightninBox.js"></script>
<script type="text/javascript">
	$(".lightninBox").lightninBox();
</script>
<!-- /js for work section -->
<!-- js for tabs -->
<script src="js/cbpFWTabs.js"></script>
<script>
	(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

	})();
</script>
<script src="js/functions.js"></script>
<script>
	   $('#joinus').click(e=>{
		e.preventDefault();
		const jwt = getCookie('jwt');
if (jwt) {
  window.location.href = 'home.php';
		}		
		location.href= '/fyi/login.php';
	   })
	   const jwt = getCookie('jwt');
	   if(!jwt) {
		try{
			document.querySelector('#logout').style.display = 'none';
		}
		catch(e){
			console.log(e.message);
		}
	
	   }
</script>
<!-- /js for tabs -->
<!-- js files for banner -->
<script src="js/boot_slider.js" type="text/javascript"></script>
<!-- /js files for banner -->
<!-- /js files -->