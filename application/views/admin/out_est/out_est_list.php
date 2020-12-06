<?php $this->load->view('admin/home/header');?>            <div class="page-title">
              <div class="title_left">
                <h3>Outstation Vehicle Rate</h3>

              </div>

              <div class="title_right">
			  <button class="btn btn-danger btn-sm pull-right" onclick="confirm('Really want to delete this page?') ? $('#delete_form').submit() : false;" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/out_est/add"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Outstation Vehicle Rate List</h5>
                <div class="x_panel">

                  <div class="x_content">
				  <?php echo form_open('admin/out_est/delete', array("id"=>"delete_form"));?>
				    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Dept Dates</th>
						  <th>Vehicle</th>
						  <th>From</th>
						  <th>To</th>
						  <th>Fare</th>
						  <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i = 1;
					  foreach($result as $res){?>
					  <tr>
					  <td><input type="checkbox" value="<?php echo $res['data']['id'];?>" name="check_list[]" /></td>
					  <td>
					  <?php
					  foreach($res['dates'] as $dat){
					  echo date("d/m/Y h:i A",strtotime($dat['date']))."<br/>";
					  }
					  ?>

					  </td>
					  <td><?php echo $res['data']['vehicle_name'];?></td>
					  <td><?php echo $res['data']['from'];?></td>
					  <td><?php echo $res['data']['to'];?></td>
					  <td><i class="fa fa-inr"></i><?php echo $res['data']['fare'];?></td>
					  <td>
              <a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/out_est/add?id=<?php echo $res['data']['id'];?>&state=update"><i class="fa fa-pencil"></i></a>
              <a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/out_est/add?id=<?php echo $res['data']['id'];?>&state=copy"><i class="fa fa-files-o"></i></a>
            </td>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
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
