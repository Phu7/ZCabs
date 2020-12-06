<?php $this->load->view('admin/home/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>User</h3>

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
			 <h5><i class="fa fa-list"></i> User</h5>
                <div class="x_panel">

                  <div class="x_content">
				    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th><td><?php echo $result->id;?></td></tr>
                          <tr><th>Role</th><td>Agent</td></tr>
                          <tr><th>Name</th><td><?php echo $result->first_name . " " . $result->last_name;?></td></tr>
                          <tr><th>Email</th><td><?php echo $result->email;?></td></tr>
                          <tr><th>Contact</th><td><?php echo $result->mobile;?></td></tr>
                          <tr><th>Id Proof</th><td><a target="_blank" href="<?php echo base_url().$result->id_proof;?>" ><img src="<?php echo base_url().$result->id_proof;?>" width="100px;"/></a></td></tr>
                          <tr><th>Office Address</th>	<td><?php echo $result->address;?></td></tr>
                          <tr><th>Office Front</th>	<td><a target="_blank" href="<?php echo base_url().$result->office_front_photo;?>" ><img src="<?php echo base_url().$result->office_front_photo;?>" width="100px;"/></a></td></tr>
                          <tr><th>Office Inside</th>	<td><a target="_blank" href="<?php echo base_url().$result->office_inside_photo;?>" ><img src="<?php echo base_url().$result->office_inside_photo;?>" width="100px;"/></a></td></tr>
                          <tr><th>Residential Address</th>	<td><?php echo $result->raddress;?></td></tr>
                          <tr><th>Address Proof</th>	<td><a target="_blank" href="<?php echo base_url().$result->address_proof;?>" ><img src="<?php echo base_url().$result->address_proof;?>" width="100px;"/></a></td></tr>
                          <tr><th>Bank Detail</th>	<td><strong>Bank Name:</strong><?php echo $result->bank_name;?><br/><strong>Account Holder Name:</strong><?php echo $result->account_holder_name;?><br/><strong>Bank Account:</strong><?php echo $result->bank_account;?><br/><strong>IFSC Code:</strong><?php echo $result->ifsc_code;?><br/></td></tr>
                          <tr><th>Bank Proof</th>	<td><a target="_blank" href="<?php echo base_url().$result->bank_proof;?>" ><img src="<?php echo base_url().$result->bank_proof;?>" width="100px;"/><a/></td></tr>

                          </tr>
                      </thead>

                    </table>
					</div>
                  </div>
                  </div>

			<?php $this->load->view('admin/home/footer');?>
