<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Drivers</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/driver"><i class="fa fa-reply"></i></a>			  <a class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="UPDATE username and password" href="<?php echo base_url();?>admin/user/update?id=<?php echo $id;?>">UPDATE Username / Password</a>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Driver </h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/driver/add_driver", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                          <input type="hidden" id="old_image" name="old_image" value="<?php echo $old_image;?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first_name" name="first_name" value="<?php echo $first_name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last_name" name="last_name" value="<?php echo $last_name;?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>





					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" value="<?php echo $email;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="mobile" name="mobile" value="<?php echo $mobile;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <?php if(!$id){?>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                    <?php } ?>

                    <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Driver Image  <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>


                    <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Type <span class="required">*</span>
                        </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="vehicle_type" name="vehicle_type"  class="form-control col-md-7 col-xs-12">
                                      <option value="Male" <?php echo ($vehicle_type == '1') ? "selected":""; ?>>Mini</option>
                                      <option value="Female" <?php echo ($vehicle_type == '2') ? "selected":""; ?>>SUV</option>
                                  </select>

                                </div>
                              </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Name <span class="required">*</span>
                                </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="vehicle_name" name="vehicle_name" value="<?php echo $vehicle_name;?>" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Number <span class="required">*</span>
                                </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="vehicle_number" name="vehicle_number" value="<?php echo $vehicle_number;?>" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Model <span class="required">*</span>
                                </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="vehicle_model" name="vehicle_model" value="<?php echo $vehicle_model;?>" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">dob
                                </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="dob" name="dob" value="<?php echo $dob;?>"  class="form-control col-md-7 col-xs-12">
                          </div>
                    </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">gender
                                </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="gender" name="gender"  class="form-control col-md-7 col-xs-12">
                              <option value="Male" <?php echo ($gender == 'Male') ? "selected":""; ?>>Male</option>
                              <option value="Female" <?php echo ($gender == 'Female') ? "selected":""; ?>>Female</option>
                          </select>
                          </div>
                    </div>



					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="address" name="address" value="<?php echo $address;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="city" name="city" value="<?php echo $city;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">State  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="state" name="state" value="<?php echo $state;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Zip Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="zip" name="zip" value="<?php echo $zip;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Country
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="country" name="country" value="India" readonly class="form-control col-md-7 col-xs-12">
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
					<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i> SUBMIT</button>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>
