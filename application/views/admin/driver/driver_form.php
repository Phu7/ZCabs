<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Drivers</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/driver"><i class="fa fa-reply"></i></a>
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
               
				<div class="form-group col-sm-6">
					<input type="text" placeholder="First Name" value="<?php echo $first_name;?>" class="form-control" required name="first_name" />
				</div>

				<div class="form-group col-sm-6">
					<input type="text" placeholder="Last Name" value="<?php echo $last_name;?>" class="form-control" required name="last_name" />
				</div>

					<input type="hidden" name="email" value="<?php echo $email;?>" />

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Mobile Number" value="<?php echo $mobile;?>" class="form-control" required name="mobile" />
				</div>


        <?php if($id == ""){?>
				<div class="form-group col-sm-4">
					<input type="password" placeholder="Password" class="form-control" required name="password" />
				</div>
        <?php } ?> 
        <div class="clearfix"></div>
				<div class="form-group col-sm-6">
					<label>Driver Image</label>
					<input type="file" class="form-control" placeholder="Driver Image" required name="image" />
          <input type="hidden" name="o_image" value="<?php echo $image;?>" />
				</div>

        <div class="form-group col-sm-6">
              <label>Vehicle Type</label>
                      <select name="vehicle_type"  class="form-control col-md-7 col-xs-12">
                          <option value="Mini" <?php echo $vehicle_type="Mini" ? 'selected':'';?>>Micro</option>
                          <option value="SUV" <?php echo $vehicle_type="SUV" ? 'selected':'';?>>Mini</option>
                          <option value="Hatchback" <?php echo $vehicle_type="Hatchback" ? 'selected':'';?>>SUV</option>
                          <option value="MUV" <?php echo $vehicle_type="MUV" ? 'selected':'';?>>MUV</option>
                          <option value="MUV" <?php echo $vehicle_type="MUV" ? 'selected':'';?>>Bike</option>
                      </select>
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="vehicle_name" value="<?php echo $vehicle_name;?>" placeholder="Vehicle Name" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="vehicle_number" value="<?php echo $vehicle_number;?>" placeholder="Vehicle Number" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="vehicle_model" value="<?php echo $vehicle_model;?>" placeholder="Vehicle Model" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" id="dob" placeholder="Date Of Birth" name="dob" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <select id="gender" name="gender"  class="form-control col-md-7 col-xs-12">
                  <option value="Male" <?php echo $gender="Male" ? 'selected':'';?>>Male</option>
                  <option value="Female"> <?php echo $gender="Female" ? 'selected':'';?>Female</option>
              </select>
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="address" value="<?php echo $address;?>" placeholder="Address" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="city" placeholder="City" value="<?php echo $city;?>" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="state" placeholder="State" value="<?php echo $state;?>" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="zip" placeholder="PinCode" value="<?php echo $zip;?>" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="country" value="India" readonly class="form-control col-md-7 col-xs-12">
        </div>
        <div class="clearfix"></div>
        <legend>Upload Documents</legend>
				<div class="form-group col-sm-6">
					<label>Driving License</label>
					<input type="file" class="form-control" required name="license" />
          <input type="hidden" name="o_license" value="<?php echo $license;?>" />
				</div>

				<div class="form-group col-sm-6">
					<label>Address Proof</label>
					<input type="file" class="form-control" required name="address_proof" />
          <input type="hidden" name="o_address_proof" value="<?php echo $address_proof;?>" />
				</div>

				<div class="form-group col-sm-6">
					<label>Vehicle RC Book</label>
					<input type="file" class="form-control" required name="vehicle_rc_book" />
          <input type="hidden" name="o_vehicle_rc_book" value="<?php echo $vehicle_rc_book;?>" />
				</div>

				<div class="form-group col-sm-6">
					<label>Insurance</label>
					<input type="file" class="form-control" required name="insurance" />
          <input type="hidden" name="o_insurance" value="<?php echo $insurance;?>" />
				</div>

        <div class="form-group col-sm-6">
					<label>Vehicle Pictures</label>
					<input type="file" class="form-control" required name="vehicle_picture" />
          <input type="hidden" name="o_vehicle_picture" value="<?php echo $vehicle_picture;?>" />
				</div>

				<div class="form-group col-sm-6">
					<label>Upload Bank Passbook/Cancel Cheque</label>
					<input type="file" class="form-control" required name="bank_proof" />
          <input type="hidden" name="o_bank_proof" value="<?php echo $bank_proof;?>" />
				</div>
<div class="clearfix"></div>
        <legend>Bank Details</legend>
        <div class="form-group col-sm-6">
              <input type="text" name="account_holder_name" value="<?php echo $account_holder_name;?>" placeholder="Account Holder Name" class="form-control col-md-7 col-xs-12">
        </div>
        <div class="form-group col-sm-6">
              <input type="text" name="bank_name" value="<?php echo $bank_name;?>" placeholder="Bank Name" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="bank_account" value="<?php echo $bank_account;?>" placeholder="Account Number" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="ifsc" value="<?php echo $ifsc;?>" placeholder="IFSC Code" class="form-control col-md-7 col-xs-12">
        </div>


				<div class="clearfix"></div>





				<div class="col-sm-3 col-sm-offset-9"><button type="submit" class="btn btn-primary btn-block">Submit Now</button></div>
				<?php echo form_close();?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>
