<?php $this->load->view("front/common/header");?>

<div class="wrappage">

<div class="container">
<ol class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Profile Edit</li>        
  </ol>
</div>


<div class="container wrappad webcontent">

<div class="col-sm-4">

<div class="col-sm-12 boxshadow">
<i class="fa fa-user faicon bordernone"></i> Hello
<h4><?php echo $this->session->userdata('customer_name'); ?></h4>
</div>

<div>&nbsp;</div>

<div class="col-sm-12 boxshadow">

<a href="account/order_history"><div>
<i class="fa fa-shopping-cart carticon bordernone"></i> 
<h4 style="line-height:30px;">My Orders <i class="fa fa-caret-right bordernone pull-right"></i></h4>
</div></a>

<hr>

<div><i class="fa fa-cog carticon bordernone"></i> <h4 style="line-height:30px;">Account Settings</h4></div>
<div class="profilesetting">
<div><a href="account">Profile Information</a></div>
<div><a href="account/address">Manage Addresses</a></div>
</div>

</div>

</div>




<div class="col-sm-8">
<div class="col-sm-12 boxshadow">

<div><h2><strong>Personal Information</strong></h2></div>

<hr>

<div>

	<div class="form-group">
		<input name="" type="text" readonly class="form-control" value="<?php echo $result->name;?>">
	</div>

<!--div class="col-sm-12">
	<strong>Your Gender</strong><br>
		<label class="radio-inline"><input type="radio" value="Male" name="gender" <?php echo ($result->gender == 'Male') ? 'checked':''; ?>>Male</label>
		<label class="radio-inline"><input type="radio" value="Female" name="gender" <?php echo ($result->gender == 'Female') ? 'checked':''; ?>>Female</label>
</div-->

<hr/>


<div><h2><strong>Email Address</strong></h2></div>

<hr>

<div class="row">
<div class="col-sm-6">
<div class="form-group"><input name="" type="text" readonly class="form-control" value="<?php echo $result->email;?>"></div>
<a href="account/change_password" class="btn btn-default">Change Password</a>
</div>
</div>

</div>
</div>
</div></div>
<?php $this->load->view("front/common/footer");?>