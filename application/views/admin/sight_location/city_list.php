<?php $this->load->view('admin/home/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Cities</h3>
				
              </div>

              <div class="title_right">
			  <button type="submit" form="delete_form" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/sight_location/city_add"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Cities List</h5>
                <div class="x_panel">
                 <div class="col-md-3">
				 <label>Search by State Name</label>
				 <select class="form-control" name="state_id" id="state_id" onchange="window.open('<?php echo base_url()?>admin/sight_location/city?state='+this.value+'','_self');">
				 <option value="">Search by State Name</option>
				 <?php foreach($state->result() as $state){?>
				 <option value="<?php echo $state->id;?>" <?php echo ($state->id == $this->input->get('id')) ? "selected":"";?>><?php echo $state->name;?></option>
				 <?php }?>
				 </select>
				 </div>
                  <div class="x_content">
				  <?php echo form_open('admin/sight_location/delete_city', array("id"=>"delete_form"));?>
				    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
						  <th>State Name</th>
						  <th>City Name</th>
						  <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i = 1;
					  foreach($result->result() as $result){?>
					  <tr>
					  <td><input type="checkbox" value="<?php echo $result->id;?>" name="check_list[]" /></td>
					  <td><?php echo $result->state_name;?></td>
					  <td><?php echo $result->name;?></td>
					  <td><a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/location/city_add?id=<?php echo $result->id;?>"><i class="fa fa-pencil"></i></button></td>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
                  </div>				 
                  </div>                
                  </div>

			<?php $this->load->view('admin/home/footer');?>