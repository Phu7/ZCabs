<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Outstation Vehicle Rate</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/out_est"><i class="fa fa-reply"></i></a>
				<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Outstation Vehicle Rate</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/out_est/add_out_est", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                          <input type="hidden" id="o_img" name="o_img" value="<?php echo $o_img;?>">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

							<select id="from" name="from" required="required" class="form-control col-md-7 col-xs-12">
								<option value="">Select a Location</option>
								<?php foreach($locations->result() as $location){?>
								<option value="<?php echo $location->name;?>" <?php echo ($from == $location->name) ? 'selected':'';?>><?php echo $location->name;?></option>
								<?php } ?>
							</select>

						</div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="to" name="to" required="required" class="form-control col-md-7 col-xs-12">
								<option value="">Select a Location</option>
								<?php foreach($locations->result() as $location1){?>
								<option value="<?php echo $location1->name;?>" <?php echo ($to == $location1->name) ? 'selected':'';?>><?php echo $location1->name;?></option>
								<?php } ?>
							</select>
                        </div>
                      </div>




					  <!--div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pickup Point <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="pickup_point" name="pickup_point" value="" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div-->



					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="vehicle_name" value="<?php echo $name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <!--div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Drop Point <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="drop_point" name="drop_point" value="" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div-->

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Available Seats <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="seats" name="seats" value="<?php echo $seats;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amenities <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="amenities" name="amenities" value="<?php echo $amenities;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fare <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="fare" name="fare" value="<?php echo $fare;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Departure Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="departure_date" name="departure_date[]" value="<?php echo ($departure_date1) ? date("m/d/Y h:i A", strtotime($departure_date1)):'';?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
			          </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Departure Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="departure_date" name="departure_date[]" value="<?php echo ($departure_date2) ? date("m/d/Y h:i A", strtotime($departure_date2)):'';?>" class="form-control col-md-7 col-xs-12">
                        </div>
			          </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Departure Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="departure_date" name="departure_date[]" value="<?php echo ($departure_date3) ? date("m/d/Y h:i A", strtotime($departure_date3)):'';?>"  class="form-control col-md-7 col-xs-12">
                        </div>
			          </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Departure Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="departure_date" name="departure_date[]" value="<?php echo ($departure_date4) ? date("m/d/Y h:i A", strtotime($departure_date4)):'';?>" class="form-control col-md-7 col-xs-12">
                        </div>
			          </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Departure Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="departure_date" name="departure_date[]" value="<?php echo ($departure_date5) ? date("m/d/Y h:i A", strtotime($departure_date5)):'';?>" class="form-control col-md-7 col-xs-12">
                        </div>
			          </div>




					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                        </div>

						<div class="col-md-3 col-sm-3 col-xs-12">
                          <?php echo ($this->input->get('id') != '') ? '<img src="'.base_url().$o_img.'" width="100px"/>':''; ?>
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="status" name="status" class="form-control col-md-7 col-xs-12">
							<option value="1" <?php echo ($status == '1') ? "selected":"";?>>Enable</option>
							<option value="0" <?php echo ($status == '0') ? "selected":"";?>>Disable</option>
						  </select>
                      </div>
					  </div>

                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>
	<script type="text/javascript">
		$('.departure_date').datetimepicker({
              minDate: moment(),
              sideBySide: true
        });
	</script>
