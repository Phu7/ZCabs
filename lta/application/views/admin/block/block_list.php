<?php $this->load->view('admin/home/header');?>

<div class="page-title">
  <div class="title_left">
    <h3>Blocks</h3>

  </div>

  <div class="title_right">
    <button type="button" class="btn btn-danger btn-sm pull-right" onclick="confirm('Really want to delete this page?') ? $('#delete_form').submit() : false;" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
<a class="btn btn-info btn-sm pull-right" data-toggle="tooltip" title="Add" href="<?php echo base_url()?>admin/block/add_form"><i class="fa fa-plus"></i></a>
<?php if($this->session->flashdata('info')){
$info = explode("--", $this->session->flashdata('info'));
$info_type = $info[0];
$msg_data = $info[1];
if($info_type == 2){
?>
<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
<?php } else{?>
<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>
<?php } echo $msg_data; ?> </div><?php }?>
  </div>
</div>

<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<h5><i class="fa fa-list"></i> Block List</h5>
    <div class="x_panel">

      <div class="x_content">
<?php echo form_open('admin/block/delete',array('id'=>'delete_form'));?>
<table id="example" class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Title</th>
              <th>Tools</th>
            </tr>
          </thead>
<tbody>
<?php $i=1;
foreach($block->result() as $block){?>
<tr>
<td><input type="checkbox" name="check_list[]" id="checkbox" class="checkbox" value="<?php echo $block->id; ?>" /></td>
<td><?php echo $block->name;?></td>
<td><?php echo $block->title;?></td>
<td><a href="<?php echo base_url().'admin/block/add_form?id='.$block->id;?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a></td>
</tr>
<?php }?>
</tbody>
        </table>
<?php echo form_close();?>
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
