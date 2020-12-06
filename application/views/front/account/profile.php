<?php $this->load->view("front/common/header_account");?>
<style>
.bordernone{border:0!important;}
</style>

<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>
<div class="wrappage">


<div class="container wrappad webcontent"  style="margin-bottom:15px;">

<div class="col-sm-4">

<div class="col-sm-12 boxshadow">
<i class="fa fa-user faicon bordernone"></i> Hello
<h4><?php echo $this->session->userdata('customer_name'); ?></h4>
</div>

<div>&nbsp;</div>

<div class="col-sm-12 boxshadow">

<?php if($this->customer->isType() == 1 || $this->customer->isType() == 3){?>
<a href="account/get_history"><div>
<?php } ?>
<?php if($this->customer->isType() == 2){?>
<a href="account/get_driver_history"><div>
<?php } ?>

<i class="fa fa-shopping-cart bordernone carticon"></i>
<h4 style="line-height:30px;">My Trips <i class="fa fa-caret-right bordernone pull-right"></i></h4>
</div></a>
<hr>

<div><i class="fa fa-cog carticon bordernone"></i> <h4 style="line-height:30px;">Account Settings</h4></div>
<div class="profilesetting">
<div><a href="account">Profile Information</a></div>

<?php if($this->customer->isType() == 1){?>
	<div><a href="account/transaction_history">Transaction History</a></div>
	<div><a href="account/payin_history">Wallet History</a></div>
	<div><a href="Javascipt:Void(0);">Wallet Amount (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>) </a></div>
	<div><a href="razorpay">Add Money In Wallet</a></div>
<?php } ?>
		
<?php if($this->customer->isType() == 2){?>
	<div><a href="account/withdrawal">Withdrawal Request</a></div>
	<div><a href="account/transaction_history">Withdrawal History</a></div>
	<div><a href="account/payin_history">Wallet History</a></div>
	<div><a href="Javascipt:Void(0);">Wallet Amount (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>) </a></div>
	<div><a href="razorpay">Add Money In Wallet</a></div>
<?php } ?>

<?php if($this->customer->isType() == 3){?>
	<div><a href="account/withdrawal">Withdrawal Request</a></div>
	<div><a href="account/transaction_history">Withdrawal History</a></div>
	<div><a href="account/payin_history">Wallet History</a></div>
	<div><a href="Javascipt:Void(0);">Wallet Amount (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>) </a></div>
	<div><a href="razorpay">Add Money In Wallet</a></div>
<?php } ?>

</div>

</div>

</div>


<div class="col-sm-8">
<div class="col-sm-12 boxshadow">

<div><h2><strong>Personal Information</strong></h2></div>

<hr>

<div>
<?php echo form_open("account/edit_profile");?>
<div class="col-sm-6">
	<div class="form-group">
		<input name="first_name" placeholder="First Name" type="text" class="form-control" value="<?php echo $result->first_name;?>">
		<input name="dp" type="hidden" value="<?php echo $result->dp;?>">
		<input name="id" type="hidden" value="<?php echo $result->id;?>">
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="last_name" placeholder="Last Name" type="text" class="form-control" value="<?php echo $result->last_name;?>">
	</div>
</div>
<?php if($this->customer->isType() != 3){?>
<div class="col-sm-6">
	<div class="form-group">
		<select name="gender" class="form-control">
			<option value="Male" <?php echo ($result->gender == 'Male') ? "selected":"";?>>Male</option>
			<option value="Female" <?php echo ($result->gender == 'Female') ? "selected":"";?>>Female</option>
			</select>
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="dob" id="dob" placeholder="Date Of Birth" type="text" class="form-control" value="<?php echo ($result->dob != "") ? date("m/d/Y",strtotime($result->dob)):'';?>">
	</div>
</div>
<?php } ?>

<div class="col-sm-6">
	<div class="form-group">
		<input name="email" type="email" readonly required class="form-control" value="<?php echo $result->email;?>">
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="mobile" type="text" readonly class="form-control" value="<?php echo $result->mobile;?>">
	</div>
</div>

<?php if($this->customer->isType() != 3){?>
<div class="col-sm-12">
	<div class="form-group">
		<input name="address" type="text" placeholder="Address" class="form-control" value="<?php echo $result->address;?>">
	</div>
</div>


<div class="col-sm-6">
	<div class="form-group">
		<input name="city" type="text" placeholder="City" class="form-control" value="<?php echo $result->city;?>">
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="state" type="text"  placeholder="State" class="form-control" value="<?php echo $result->state;?>">
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="country" type="text" placeholder="Country" class="form-control" value="<?php echo ($result->country) ? $result->country:'India';?>">
	</div>
</div>


<div class="col-sm-6">
	<div class="form-group">
		<input name="pincode" type="text" placeholder="Pin Code" class="form-control" value="<?php echo ($result->pincode == 0) ? $result->pincode:'';?>">
	</div>
</div>
<?php } else{ ?>
<input name="id" type="hidden" value="<?php echo $result->address;?>">
<div class="col-sm-12">
	<div class="form-group">
		<textarea name="bank_detail" placeholder="Bank Detail" class="form-control" ><?php echo $result->bank_detail;?></textarea>
	</div>
</div>
<?php } ?>
<div class="col-sm-12">
<button class="btn btn-primary btn-sm" type="submit">Submit</button>&nbsp; &nbsp; <a href="account/change_password">Change Password</a>
</div>
<?php echo form_close();?>
</div>
</div>
</div>
<br/><br/><br/>
</div>
<?php $this->load->view("front/common/footer");?>

<script>
 $('#dob').datetimepicker({
                    format:'MM/DD/YYYY'
                  });
</script>
