<?php $this->load->view('admin/home/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Localities</h3>
				
              </div>

              <div class="title_right">
			  <button type="submit" form="delete_form" class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/location/locality_add"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Localities List</h5>
                <div class="x_panel">
                  <div class="container">
				 
				 
				 <div class="col-sm-4">
				 <label>Search by City Name</label>
				 <select class="form-control" name="city_id" id="city_id"  onchange="window.open('<?php echo base_url()?>admin/location/locality?city='+this.value+'','_self');">
				 <option value="">Search by city Name</option>
				 <?php foreach($city->result() as $city){?>
				 <option value="<?php echo $city->id;?>" <?php echo ($city->id == $this->input->get('id')) ? "selected":"";?>><?php echo $city->name;?></option>
				 <?php }?>
				 </select>
				 </div>
				 </div>                   <div class="x_content">
				  <?php echo form_open('admin/location/delete_locality', array("id"=>"delete_form"));?>
				    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
						  <th>City Name</th>
						  <th>Locality Name</th>
						  <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i = 1;
					  foreach($result->result() as $result){?>
					  <tr>
					  <td><input type="checkbox" value="<?php echo $result->id;?>" name="check_list[]" /></td>
					  <td><?php echo $result->city_name;?></td>
					  <td><?php echo $result->name;?></td>
					  <td><a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/location/locality_add?id=<?php echo $result->id;?>"><i class="fa fa-pencil"></i></button></td>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
                  </div>				 
                  </div>                
                  </div>

			<?php $this->load->view('admin/home/footer');?>