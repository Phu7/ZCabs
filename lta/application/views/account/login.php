<?php $this->load->view("home/common/header_account");?>
<div class="wrappad">


<div class="container webcontent wrappad">
	<div class="col-sm-6">
	<div class="col-sm-12 login_back">
	<LEGEND>Already Registered? </LEGEND>
	<p>Welcome back! <br/> Sign in with your email address and password.</p>
		<?php echo form_open("account/login_submit"); ?>
		<input type="hidden" name="redirection_path" value="<?php /*echo $path;*/?>" />
		<input type="hidden" required class="form-control" name="role_id" value="1" />
		<input type="hidden" name="auth" value="<?php echo md5(time()."f2sf1b35z4b");?>" />
			<div class="form-group">
				<label>Email</label>
				<input type="email" required class="form-control" name="username"/>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" required class="form-control" name="password"/>
			</div>

			<input type="submit" value="LOGIN" class="btn btn-primary" />
			<a href="account/forget_password" class="btn btn-primary">FORGOT PASSWORD ?</a>
		<?php echo form_close(); ?>
	</div>
	</div>


	<div class="col-sm-6">
	<div class="col-sm-12 login_back">

	<LEGEND>Create an account</LEGEND>
	<p>Don’t have an account yet? Sign up below for faster check out and keep track of your progress.</p>
		<?php echo form_open("account/register_submit"); ?>
			<div class="form-group">
				<label>Your Name</label>
				<input type="text" required class="form-control" name="name"/>
				<input type="hidden" required class="form-control" name="role_id" value="1">
				<input type="hidden" name="redirection_path" value="<?php /*echo $path;*/?>" />
			</div>

			<div class="form-group">
				<label>Mobile Number</label>
				<input type="text" required class="form-control" name="mobile"/>
			</div>

			<div class="form-group">
				<label>Email Address</label>
				<input type="email" required class="form-control" name="email"/>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" required class="form-control" name="password"/>
			</div>

			<input type="submit" value="REGISTER" class="btn btn-primary" />
		<?php echo form_close(); ?>
	</div>
</div>
</div>




</div>


<?php $this->load->view("home/common/footer_account"); ?>
