<?php $this->load->view("front/common/header");?>
<style>
.gray-box{
	border:1px solid #eaeaea;
	background:#f9f9f9;
	text-align:left;
	margin-bottom: 20px;
	padding-top: 10px;
	padding-bottom: 10px;
}

</style>
<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>
<div style="margin-top:30px;">
  <div class="container">
		<div class="col-sm-6">
			<div class="col-sm-12 gray-box">
			<legend>Login Here</legend>
			<?php echo form_open("account/login_home_submit");?>
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" required class="form-control" />
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" required class="form-control" />
			</div>
			<div class="clearfix"></div>
			<input type="submit" value="Login" class="btn btn-lg btn-primary" />
			<?php echo form_close();?>
		</div>
		</div>


		<div class="col-sm-6">
		<div class="col-sm-12 gray-box">
			<legend>Register Here</legend>
			<?php echo form_open("account/register");?>
			<div class="form-group">
				<label>First Name</label>
				<input type="text" name="first_name" required class="form-control" />
			</div>

			<div class="form-group">
				<label>Last Name</label>
				<input type="text" name="last_name" required class="form-control" />
			</div>

			<div class="form-group">
				<label>Mobile</label>
				<input type="text" name="mobile" required class="form-control" />
			</div>

			<!--div class="form-group">
				<label>Email</label>
				<input type="email" name="email" class="form-control" />
			</div-->

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" required class="form-control" />
			</div>

			<input type="submit" value="Register" class="btn btn-lg btn-primary"/><br/><br/>
			<?php echo form_close();?>
		</div>
		</div>

  </div>
</div>
<?php $this->load->view("front/common/footer");?>
