<?php $this->load->view("front/common/header_account");?>

<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>
<div class="wrappage">



<style>
.bordernone{border:0!important;}
</style>

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

<div><h2><strong>My Trips</strong></h2></div>

<hr>
<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">Incoming</a></li>
    <li><a data-toggle="pill" href="#menu1">Completed</a></li>
  </ul>

	<?php if($this->customer->isType() == 3){ ?>
	<div class="clearfix"></div>
	<hr/>
	<?php echo form_open("account/get_history");?>
	<div class="col-xs-12">
		<div class="col-xs-3"><input type="radio" name="search_radio" id="ab" value="booking_date" <?php echo $search_radio == 'booking_date' ? 'checked':''; ?>/> <label for="ab">By Booking Date</label></div>
		<div class="col-xs-3"><input type="radio" name="search_radio" id="at" value="travel_date" <?php echo $search_radio == 'travel_date' ? 'checked':''; ?>/> <label for="at">By Travel Date</label></div>
		<div class="col-xs-3"><input type="radio" name="search_radio" id="ap" value="psngr_name" <?php echo $search_radio == 'psngr_name' ? 'checked':''; ?>/> <label for="ap">By Name</label></div>
	</div>
	<div class="clearfix"></div>
	<hr/>

	<div class="col-xs-12 ss hidden" id="booking_date">
		<div class="col-xs-4">
			<input type="text" placeholder="Date From" value="<?php echo $booking_from; ?>" id="booking_from" name="booking_from" class="form-control"/>
		</div>

		<div class="col-xs-4">
			<input type="text" placeholder="Date To" id="booking_to" value="<?php echo $booking_to; ?>" name="booking_to" class="form-control"/>
		</div>

		<div class="col-xs-3">
			<button type="submit" class="btn btn-success">Search</button>
		</div>
	</div>

	<div class="col-xs-12 hidden ss" id="travel_date">
		<div class="col-xs-4">
			<input type="text" placeholder="Date From" id="travel_from" value="<?php echo $travel_from; ?>" name="travel_from" class="form-control"/>
		</div>

		<div class="col-xs-4">
			<input type="text" placeholder="Date To" id="travel_to" name="travel_to" value="<?php echo $travel_to; ?>" class="form-control"/>
		</div>

		<div class="col-xs-3">
			<button type="submit" class="btn btn-success">Search</button>
		</div>
	</div>

	<div class="col-xs-12 hidden ss" id="psngr_name">
		<div class="col-xs-4">
			<input type="text" placeholder="First Name" name="first_name" class="form-control"/>
		</div>

		<div class="col-xs-4">
			<input type="text" placeholder="Last Name" name="last_name" class="form-control"/>
		</div>

		<div class="col-xs-3">
			<button type="submit" class="btn btn-success">Search</button>
		</div>
	</div>


<?php echo form_close(); } ?>
	<div class="clearfix"></div>

<div class="col-sm-12">

 <div class="tab-content" style="padding-top:10px;">
    <div id="home" class="tab-pane fade in active">
<div class="table-responsive">


<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>From</th>
			<th>To</th>
			<th>Departure Date</th>
			<th>Passengers</th>
			<th>Status</th>
			<?php echo $this->customer->isType() == 3 ? '<th>Tool</th>':''; ?>
		</tr>
	</thead>
	<tbody>
	<?php $i=1;
	if(!empty($result['incoming'])){
	foreach($result['incoming'] as $order){?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo $order['_from'];?></td>
			<td><?php echo $order['_to'];?></td>
			<td><?php echo strtotime($order['departure_date']) > strtotime('1990-05-05') ? date("d/m/Y h:i A", strtotime($order['departure_date'])):'';?></td>
			<td><?php echo $order['passengers'];?></td>
			<td>

			<?php if($order['status'] == 0){ echo 'Denied'; }
				elseif($order['status'] == 1){ echo 'Incoming'; }
				elseif($order['status'] == 2){ echo 'Incoming'; }
				elseif($order['status'] == 3){ echo 'Denied'; }
				elseif($order['status'] == 4){ echo 'Started'; }
				elseif($order['status'] == 5){ echo 'On The Way'; }
				elseif($order['status'] == 6){ echo 'Completed'; }
				elseif($order['status'] == 7){ echo 'Cancelled'; }
				elseif($order['status'] == 8){ echo 'Cancellation under process Requests'; }
				else{ 'Lost'; }
			?>


			</td>
			<td>

			<?php
			if($order['status'] == 3 OR $order['status'] == 7 OR $order['status'] == 8){
				echo '';
			} else{

			 echo $this->customer->isType() == 3 ? '<button class="btn btn-sm btn-info upbtn" data-id="' . $order['id'] . '"><i class="fa fa-pencil bordernone"></i></button><a class="btn btn-sm btn-danger" title="Cancel Ride" href="' . base_url() . 'account/cancel_ride?id=' . $order['id'] . '"><i class="fa fa-times bordernone"></i></a>':'<a class="btn btn-sm btn-danger" title="Cancel Ride" href="' . base_url() . 'account/cancel_ride?id=' . $order['id'] . '"><i class="fa fa-times bordernone"></i></a>';

		 }
		 ?>
		</td>
		</tr>
	<?php } } else{ ?>
		<tr><td colspan="5" align="center">No Result Found</td></tr>
<?php	}  ?>
	</tbody>
