<?php $this->load->view('admin/common/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Sections</h3>

              </div>

              <div class="title_right">
			  <button class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/test/section/add_form"><i class="fa fa-plus"></i></a>
 <?php if($this->admin->getInfo()){
		$info = explode("--", $this->admin->getInfo());
		$info_type = $info[0];
		$msg_data = $info[1];
		if($info_type == 1){
 ?>
 <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
		<?php } else{?>
		 <div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
		<?php } echo $msg_data; ?> </div><?php } $this->admin->removeInfo();?>
              </div>
            </div>

            <div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
			 <h5><i class="fa fa-list"></i> Section List</h5>
                <div class="x_panel">

                  <div class="x_content">
				    <table id="datatables" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Combo Name</th>
                          <th>Paper Name</th>
                          <th>Section Name</th>
                          <th>Mark(Right)</th>
                          <th>Mark(wrong)</th>
                          <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i=1;
					  foreach($section->result() as $section){?>
					  <tr>
					  <td><?php echo $i++;?></td>
					  <td><?php echo $section->combo_name;?></td>
					  <td><?php echo $section->paper_name;?></td>
					  <td><?php echo $section->name;?></td>
					  <td><?php echo $section->right_mark;?></td>
					  <td><?php echo $section->wrong_mark;?></td>
					  <td><a href="<?php echo base_url().'admin/test/section/add_form?id='.$section->section_id;?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a></td>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
                  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/common/footer');?>
