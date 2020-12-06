<?php $this->load->view('front/common/header');?>
<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>
			<div class="wrappage">

<div class="container">
<ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Change Password</li>        
  </ol>
</div>
<div class="container webcontent">
	<?php echo form_open('account/submit_change_password');?>
<div class="col-sm-4 col-sm-offset-4">
<legend>Change Password</legend>
	
	<div class="form-group">
	<input type="password" required name="old_password" placeholder="Old Password" class="form-control"/>
	</div>
	
	<div class="form-group">
	<input type="password" required name="new_password" placeholder="New Password" class="form-control"/>
	</div>
	
	<div class="form-group">
	<input type="password" required name="con_password" placeholder="Confirm Password" class="form-control"/>
	</div>
	
	<button type="submit" class="btn btn-primary pull-right">Submit</button>
	<br/><br/>&nbsp;
</div>
<?php echo form_close();?>
</div>
</div>
<?php $this->load->view('front/common/footer');?>