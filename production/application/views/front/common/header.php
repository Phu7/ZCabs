<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php echo base_url();?>" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Z CAB</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
<link href="css/animation.css" type="text/css" rel="stylesheet">
<link href="css/aos.css" type="text/css" rel="stylesheet">

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0DoxNXl6J6sYCEW-KGOEzTeQxfGoNnHU&v=3.exp&libraries=places"></script>
</head>


<body>
	<!--flash-->
	<div id="flash_message"></div>
	<!----loader--->
<div class="loading-mask loaderhide" id="ajax-loader" data-role="loader">
<div class="loader"><img src="images/tenor.gif"></div></div>
<!--loader end--->

		<nav class="navbar navbar-default custom-nav" data-aos="fade-down">
		<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
						<a class="navbar-brand" href="/"><img src="images/logo.png" alt="" height="41px" class="img-responsive"></a>
					</div>


				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

<ul class="nav navbar-nav navbar-right">
	<?php if($this->customer->isLogged()){ ?>
		<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>

		<ul class="dropdown-menu">
		<li> <a href="#"><span>Profile</span></a> </li>
		<li> <a href="#"><span>Previous Trips</span></a></li>
		<li> <a href="account/logout"><span>Logout</span></a></li>
		</ul>

		</li>
	<?php }else{ ?>
	<li class="active" id="ajax_login"><a data-toggle="modal" href="#loginModal">Login/Register</a></li>
<?php } ?>
	<li><a href="/">Home</a></li>
	<li><a href="about-us">Abouts Us</a></li>
	<li><a href="sights">Sight Seeing</a></li>
	<li><a href="contact-us">Contact Us</a></li>
</ul>
				</div>


		</div>
</nav>

<!-- Login Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">SIGN IN</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open("account/login", array("id"=>"login_form"));?>
				<div class="form-group">
					<input type="text" placeholder="Username" class="form-control" required name="username" id="username" />
				</div>

				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" required name="password" id="password" />
				</div>
				<input type="hidden" name="login_extra" id="login_extra" value="" />
				<button type="submit" class="btn btn-primary">LOGIN</button>
				<a href="Javascript:void()" class="pull-right">Forgot Password ?</a>
				<?php echo form_close();?>
      </div>
      <div class="modal-footer">
        <a href="#registerModal" data-toggle="modal" data-dismiss="modal"><h5>CREATE AN ACCOUNT</h5></a>
      </div>
    </div>

  </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CREATE AN ACCOUNT</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open("account/register", array("id"=>"register_form"));?>
				<div class="form-group">
					<input type="text" placeholder="First Name" class="form-control" required name="first_name" id="first_name" />
				</div>

				<div class="form-group">
					<input type="text" placeholder="Last Name" class="form-control" required name="last_name" id="last_name" />
				</div>

				<div class="form-group">
					<input type="email" placeholder="Email Address" class="form-control" required name="email" id="email" />
				</div>

				<div class="form-group">
					<input type="text" placeholder="Mobile Number" class="form-control" required name="mobile" id="mobile" />
				</div>

				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" required name="password" id="register_password" />
				</div>
				<input type="hidden" name="register_extra" id="register_extra" value="" />
				<button type="submit" class="btn btn-primary">CREATE NOW</button>
				<?php echo form_close();?>
      </div>
      <div class="modal-footer">
        <a href="#loginModal" data-toggle="modal" data-dismiss="modal"><h5>Login</h5></a>
      </div>
    </div>

  </div>
</div>
