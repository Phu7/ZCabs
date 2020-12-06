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
                          <tr><th>Role</th><td><?php echo $result->id;?></td></tr>
                          <tr><th>Name</th><td><?php echo $result->name;?></td></tr>
                          <tr>						  
                          <th>Username</th><td><?php echo $result->username;?></td></tr>
                          <tr>						  
                          <th>Company Name</th><td><?php echo $result->company_name;?></td></tr>
                          <tr>						  
                          <th>Email</th><td><?php echo $result->email;?></td></tr>
                          <tr>						  
                          <th>Contact</th><td><?php echo $result->phone;?></td></tr>
                          <tr>						  
                          <th>Address</th>	<td><?php echo $result->address;?></td></tr>
                          <tr>					  
                          <th>Website</th>	<td><?php echo $result->website;?></td></tr>
                          <tr>					  
                          <th>Resale Tax Id</th>	<td><?php echo $result->resale_tax_id;?></td></tr>
                          					  
                          </tr>
                      </thead>
					  
                    </table>
					</div>				 
                  </div>                
                  </div>
			
			<?php $this->load->view('admin/home/footer');?>
			
			