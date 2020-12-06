<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
<base href="<?php echo base_url();?>" />

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MR69L76');</script>
<!-- End Google Tag Manager -->
<meta name="msvalidate.01" content="166063EA84AEEB7D24D1185EC6801881" />

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php echo ($metatitle != "") ? '<title>'.$metatitle.'</title>':'';?>
    <?php echo ($metaother != "") ? $metaother:'';?>
    <!-- Favicon and Touch Icons -->
    <link href="images/fev.jpg" rel="shortcut icon" type="image/png">
    <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">


    <!-- CSS | Main style file -->
    <link href="css/style-main.css" rel="stylesheet" type="text/css">
	    <link href="js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css" />

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <link href="css/preloader.css" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
    <!-- Revolution Slider 5.x CSS settings -->
    <link href="js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />
    <link href="js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css" />
    <link href="css/marquee.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="js/tabbing-accordian/easy-responsive-tabs.css">





	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" type="text/css">
            <link href="css/css-plugin-collections.css" rel="stylesheet" />
            <link id="menuzord-menu-skins" href="css/menuzord-skins/menuzord-rounded-boxed.css"
                rel="stylesheet" />
            <link href="css/colors/theme-skin-lemon.css" rel="stylesheet" type="text/css">




    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery-plugin-collection.js"></script>
    <script src="js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
    <script src="js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=AW-986650965"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-986650965');
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-30983451-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-30983451-1');
</script>

<style>
.calcDiv{
	height: calc(100vh - (160px + 30px));
}
.flash {
  -webkit-animation: seconds 1.0s forwards;
  -webkit-animation-iteration-count: 1;
  -webkit-animation-delay: 5s;
  animation: seconds 1.0s forwards;
  animation-iteration-count: 1;
  animation-delay: 3s;

}
@-webkit-keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px;
    position: absolute;
  }
}
@keyframes seconds {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
    left: -9999px;
    position: absolute;
  }
}
</style>
</head>


<body class="">
<?php if($this->session->flashdata("msg") != ""){
	if($this->session->flashdata("is_success") == '1'){?>
<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-success flash"><?php echo $this->session->flashdata("msg");?></div>
<?php }
else{?>
<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-danger flash"><?php echo $this->session->flashdata("msg");?></div>
<?php } } ?>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR69L76"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


    <div id="wrapper">
        <header id="header" class="header">
  <div class="header-top">

  <div class="header-top bg-theme-colored xs-text-center">
      <div class="container">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="widget left-bar no-border m-0">
              <div class="mt-5 mb-5 text-left flip sm-text-center">
                <div class="font-12 text-gray  mb-0 font-weight-400"><i class="fa fa-phone-square  faa-flash animated text-theme-colored font-18"></i> +91-9785333312/14</div>

              </div>

            </div>

              <div class="widget left-bar no-border m-0">
              <div class="mt-5 mb-5 text-left flip sm-text-center">
                <div class="font-12  mb-0 font-weight-400"><i class="fa fa-envelope faa-flash animated text-theme-colored font-18"></i><a class="font-12 text-gray" href="#">info@letstalkacademy.com</a> </div>

              </div>
            </div>
          </div>
        <div class="col-md-5 col-sm-6">
		<div class="add-location">
		<div class="login-bar">
		<p>Welome Guest!<i class="fa fa-caret-down" aria-hidden="true"></i>
		<ul>
		<?php if(!$this->customer->isLogged()){ ?>
		<li> <a href="" class="" data-toggle="modal" data-target="#deleteProductModal" data-productid="3" data-productname="Product 3">Login/Register</a></li>
		<?php }else{ ?>
		<li> <a href="<?php echo base_url();?>account/logout">Logout</a></li>
		<?php } ?>
		</ul>

		</p>
		 </div>
		<div class="modal fade login-item" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">

        	<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-login">

		   <div class="modal-header">
		   	<div class="panel-heading">
						<div class="row">
							<ul id="myTab2" class="nav nav-pills boot-tabs">
  <li class="active"><a href="#home2" data-toggle="tab">Login</a></li>
  <li><a href="#profile2" data-toggle="tab">Register</a></li>
