<?php $this->load->view('admin/common/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Combos</h3>

              </div>

              <div class="title_right">
			  <button class="btn btn-danger btn-sm pull-right" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/test/combo/add_form"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Combo List</h5>
                <div class="x_panel">

                  <div class="x_content">
				    <table id="example" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Tests</th>
                          <th>Status</th>
                          <th>Tools</th>
                        </tr>
                      </thead>
					  <tbody>
					  <?php $i=1;
					  foreach($result->result() as $result){?>
					  <tr>
					  <td><input type="checkbox" name="checklist[]" value="<?php echo $result->id;?>" ></td>
					  <td><?php echo $subject->name;?></td>
            <td><?php echo $subject->price;?></td>
            <td><?php echo $subject->tests;?></td>
            <td><?php echo $subject->status == '1' ? '<div class="label label-success">Enable</div>':'<div class="label label-success">Disable</div>';?></td>
					  <td><a href="<?php echo base_url().'admin/test/combo/add_form?id='.$result->id;?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a></td>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
                  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/common/footer');?>

			<script>
			$(document).ready(function() {
			     $('#example').dataTable();
			});
			</script>
