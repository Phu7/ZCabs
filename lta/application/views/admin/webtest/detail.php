<?php $this->load->view('admin/common/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Paper</h3>
				
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
			 <h5><i class="fa fa-list"></i> Paper Detail</h5>
                <div class="x_panel">
                 
                  <div class="x_content">
				<div class="" role="tabpanel" data-example-id="togglable-tabs">                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">                        <?php $i = 1;foreach($result as $section){?>						<li role="presentation" class="<?php echo $i == 1 ? 'active':'';?>"><a href="#tab_content<?php echo $i; ?>" id="<?php echo $section['name']; ?>-tab" role="tab" data-toggle="tab" aria-expanded="true"><?php echo $section['name']; ?></a>                        </li>						<?php $i++;} ?>						                      </ul>					  					  					   <div id="myTabContent" class="tab-content">						 <?php 						 $j = 1;						 foreach($result as $section){?>						 <div role="tabpanel" class="tab-pane fade <?php echo $j == 1 ? 'active in' :''; ?>" id="tab_content<?php echo $j; ?>" aria-labelledby="<?php echo $section['name'];?>-tab">														<table class="table example table-bordered">							  <thead>								<tr>								  <th>#</th>								  <th>Question</th>						  								  								  <th>Tools</th>								</tr>							  </thead>							  <tbody>							  <?php 								$i = 1;							 foreach($section['questions'] as $question){ ?>							  <td><?php echo $i++;?></td>								  <td><?php echo $question['question'];?></td>								  <td><a class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/test/webtest/add?id=<?php echo $question['id'];?>"><i class="fa fa-pencil"></i></a><a class="btn btn-delete btn-sm" href="<?php echo base_url()?>admin/test/webtest/delete?id=<?php echo $question['id'];?>"><i class="fa fa-trash"></i></a></td>							  </tr>							 <?php $i++; }?>							  </tbody>							</table>						 </div>						 <?php $j++;  } ?>					   </div>
				    
					<?php echo form_close();?>
                  </div>				 
                  </div>                
                  </div>

			<?php $this->load->view('admin/common/footer');?>						<script>				$(".example").dataTable();						</script>