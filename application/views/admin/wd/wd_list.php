<?php $this->load->view('admin/home/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Withdrawal Requests</h3>

              </div>

              <div class="title_right">

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
			 <h5><i class="fa fa-list"></i> Withdrawal Requests</h5>
                <div class="x_panel">

                  <div class="x_content">
				    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Detail</th>
                          <th>Bank Detail</th>
                          <th>Available Amount</th>
                          <th>Requested Amount</th>
                          <th>Created</th>
                          <th>Status</th>
						              <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i = 1;
            foreach($result->result() as $result){ ?>
						<tr>
              <td><input type="checkbox" name="check_list[]" value="<?php echo $result->id; ?>" /></td>
							<td><?php echo $result->first_name." ".$result->last_name . "<br/> Contact : " . $result->mobile;?></td>
							<td><?php echo $result->bank_name . "<br/>" .$result->account_holder_name . "<br/>" . $result->bank_account . "<br/>" . $result->ifsc_code;?></td>
							<td><div class="label label-success"><?php echo $result->wallet;?></div></td>
              <td><div class="label label-danger"><?php echo $result->amount;?></div></td>
    					<td><?php echo date("d/m/Y", strtotime($result->created));?></td>

              <td><?php if($result->status == '1'){
                          echo '<div class="label label-success">Success</div>';
                        } elseif($result->status == '2'){
                          echo '<div class="label label-danger">Denied</div>';
                        } elseif($result->status == '3'){
                          echo '<div class="label label-info">Accepted</div>';
                        } elseif($result->status == '9'){
                          echo '<div class="label label-alert">Pending</div>';
                        } else{
                          echo '<div class="label label-danger">Disable</div>';
                        }
                        ?></td>

							<td><?php if($result->status == '9'){
                  if($result->wallet >= $result->amount){
                      echo '<a class="btn btn-success btn-sm" href="' . base_url().'admin/wd_req/update?id='.$result->id.'&status=3">Accept</a>';
                  }
                      echo '<a class="btn btn-danger btn-sm" href="' . base_url().'admin/wd_req/update?id='.$result->id.'&status=2">Deny</a>';
                     } elseif($result->status == '3'){
                        echo '<a class="btn btn-success btn-sm" href="' . base_url().'admin/wd_req/success?id='.$result->id.'">Success</a>';
                     } else{
                       echo '<div class="label label-success">Nothing To Do</div>';
                     }?></td>
						</tr>
					  <?php } ?>
					  </tbody>
                    </table>
					<?php echo form_close();?>
                  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/home/footer');?>

			<script>
			/*$(document).ready(function() {
			$('#example').dataTable({
				"lengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]],
				"processing":true,
				"serverSide":true,
				"order":[],
				"ajax":{
						url:"admin/user/get_list",
						type:"POST"
					},
					"columnDefs":[
					{
                     "targets":[0,2],
                     "orderable":false
					},
				]
			});
    });*/
			</script>
