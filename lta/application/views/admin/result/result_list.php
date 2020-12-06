<?php $this->load->view('admin/home/header');?>            <div class="page-title">
              <div class="title_left">
                <h3>Results</h3>

              </div>

              <div class="title_right">
			  <button class="btn btn-danger btn-sm pull-right" onclick="confirm('Really want to delete this page?') ? $('#delete_form').submit() : false;" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
			  <a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/result/add"><i class="fa fa-plus"></i></a>
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
			 <h5><i class="fa fa-list"></i> Result List</h5>
                <div class="x_panel">

                  <div class="x_content">
				  <?php echo form_open('admin/result/delete', array("id"=>"delete_form"));?>
				    <table id="example" class="table table-bordered">
              <thead>

<tr>
<th>S.No.</th>
<th>Name</th>
<th>University</th>
<th> Rank</th>
<th> Roll No.</th>
<th> Photo</th>
<th>Status</th>
<th>Tools</th>
</tr>
</thead>
					  <tbody>
					  <?php $i = 1;
					  foreach($result->result() as $result){?>
					  <tr>
					  <td><input type="checkbox" value="<?php echo $result->id;?>" name="check_list[]" /></td>
            <td><?php echo $result->title;?></td>
        	  <td><?php echo $result->university;?></td>
        	  <td><?php echo $result->rank;?></td>
        	  <td><?php echo $result->rollno;?></td>
        	  <td><img src="<?php echo base_url().$result->image;?>" height="60px"></td>
        	  <td><?php echo $result->status == 1 ? "Active":"Not Active"; ?></td>
            <td><a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/result/add_form?id=<?php echo $result->id;?>"><i class="fa fa-pencil"></i></button></td>
					  </tr>
					  <?php }?>
					  </tbody>
                    </table>
                  </div>
                  </div>
                  </div>

			<?php $this->load->view('admin/home/footer');?>

			<script>
			 $(document).ready(function() {
				$('#example').dataTable({
				"lengthMenu": [[50, 100, 500], [50, 100, 500]],
				dom: 'Blfrtip',
					buttons: [
						'csv'
					],

			});
			});
			</script>
