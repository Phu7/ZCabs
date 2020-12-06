<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<base href="<?php echo base_url();?>" />

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Z Cabs</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
<link href="css/animation.css" type="text/css" rel="stylesheet">
<link href="css/aos.css" type="text/css" rel="stylesheet">

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0DoxNXl6J6sYCEW-KGOEzTeQxfGoNnHU&v=3.exp&libraries=places"></script>

<style>
.bordernone{
	border:0px!important;
}
</style>
</head>


<body>
	<!--flash------------>
<?php if($this->session->flashdata("msg") != ""){
	if($this->session->flashdata("is_success") == '1'){?>
<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-success flash"><?php echo $this->session->flashdata("msg");?></div>
<?php }
else{?>
<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-danger flash"><?php echo $this->session->flashdata("msg");?></div>
<?php } } ?>
<!--end------------>
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
						<a class="navbar-brand" href="home"><img src="images/logo.png" alt="" height="41px" class="img-responsive"></a>
					</div>


				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

<ul class="nav navbar-nav navbar-right">
	<?php if($this->customer->isLogged()){ ?>
		<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>

		<ul class="dropdown-menu">
		<li> <a href="account"><span>My Profile</span></a> </li>
		
		<?php if($this->customer->isType() == 1){?>
		<li> <a href="account/get_history"><span>My Bookings</span></a></li>
		<li><a href="account/transaction_history"><span>Transaction History</span></a></li>
		<li><a href="razorpay"><span>My Wallet (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>)</span></a></li>
		<li><a href="utility-service"><span>Utility Service</span></a></li>
		<?php } ?>
		
		<?php if($this->customer->isType() == 3){?>
		<li> <a href="account/withdrawal"><span>Withdrawal Request</span> </a> </li>
		<li><a href="account/transaction_history"><span>Transaction History</span></a></li>
		<li><a href="razorpay"><span>My Wallet (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>)</span></a></li>
		<li><a href="utility-service"><span>Utility Service</span></a></li>
		<li><a href="driver/register"><span>Add Driver/Cab</span></a></li>
	    <?php } ?>
	    
	  	<?php if($this->customer->isType() == 2){?>
			<li> <a href="account/get_driver_history"><span>My Bookings</span></a></li>
		  	<li> <a href="account/withdrawal"><span>Withdrawal Request</span> </a> </li>
			<li><a href="account/transaction_history"><span>Transaction History</span></a></li>
			<li><a href="razorpay"><span>My Wallet (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>)</span></a></li>
			<li><a href="utility-service"><span>Utility Service</span></a></li>
			<li><a href="account/outstationtrip"><span>Outstation Trip Schedule</span></a></li>
		    <?php } ?>
		    
		<li> <a href="account/logout"><span>Logout</span></a></li>
		</ul>

		</li>
	<?php }else{ ?>
	<li class="active" id="ajax_login"><a data-toggle="modal" href="#loginModal">Login/Register</a></li>
<?php } ?>
	<li><a href="home">Home</a></li>
	<li><a href="about-us">Abouts Us</a></li>
	<li><a href="sights">Sight Seeing</a></li>
	<li><a href="offers">Offers</a></li>
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
				<a href="account/forget_password" class="pull-right">Forgot Password ?</a>
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
					<input type="email" placeholder="Email Address" class="form-control" name="email" id="email" />
				</div>

				<div class="form-group">
					<input type="text" placeholder="Mobile Number" class="form-control" required name="mobile" id="mobile" />
				</div>

				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" required name="password" id="register_password" />
				</div>
				<button type="submit" class="btn btn-primary">CREATE NOW</button>
				<?php echo form_close();?>
      </div>
      <div class="modal-footer">
        <a href="#loginModal" data-toggle="modal" data-dismiss="modal"><h5>Login</h5></a>
				<a href="agent/register"><h5>Agent Register</h5></a>
				<a href="driver/register"><h5>Driver/Cab Register</h5></a>
      </div>
    </div>

  </div>
</div>


<!-- Agent Register Modal -->
<div id="registerAgentModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">CREATE AN ACCOUNT</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open("account/agent_register", array("id"=>"agent_register_form", "enctype" => "multipart/form-data"));?>
				<div class="form-group col-sm-4">
					<input type="text" placeholder="First Name" class="form-control" required name="first_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Last Name" class="form-control" required name="last_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Father's Name" class="form-control" required name="father_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="email" placeholder="Email Address" class="form-control" name="email" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Mobile Number" class="form-control" required name="mobile" />
				</div>

				<div class="form-group col-sm-4">
					<input type="password" placeholder="Password" class="form-control" required name="password" />
				</div>

				<div class="form-group col-sm-6">
					<textarea placeholder="Residential Address" class="form-control" name="residential_address" style="height:100px"></textarea>
				</div>

				<div class="form-group col-sm-6">
					<textarea placeholder="Office Address" class="form-control" name="office_address" style="height:100px"></textarea>
				</div>

				<legend>Upload Documents</legend>
				<div class="form-group col-sm-6">
					<label>Photo</label>
					<input type="file" class="form-control" required name="photo" />
				</div>

				<div class="form-group col-sm-6">
					<label>ID Proof</label>
					<input type="file" class="form-control" required name="id_proof" />
				</div>

				<div class="form-group col-sm-6">
					<label>Address Proof</label>
					<input type="file" class="form-control" required name="address_proof" />
				</div>

				<div class="form-group col-sm-6">
					<label>Office Front Photo</label>
					<input type="file" class="form-control" required name="office_front_photo" />
				</div>

				<div class="form-group col-sm-6">
					<label>Office Inside Photo</label>
					<input type="file" class="form-control" required name="office_inside_photo" />
				</div>

				<div class="form-group col-sm-6">
					<label>Upload Bank Passbook/Cancel Cheque</label>
					<input type="file" class="form-control" required name="bank_proof" />
				</div>

				<div class="form-group col-sm-12">
					<label>Bank Detail</label>
					<textarea placeholder="Bank Detail" class="form-control" name="bank_detail" style="height:100px"></textarea>
				</div>


				<div class="clearfix"></div>





				<button type="submit" class="btn btn-primary">CREATE NOW</button>
				<?php echo form_close();?>
      </div>
      <div class="modal-footer">
        <a href="#loginModal" data-toggle="modal" data-dismiss="modal"><h5>Login</h5></a>
      </div>
    </div>

  </div>
</div>


<!-- Otp Modal -->
<div id="otpModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Verify OTP</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open("account/check_otp", array("id"=>"otp_form"));?>
				<div class="form-group">
					<input type="text" placeholder="OTP" class="form-control" required name="otp" id="otp" />
				</div>

				<input type="hidden" name="register_extra" id="register_extra" value="" />
				<button type="submit" class="btn btn-primary">Verify OTP</button>
				<?php echo form_close();?>
      </div>
    </div>
  </div>
</div>
