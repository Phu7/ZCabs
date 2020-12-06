<?php $this->load->view('home/common/header_account');?>
<div class="wrappad">


<div class="container webcontent wrappad">
	<?php echo form_open('account/submit_change_password');?>
<div class="login_back col-sm-4 col-sm-offset-4">
<legend>Change Password</legend>

	<div class="form-group">
	<input type="password" required name="old_password" placeholder="Old Password" class="form-control"/>
	</div>

	<div class="form-group">
	<input type="password" required name="new_password" placeholder="New Password" class="form-control"/>
	</div>

	<div class="form-group">
	<input type="password" required name="confirm_password" placeholder="Confirm Password" class="form-control"/>
	</div>

	<button type="submit" class="btn btn-primary pull-right">Submit</button>

</div>
<?php echo form_close();?>
</div>
</div>
<?php $this->load->view('home/common/footer_account');?>
