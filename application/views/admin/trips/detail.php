<?php
$this->load->view('admin/home/header');?>            <div class="page-title">
              <div class="title_left">
                <h3>Trips</h3>

              </div>

              <div class="title_right">
			  <?php if($result->status == '1'){ ?>
			 <div class="col-sm-10">
			 <?php echo form_open("admin/trips/accept");?>
			 <div class="col-sm-4">
			 <input type="hidden" name="id" value="<?php echo $this->input->get('id');?>" class="form-control">
			 <input type="text" name="price" value="<?php echo $result->order_price;?>" class="form-control" required placeholder="Price">
			 </div>
			 <div class="col-sm-4">
			 <select name="driver" required class="form-control">
				<option value="">Select Driver</option>
				<?php foreach($drivers->result() as $driver){?>
				<option value="<?php echo $driver->id; ?>" <?php echo ($driver->id == $result->driver) ? "selected":"";?>><?php echo $driver->first_name . " " . $driver->last_name;?></option>
				<?php } ?>
			</select>
			 </div>
			 <div class="col-sm-4">
			  <button class="btn btn-success" type="submit">Accept</button>
			  </div>
			  <?php echo form_close(); ?>
			  </div>
			  <div class="col-sm-2">
			  <a href="<?php echo base_url();?>admin/trips/manage_status?id=<?php echo $this->input->get('id');?>&status=3" class="btn btn-danger">Deny</a>
			  </div>
			  <?php } ?>

			  <?php if($result->status == '2'){ ?>
			  <a href="<?php echo base_url();?>admin/trips/manage_status?id=<?php echo $this->input->get('id');?>&status=3" class="btn btn-danger pull-right">Deny</a>
			  <a href="<?php echo base_url();?>admin/trips/manage_status?id=<?php echo $this->input->get('id');?>&status=4" class="btn btn-success pull-right">Start</a>
			  <?php } ?>

			  <?php if($result->status == '4'){ ?>
			  <a href="<?php echo base_url();?>admin/trips/manage_status?id=<?php echo $this->input->get('id');?>&status=6" class="btn btn-success pull-right">Completed</a>
			  <?php } ?>

 <?php if($this->admin->getInfo()){
		$info = explode("--", $this->admin->getInfo());
		$info_type = $info[0];
		$msg_data = $info[1];
		if($info_type == 2){
 ?>
 <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
		<?php } else{?>
		 <div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
		<?php } echo $msg_data; ?> </div><?php } $this->admin->removeInfo();?>
              </div>
            </div>

            <div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			 <h5><i class="fa fa-list"></i> Trips List</h5>
                <div class="x_panel">



                  <div class="x_content">

				  <div class="col-sm-6">
					<legend>Customer Info</legend>
					<p>Name: <?php echo $result->customer_first_name." ".$result->customer_last_name;?></p>
					<p>Email: <?php echo $result->customer_email;?></p>
					<p>Mobile: <?php echo $result->customer_mobile;?></p>
					<p>Address: <?php echo $result->customer_address."<br/>".$result->customer_city.", ".$result->customer_state."<br/>".$result->customer_country." - ".$result->customer_pincode;?></p>
				 </div>

				 <div class="col-sm-6">
					<legend>Other Info</legend>
					<p>Pickup Location: <?php echo $result->pickup_point;?></p>
					<p>Drop Location: <?php echo $result->drop_point;?></p>
					<p>Assigned Driver: <?php echo $result->driver_first_name." ".$result->driver_last_name;?></p>
					<p>Driver Contact: <?php echo $result->driver_mobile;?></p>
					<p>Vehicle Demand: <?php echo $result->vehicle_name;?></p>
					<p>Vehicle: <?php echo $result->vehicle_name_final."<br/>".$result->vehicle_number;?></p>
					<p>Type: <?php if($result->type == '1'){ echo 'One Way'; }
								elseif($result->type == '2'){ echo 'Round Trip'; }
								elseif($result->type == '3'){ echo 'Sight Seeing'; }
								elseif($result->type == '4'){ echo 'Local Trip'; }
								else{ echo "No type Found";}
								?></p>
					<p>Price: <?php echo $result->order_price;?></p>
					<p>Price Approach: <?php echo $result->percent;?>%(<i class="fa fa-inr"></i> <?php echo $result->order_price * ($result->percent/100);?>)</p>
					<p>Status: <?php if($result->status == '1'){ echo '<div class="label label-info">Recieved</div>'; }
								elseif($result->status == '2'){ echo '<div class="label label-success">Accepted</div>'; }
								elseif($result->status == '3'){ echo '<div class="label label-danger">Admin Denied</div>'; }
								elseif($result->status == '4'){ echo '<div class="label label-warning">Started</div>'; }
								elseif($result->status == '5'){ echo '<div class="label label-warning">On The Way</div>'; }
								elseif($result->status == '6'){ echo '<div class="label label-success">Completed</div>'; }
								elseif($result->status == '7'){ echo '<div class="label label-danger">Customer Cancel</div>'; }
					  ?></p>
				 </div>

				  <div class="col-sm-12">
					<legend>Trip Detail</legend>
						<?php if($result->type != '3'){?>
						<p><strong>From:</strong> <?php echo $result->_from;?></p>
						<p><strong>To:</strong> <?php echo $result->_to;?></p>
						<p><strong>Departure Date/Time:</strong> <?php echo date("d/m/Y h:i A", strtotime($result->departure_date));?></p>
						<?php if($result->type == '2'){?>
						<p><strong>Return Date/Time:</strong> <?php echo date("d/m/Y h:i A", strtotime($result->departure_date));?></p>
						<?php } ?>
						<p><strong>Passengers:</strong> <?php echo $result->passengers; ?></p>
						<?php } else{?>
						<p><strong>Sight Name:</strong> <a href="<?php echo base_url();?>sight/<?php echo $result->sight_slug;?>"><?php echo $result->sight_name;?></a></p>
						<?php } ?>
				  </div>


          <div class="col-sm-12">
            <legend>Transaction Detail</legend>
            <div class="col-sm-6">
            <?php if($result->transaction_detail && $result->status != 0){
              $pd = json_decode($result->transaction_detail);
              if($pd->status == 'captured'){ ?>
              <p>Transaction By : RazorPay</p>
              <p>Transaction Id : <?php echo $pd->id;?></p>
              <p>Amount : <?php echo $amount_razor = $pd->amount/100;?></p>

          <?php } } else{
            $amount_razor = 0;
            ?>
              <p></p>
            <?php } ?>
          </div>


          <div class="col-sm-6">
          <?php if($result->status != 0){ ?>
            <p>Transaction By : Wallet</p>
            <p>Amount : <?php echo $result->order_price - $amount_razor;?></p>

        <?php  } ?>
        </div>


          </div>

				  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/home/footer');?>

			<script>
			 $(document).ready(function(){
				$('#example').dataTable({
				"lengthMenu": [[50, 100, 500], [50, 100, 500]],
				dom: 'Blfrtip',
					buttons: [
						'csv'
					],

			});
			});
			</script>
