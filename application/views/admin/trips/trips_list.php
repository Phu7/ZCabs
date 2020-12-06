<?php $this->load->view('admin/home/header');?>            <div class="page-title">
              <div class="title_left">
                <h3>Trips</h3>

              </div>

              <div class="title_right">
			  <button class="btn btn-danger btn-sm pull-right" onclick="confirm('Really want to delete this trips?') ? $('#delete_form').submit() : false;" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <!--a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php //echo base_url()?>admin/cms/add"><i class="fa fa-plus"></i></a-->
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
				  <?php echo form_open("admin/trips/delete", array("id"=>"delete_form"));?>
				    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
						  <th>From</th>
						  <th>To</th>
						  <th>Customer Detail</th>
						  <th>Departure</th>
						  <th>Return</th>
						  <th>Passengers/Cabs</th>
						  <th>Trip Type</th>
						  <th>Status</th>
						  <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i = 1;
					  foreach($result->result() as $result){?>
					  <tr>
					  <td><input type="checkbox" value="<?php echo $result->id;?>" name="check_list[]" /></td>
					  <td><?php echo ($result->type != '3') ? $result->_from . '<br/><hr/>' . $result->pickup_point : '<a href="' . base_url().'sight/'.$result->sight_slug . '" target="_blank">'.$result->sight_name.'</a>';?></td>
					  <td><?php echo $result->_to . '<br/><hr/>' . $result->drop_point;?></td>
					  <td><?php echo $result->first_name." ".$result->last_name."<br/>".$result->email."<br/>".$result->mobile;?></td>
					  <td><?php echo ($result->departure_date == '0000-00-00 00:00:00' OR date("Y-m-d", strtotime($result->departure_date)) == '1970-01-01') ? 'N/A' : date("d/m/Y h:i A", strtotime($result->departure_date));?></td>
					  <td><?php echo ($result->return_date == '0000-00-00 00:00:00' OR date("Y-m-d", strtotime($result->return_date)) == '1970-01-01') ? 'N/A':date("d/m/Y h:i A", strtotime($result->return_date));?></td>
					  <td><?php echo $result->passengers;?>  <?php echo ($result->vehicle_name) ? '/'.$result->vehicle_name:'';?></td>
					  <td><?php if($result->type == '1'){ echo 'One Way'; }
								elseif($result->type == '2'){ echo 'Round Trip'; }
								elseif($result->type == '3'){ echo 'Sight Seeing'; }
								elseif($result->type == '4'){ echo 'Local Trip'; }
								else{ echo "No type Found";}
								?>
								<br/>
								<?php echo ($result->pool_type) ? $result->pool_type:'';?>

								</td>
					  <td><?php if($result->status == '0'){ echo '<div class="label label-danger">Not Accepted</div>'; }
                elseif($result->status == '1'){ echo '<div class="label label-info">Recieved</div>'; }
								elseif($result->status == '2'){ echo '<div class="label label-success">Accepted</div>'; }
								elseif($result->status == '3'){ echo '<div class="label label-danger">Admin Denied</div>'; }
								elseif($result->status == '4'){ echo '<div class="label label-warning">Started</div>'; }
								elseif($result->status == '5'){ echo '<div class="label label-warning">On The Way</div>'; }
								elseif($result->status == '6'){ echo '<div class="label label-success">Completed</div>'; }
								elseif($result->status == '7'){ echo '<div class="label label-danger">Customer Cancel</div>'; }
                elseif($result->status == '8'){ echo '<div class="label label-danger">Customer Cancel Request</div>'; }
					  ?></td>
					  <td>
              <a class="btn btn-info btn-sm" title="Detail" href="<?php echo base_url()?>admin/trips/detail?id=<?php echo $result->id;?>"><i class="fa fa-pencil"></i></a>
              <?php if($result->status == '8'){ ?>
              <a class="btn btn-danger btn-sm" title="Cancel Ride" href="<?php echo base_url()?>admin/trips/cancel?id=<?php echo $result->id;?>"><i class="fa fa-times"></i></a>
            <?php } ?>
            </td>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
					<?php echo form_close();?>
                  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/home/footer');?>

			<script>
			 $(document).ready(function() {
				$('#example').dataTable({
				"lengthMenu": [[50, 100, 500], [50, 100, 500]],
				dom: 'Blfrtip',
					buttons: [
						'csv'
					],

			});
			});
			</script>
