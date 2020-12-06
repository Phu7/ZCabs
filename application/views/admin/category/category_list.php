<?php $this->load->view('admin/home/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Category</h3>
				
              </div>

              <div class="title_right">
			  <button class="btn btn-danger btn-sm pull-right" onclick="confirm('Really want to delete this category?') ? $('#delete_form').submit() : false;" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/category/add"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Category List</h5>
                <div class="x_panel">
                 
                  <div class="x_content">
				  <?php echo form_open("admin/category/delete", array("id"=>"delete_form"));?>
				    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Category Name</th>						  
						  <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php 
					 if($result->num_rows()){
						
						foreach($result->result() as $result){
							 if(is_null($result->up3_name)){
							$up3="";  
						  }else{
							  $up3 = $result->up3_name."->";
						  }
						  
						  if(is_null($result->up2_name)){
							$up2="";  
						  }else{
							  $up2 = $result->up2_name."->";
						  }
						  
						  if(is_null($result->up1_name)){
							$up1="";  
						  }else{
							  $up1 = $result->up1_name."->";
						  }
						  $category1 = $up3.$up2.$up1.$result->node_name;
							?>
					  <tr>
					  <th scope="row"><input type="checkbox" name="checklist[]" value="<?php echo $result->node_id;?>"></th>
						  <td><?php echo $category1;?></td>
					  <td><a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/category/add?id=<?php echo $result->node_id;?>"><i class="fa fa-pencil"></i></button></td>
					  </tr>
					 <?php }}?>
					  </tbody>
                    </table>
					<?php echo form_close();?>
                  </div>				 
                  </div>                
                  </div>

			<?php $this->load->view('admin/home/footer');?>