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

<div><h2><strong>Withdrawal Request</strong><span class="pull-right" style="font-size:16px;font-weight:bold;color:#F5A129;">In Wallet : <i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?></span></h2></div>

<hr>

<div>
<?php echo form_open("account/withdrawal_request");?>
<div class="col-sm-8">
	<div class="form-group">
		<label>Withdrawal Amount</label>
		<input name="amount" placeholder="Withdrawal Amount" type="text" class="form-control" />
	</div>
</div>

<div class="col-sm-8">
	<div class="form-group">
		<label>Remark</label>
		<textarea name="remark" placeholder="Remark" class="form-control"></textarea>
	</div>
</div>

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