</table>


</div>

</div>

<div id="menu1" class="tab-pane fade">
<div class="table-responsive">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>From</th>
			<th>To</th>
			<th>Departure Date</th>
			<th>Passengers</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
	<?php

	$k=1;
	if(!empty($result['completed'])){
	foreach($result['completed'] as $order1){?>
		<tr>
			<td><?php echo $k++;?></td>
			<td><?php echo $order1['_from'];?></td>
			<td><?php echo $order1['_to'];?></td>
			<td><?php echo strtotime($order1['departure_date']) > strtotime('1990-05-05') ? date("d/m/Y h:i A", strtotime($order1['departure_date'])):'';?></td>
			<td><?php echo $order1['passengers'];?></td>
			<td>

			Completed

			</td>
		</tr>
	<?php } } else{ ?>
		<tr><td colspan="5" align="center">No Result Found</td></tr>
<?php	} ?>
	</tbody>
</table>


</div>

</div>

</div>
</div>
</div>



</div></div>
<!-- Update Modal -->
<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open('account/update_out'); ?>
				<div class="form-group">
					<input type="text" placeholder="Passanger Name" class="form-control" required name="full_name" id="full_name" />
				</div>

				<div class="form-group">
					<input type="text" placeholder="Passenger Mobile Number" class="form-control" required name="mobile" id="update_mobile" />
				</div>

				<div class="form-group">
					<textarea placeholder="Comment" class="form-control" required name="comment" id="update_comment"></textarea>
				</div>


				<input type="hidden" name="id" id="update_id" value="" />
				<button type="submit" class="btn btn-primary">Update</button>
				<?php echo form_close(); ?>
			</div>
    </div>
  </div>
</div>

<?php $this->load->view("front/common/footer");?>
<script>
	$(document).ready(function(){
		$("input[name='search_radio']").on('click', function(){
			var id = $(this).val();
			$(".ss").addClass('hidden');
			$("#"+id).removeClass('hidden');
		});
	});

	$('#booking_from').datetimepicker({
		format:'MM/DD/YYYY'
	});
	$('#booking_to').datetimepicker({
		format:'MM/DD/YYYY'
	});
	$('#travel_from').datetimepicker({
		format:'MM/DD/YYYY'
	});
	$('#travel_to').datetimepicker({
		format:'MM/DD/YYYY'
	});

	$('.upbtn').on('click', (function(e) {
			e.preventDefault();
				$.ajax({
					url: 'account/get_outstat?id='+$(this).data('id'),
					type: "GET",
					contentType: false,
					beforeSend: function() {
						$('#ajax-loader').removeClass('loaderhide');
					},
					complete: function() {
						$('#ajax-loader').addClass('loaderhide');
					},
					success:
					function(data){
							var result = JSON.parse(data);
							var det = '';
							if(result['agent_details'] != ""){
								det = JSON.parse(result['agent_details']);
							}
							if(typeof(det) == 'object'){
								$('#full_name').val(det.name);
								$('#update_mobile').val(det.mobile);
								$('#update_comment').val(det.comment);
							} else{
								$('#full_name').val('');
								$('#update_mobile').val('');
								$('#update_comment').val('');
							}
							$("#update_id").val(result['id'])
							$("#updateModal").modal('show');

					},
					error: function(err){
						console.log(err);
					}
				});
	}));

	(function(){
		var testVal = $("input[name='search_radio']:checked").val();
		$("#"+testVal).removeClass('hidden');
	}());
</script>
