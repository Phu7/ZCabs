<?php $this->load->view('admin/common/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Papers</h3>

              </div>

              <div class="title_right">
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/test/webtest/add"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Papers List</h5>
                <div class="x_panel">

                  <div class="x_content">

				    <table id="datatable" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Combo Name</th>						                            <th>Paper Name</th>
						  <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php 						$i = 1;
					 foreach($result->result() as $result){ ?>
					  <td><?php echo $i++;?></td>
						  <td><?php echo $result->combo_name;?></td>						  <td><?php echo $result->name;?></td>
							<td><a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/test/webtest/detail?id=<?php echo $result->paper_id;?>">Detail</a></td>
					  </tr>
					 <?php }?>
					  </tbody>
                    </table>
					<?php echo form_close();?>
                  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/common/footer');?>
