<?php $this->load->view("front/common/header_account");?>

<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>
<div class="wrappage">



<style>
.bordernone{border:0!important;}
</style>

<div class="container wrappad webcontent" style="margin-bottom:15px;">

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

<div><h2><strong>My Wallet</strong></h2></div>


<div class="table-responsive">


<table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>#</th>
			<th>Transaction Id</th>
			<th>Amount</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
	<?php $i=1;

	if($result->num_rows()){
	foreach($result->result() as $result){?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo json_decode($result->detail)->id;?></td>
			<td><?php echo $result->amount;?></td>
			<td><?php echo date("d/m/Y h:i A", strtotime($result->created));?></td>
		</tr>
	<?php } } else{ ?>
		<tr><td colspan="4">No Data Found</td></tr>
	<?php } ?>
	</tbody>
</table>




</div></div>



</div></div>


<?php $this->load->view("front/common/footer");?>
