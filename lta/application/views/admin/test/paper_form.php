<?php $this->load->view('admin/common/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Papers</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/test/paper"><i class="fa fa-reply"></i></a>
				<button type="submit" form="demo-form2" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Paper</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="post" action="<?php echo base_url()?>admin/test/paper/add" class="form-horizontal form-label-left">

                          <input type="hidden" id="id" name="id" required="required" value="<?php echo $id;?>" class="form-control col-md-7 col-xs-12">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Paper Name <span class="required">*</span>
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
						  <?php if($combos->num_rows()){
							  foreach($combos->result() as $combo){?>
						  <option value="<?php echo $combo->id;?>" <?php echo ($combo->id == $combo_id) ? "selected":"";?>><?php echo $combo->name;?></option>
						  <?php }} ?>
						  </select>
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Duration <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="duration" name="duration" value="<?php echo $duration;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marks <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="marks" name="marks" value="<?php echo $marks;?>" required="required" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Start Day <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control col-md-7 col-xs-12" readonly="readonly" value="<?php echo $start_date;?>"  id="start_date" name="start_date" required="required"/>
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">End Day <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                        <div class='input-group date' id='myDatepicker3'>
                            <input type='text' class="form-control col-md-7 col-xs-12" readonly="readonly" value="<?php echo $end_date;?>" id="end_date" name="end_date" required="required"/>
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
	                    </div>
                      </div>

                      <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                          <option value="0" <?php echo $status == 0 ? 'selected':'';?>>Disable</option>
                                          <option value="1" <?php echo $status == 1 ? 'selected':'';?>>Enable</option>
                                        </select>
                                    </div>
          	                    </div>
                                </div>



                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/common/footer');?>
		<script>
		$('#myDatepicker3').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
		minDate:new Date()
    });

	$('#myDatepicker2').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
		minDate:new Date()
    });
	</script>
