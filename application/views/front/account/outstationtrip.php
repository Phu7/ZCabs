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

<?php if($this->customer->isType() == 3){?>
	<div><a href="account/withdrawal">Withdrawal Request</a></div>
	<div><a href="account/transaction_history">Withdrawal History</a></div>
	<div><a href="account/payin_history">Wallet History</a></div>
	<div><a href="Javascipt:Void(0);">Wallet Amount (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>) </a></div>
	<div><a href="razorpay">Add Money In Wallet</a></div>
<?php } ?>
<?php if($this->customer->isType() == 2){?>
	<div><a href="account/withdrawal">Withdrawal Request</a></div>
	<div><a href="account/transaction_history">Withdrawal History</a></div>
	<div><a href="account/payin_history">Wallet History</a></div>
	<div><a href="Javascipt:Void(0);">Wallet Amount (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>) </a></div>
	
<?php } ?>
</div>

</div>

</div>




<div class="col-sm-8">
<div class="col-sm-12 boxshadow">

<div><h2><strong>Outstation Trip Schedule</strong></h2></div>

<hr>

<div>
<?php echo form_open("account/outstationtripadd");?>
<div class="col-sm-12">
	<div class="form-group">
	    <lable>Choose the Trip Category</lable>
		<select class="form-control" name="category">
		    <option>Outstation Share Rates</option>
            <option>Outstation Reserved Rates</option>
		</select>
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="goingfrom" placeholder="Going From" type="text" class="form-control" >
		<input name="uid" type="hidden" value="<?php echo $this->customer->getId();?>">
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="goingto" placeholder="Going To" type="text" class="form-control" >
	</div>
</div>


<div class="col-sm-6">
	<div class="form-group">
		<input name="datee" placeholder="Date" type="text" id="dob" class="form-control" >
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="fare" placeholder="Offer Fare" type="text" class="form-control" >
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="vname" placeholder="Vehicle Name" type="text" class="form-control" >
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group">
		<input name="aseats" placeholder="Available Seats" type="text" class="form-control" >
	</div>
</div>
<div class="col-sm-12">
<button class="btn btn-primary btn-sm" type="submit" >Submit</button>&nbsp; &nbsp; 
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
                    format:'DD/MM/YYYY hh:mm'
                  });
</script>