</ul>
						</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close" aria-hidden="true" ></i></button>


					</div>

      </div>

					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							<div id="myTabContent2" class="tab-content">
  <div class="tab-pane fade in active" id="home2">
   <?php echo form_open("account/signin", array("role"=>"form", "style"=>"display: block;", "id"=>"login_form"));?>
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" required class="form-control" placeholder="Username">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" required class="form-control" placeholder="Password">
									</div>

									<div class="form-group">
										<div class="row">
											<div class="">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-primary btn-top" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="<?php echo base_url()?>account/forget_password" >Forgot Password?</a>

												</div>
											</div>
										</div>
									</div>
								<?php echo form_close(); ?>
  </div>
  <div class="tab-pane fade" id="profile2">
  <?php echo form_open("account/add_user", array("id"=>"register_form", "role"=>"form"));?>
									<div class="form-group">
										<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" required />
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" required />
									</div>

									<div class="form-group">
										<input type="text" name="mobile" id="mobile" tabindex="1" class="form-control" placeholder="Mobile Number" required />
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required />
									</div>
									<div class="form-group">
										<div class="row">
											<div class="">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-primary btn-top" value="Register Now">
											</div>
										</div>
									</div>
								<?php echo form_close(); ?>
  </div>

</div>




							</div>
						</div>
					</div>


    </div>

</div>
		</div>
		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
     <h3>Select Your Location</h3>
	 <ul>
	<?php /*foreach($this->customer->getLocations()->result() as $loc){?>
	 <li><button onClick="set_location('<?php echo $loc->id; ?>')"><?php echo $loc->city;?></button></li>
 <?php }*/ ?>
	 <div class="clearfix"></div>
	 </ul>
	<script>
		/*function set_location(u){
			$.ajax({
		url: '<?php echo base_url();?>home/set_location',
		type: "GET",
		data: {id:u},

success: function(json) {
	location.reload();
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
} */

	$(document).ready(function(e) {
	$('#login_form').on('submit', (function(e) {
		e.preventDefault();
	$.ajax({
		url: '<?php echo base_url();?>account/signin',
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success:
		function(data){
			location.reload();
		},
		error: function(){}
	});
	}));

	$('#register_form').on('submit', (function(e) {
		e.preventDefault();
	$.ajax({
		url: '<?php echo base_url();?>account/add_user',
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success:
		function(data){
			location.reload();
		},
		error: function(){}
	});
	}));
	});
	</script>
	 <div class="clearfix"></div>
    </div>
  </div>
</div>


		</div>
		<div class="add-location">
             <a href="" class="location-popup" data-toggle="modal" data-target=".bs-example-modal-sm">Select Location</a>
            </div>
		</div>


          <div class="col-md-2 col-sm-6 col-xs-12">

			<div class="widget no-border m-0 resp-social">
          <ul class="styled-icons icon-dark text-right mb-0">
  <li><a href="https://www.facebook.com/letstalkacademy/" data-bg-color="#3B5998"><i class="fa fa-facebook"></i></a></li>
