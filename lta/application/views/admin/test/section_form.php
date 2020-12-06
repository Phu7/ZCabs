<?php $this->load->view('admin/common/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Sections</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/test/section"><i class="fa fa-reply"></i></a>
				<button type="submit" form="demo-form2" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Section</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="post" action="<?php echo base_url()?>admin/test/section/add" class="form-horizontal form-label-left">

                          <input type="hidden" id="id" name="id" required="required" value="<?php echo $id;?>" class="form-control col-md-7 col-xs-12">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Section Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php echo $name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Combo Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="combo_id" name="combo_id" class="form-control col-md-7 col-xs-12">
						  <option value="">--Choose Combo--</option>
						  <?php if($combo->num_rows()){
							  foreach($combo->result() as $combo){?>
						  <option value="<?php echo $combo->id;?>" <?php echo ($combo->id == $combo_id) ? "selected":"";?>><?php echo $combo->name;?></option>
						  <?php }} ?>
						  </select>
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Paper Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="paper_id" name="paper_id" class="form-control col-md-7 col-xs-12">
						  </select>
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Right Mark <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="right_mark" name="right_mark" value="<?php echo $right_mark;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Wrong Mark <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type='text' value="<?php echo $wrong_mark;?>" class="form-control col-md-7 col-xs-12" id="wrong_mark" name="wrong_mark" required="required"/>
                        </div>
                      </div>


                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/common/footer');?>

		<script>
$(document).ready(function(e) {
	getPaper();
  $('#combo_id').on('change', function(e) {
	getPaper();
});
});



function getPaper(){
	$.ajax({
		url: '<?php echo base_url()?>admin/test/section/getPaperBySubject',
		data:{'id':$('#subject_id').val(),'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
		type: "POST",
		beforeSend: function() {
			$('#combo_id').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			html = json;
			$('#paper_id').html(html);
			<?php if($paper_id){ ?>
				$("#paper_id").val(<?php echo $paper_id;?>);
			<?php } ?>
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}
		</script>
