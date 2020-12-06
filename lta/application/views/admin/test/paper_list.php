<?php $this->load->view('admin/common/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Papers</h3>

              </div>

              <div class="title_right">
        <button class="btn btn-danger btn-sm pull-right" onclick="confirm('Really want to delete this paper?') ? $('#delete_form').submit() : false;" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/test/paper/add_form"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Paper List</h5>
                <div class="x_panel">

                  <div class="x_content">
          <?php echo form_open("admin/test/paper/delete_paper", array("id"=>"delete_form"));?>
           <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Duration</th>
                          <th>Combo Name</th>
                          <th>Start Date</th>
                          <th>End Date</th>
						  <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i=1;
					  foreach($paper->result() as $paper){?>
					  <tr>
					  <td><input type="checkbox" name="checklist[]" value="<?php echo $paper->paper_id;?>" ></td>
					  <td><?php echo $paper->name;?></td>
					  <td><?php echo $paper->duration;?></td>
					  <td><?php echo $paper->combo_name;?></td>
					  <td><?php echo $paper->start_date;?></td>
					  <td><?php echo $paper->end_date;?></td>
					  <td><a href="<?php echo base_url().'admin/test/paper/add_form?id='.$paper->paper_id;?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
            <?php echo form_close(); ?>

                  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/common/footer');?>

			<script>
			$(document).ready(function() {
			     $('#example').dataTable();
			});
			</script>
