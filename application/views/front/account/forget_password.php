<?php $this->load->view('front/common/header');?>
<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>
<div class="wrappage">

<div class="container">
<ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Forget Password</li>        
  </ol>
</div>
<div class="container webcontent">
	<?php echo form_open('account/send_forget_password');?>
<div class="col-sm-4 col-sm-offset-4">
<legend>Forgot Password ?</legend>
	
	
	<div class="form-group">
		<input type="text" required name="mobile" placeholder="Registered Mobile Number" class="form-control"/>
	</div>
	
	<button type="submit" class="btn btn-primary pull-right">Submit</button>
	<br/><br/>&nbsp;
</div>
<?php echo form_close();?>
</div>
</div>
<?php $this->load->view('front/common/footer');?>