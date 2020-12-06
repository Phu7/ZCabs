<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Add Locality</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/location/locality"><i class="fa fa-reply"></i></a>
				<button class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save" onclick="form_submit()"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>
			  
			  
<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add locality</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
					<?php echo form_open("admin/location/add_locality",array("enctype"=>"multipart/form-data","id"=>"demo-form2","class"=>"form-horizontal form-label-left")); ?>
						
                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                     
					  
						
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">City Name <span class="required">*</span>
                        </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
                           <select class="form-control" name="city_id" id="city_id" >
							 <option value="">Select city</option>
							<?php foreach($city->result() as $city){?>
							 <option value="<?php echo $city->id;?>" <?php echo ($city->id == $this->input->get('id')) ? "selected":"";?>><?php echo $city->name;?></option>
							 <?php }?>
						</select>
						</div>
                     </div>
						
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php echo $name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					   
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="status" name="status" class="form-control col-md-7 col-xs-12">
							<option value="1" <?php echo ($status == 1) ? "selected":"";?>>Enable</option>
							<option value="" <?php echo ($status == 0) ? "selected":"";?>>Disable</option>
						  </select>
                      </div>
					  </div>

                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>
			<script>
			function form_submit(){
				$("#demo-form2").submit();
			}
	
			</script>
			
			<script type="text/javascript">
		$(document).ready(function(e) {
			getCity();
			
			$('#state_id').on('change', function(e) {
				e.preventDefault();
				getCity();
			});
		});
		
	function getCity(){
		$.ajax({
		url: '<?php echo base_url()?>admin/location/get_city_by_state',
		data:{'state_id':$('#state_id').val(),'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
		type: "POST",
		beforeSend: function() {
			$('#state_id').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			$('#city_id').append(json);
			<?php if($this->input->get('id')){ ?>
				$("#city_id").val(<?php echo $city_id;?>);
			<?php } ?>
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
	}
		
</script>