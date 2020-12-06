<?php $this->load->view('front/common/header');?>
<div class="wrappage">

<div class="container">
<ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Forget Password</li>        
  </ol>
</div>
<div class="container webcontent">
	<?php echo form_open('account/new_password1');?>
	<input type="hidden" name="for_id" value="<?php echo $id;?>">
	<input type="hidden" name="st" value="<?php echo $_GET['st']?>">
<div class="col-sm-4 col-sm-offset-4">
<legend>New Password</legend>
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
<?php $this->load->view('front/common/footer');?>