<li><a href="https://www.linkedin.com/company/let%27s-talk-academy/" data-bg-color="#007BB6"><i class="fa fa-linkedin"></i></a></li>
<li><a href="https://www.youtube.com/channel/UC8qwwKXJZaYfc9OIrK7dpgw" data-bg-color="#F52525"><i class="fa fa-youtube"></i></a></li>
</ul>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
    <div class="header-middle p-0  xs-text-center">
      <div class="container pt-0 pb-0">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="widget no-border m-0">
              <a class="menuzord-brand pull-left flip xs-pull-center" href="/"><img src="images/logo.png" alt=""></a>
            </div>
          </div>
                 <div class="col-xs-12 col-sm-4 col-md-6 resp-social">
          <div class="text-carousel">
                  <div class="item">
              <h4  class="p-0">Registration is open for CSIR NET JRF Life Science 2019</h4>

                  </div>
                  <div class="item">
                     <h4  class="p-0">The only coaching in India for CSIR cum research institute</h4>

                  </div>
                  <div class="item">
                     <h4 class="p-0">New Batches for Jaipur, Delhi, Varanasi, Udaipur & Lucknow Branches</h4>

                  </div>
                </div>





          </div>
          <div class="col-xs-12 col-sm-4 col-md-3 rightbar desk-web">
        <ul class="mb-0">
          <li>
          <a href="<?php echo base_url();?>publication">
          <span><img src="images/book-supply.png" /></span>
      Our <br />Publication
      </a>
          </li>
           <li>
            <a href="<?php echo base_url();?>discussion">
          <span><img src="images/expert.png" /></span>
    Ask  <br />to Expert
      </a>
          </li>
            <li>
             <a href="<?php echo base_url();?>online-tests">
          <span><img src="images/online-test.png" /></span>
      Online <br />Test Series
      </a>
          </li>


          </ul>
        </div>

 <!--join now-->
          </div>

        </div>
      </div>
    </div>



    <div class="header-nav">
    <div class="header-nav navbar-dark navbar-scrolltofixed navbar-transparent navbar-sticky-animated animated-active">
      <div class="header-nav-wrapper leftbar">
        <div class="container">
          <nav id="menuzord-right" class="menuzord">

            <ul class="menuzord-menu">
              <li class="active mr-0"><a href="#"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
              </li>
              <li class="mr-0"><a href="<?php /*echo $this->customer->getContactUs();*/?>"><i class="fa fa-map-marker" aria-hidden="true"></i>Contact</a>
              </li>

               <li class="right-space"><a class="white" href="#">About Us</a>
                <ul class="dropdown">
                  <li><a href="about-lets-talk-academy">About LTA</a></li>
                  <li><a href="director-desk-suraj-prakash-sir-life-science-teacher">Director Desk</a>
                  </li>


                </ul>
              </li>
              <li>

              <a class="white" href="#">Courses & Exams</a>
                <ul class="dropdown">
                 <?php foreach($this->customer->getHomeCategory() as $cat){ ?>

                  <li><a href="#"><?php echo $cat['course_name']?>  </a>
                    <ul class="dropdown">
					<?php if($cat['course_detail_name'] != ""){?>
                 <li><a href="<?php echo base_url()."course-detail/".$cat['course_detail_slug'];?>"><?php echo $cat['course_detail_name'];?></a></li>
					<?php }?>
					<?php if($cat['course_syllabus_name'] != ""){?>
                 <li><a href="<?php echo base_url()."course-syllabus/".$cat['course_syllabus_slug'];?>"><?php echo $cat['course_syllabus_name'];?></a></li>
					<?php } ?>

				      </ul>
                  </li>

				 <?php } ?>



                </ul>
              </li>
              <li><a class="white" href="<?php echo base_url();?>student-testimonials-reviews">Testimonials</a>

              </li>
              <li><a class="white" href="<?php echo base_url();?>batches-schedule">Batches Schedule</a><span class="gif">
			  <img src="images/new.gif" /></span>

              </li>

               <li><a class="white" href="<?php echo base_url();?>lta-clasroom-results">Results</a>
               <li><a class="white" <a href="<?php echo base_url();?>life-science-books">Book & Suppliers</a>

              </li>



			  <li>
			    <div class=" resp-btn">
        <ul class="mb-0">
          <li>
          <a href="<?php echo base_url();?>publication">

      Our Publication
      </a>
          </li>
           <li>
            <a href="<?php echo base_url();?>discussion">

    Ask  to Expert
      </a>
          </li>
            <li>
             <a href="<?php echo base_url();?>">

      Online Test Series
      </a>
          </li>


          </ul>
        </div>
			  </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    </div>
    <div class="fixed-item">
        <a href="#" class="blue" data-toggle="modal" data-target="#applyModal">
            <img src="images/apply-online.png" />
            <a class="yellow" href="#">
                <img src="images/pay-online.png" />
                <div class="account-Detail">
                    <h4>
                    </h4>
                    <h4>
                        <img src="images/bank-logo.jpg" alt="">
                    </h4>
                    <p>
                        <strong>Account Name:</strong> Let's Talk Academy</p>
                    <p>
                        <strong>Account No:</strong> 000000000000000</p>
                    <p>
                        <strong>Bank &amp; Branch:</strong> ICICI</p>
                    <p>
                        <strong>IFSC Code:</strong> IBKL0000884</p>
                </div>
            </a><a class="red" href="news-jobs.html">
                <img src="images/new-jobs.png" /></a>
    </div>
    </header>
