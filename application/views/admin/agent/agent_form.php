<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Drivers</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/agent"><i class="fa fa-reply"></i></a>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Agent </h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/agent/add_agent", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
        
					<div class="form-group col-sm-4">
					<input type="text" placeholder="First Name" class="form-control" required value="<?php echo $first_name; ?>" name="first_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Last Name" class="form-control" required value="<?php echo $last_name; ?>" name="last_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Father's Name" class="form-control" required value="<?php echo $father_name; ?>" name="father_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="email" placeholder="Email Address" class="form-control" value="<?php echo $email; ?>" name="email" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Mobile Number" class="form-control" required value="<?php echo $mobile; ?>" name="mobile" />
				</div>

				<div class="form-group col-sm-6">
					<textarea placeholder="Residential Address" class="form-control" name="residential_address" style="height:100px"><?php echo $residential_address; ?></textarea>
				</div>

				<div class="form-group col-sm-6">
					<textarea placeholder="Office Address" class="form-control" name="office_address" style="height:100px"><?php echo $office_address; ?></textarea>
				</div>
				
				<div class="clearfix"></div>
				
				<legend>Upload Documents</legend>
				<div class="form-group col-sm-6">
					<label>Photo</label>
					<input type="file" class="form-control" name="photo" />
					<input type="hidden" id="o_photo" name="o_photo" value="<?php echo $photo;?>">
				</div>

				<div class="form-group col-sm-6">
					<label>ID Proof</label>
					<input type="file" class="form-control" name="id_proof" />
					<input type="hidden" id="o_id_proof" name="o_id_proof" value="<?php echo $id_proof;?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Address Proof</label>
					<input type="file" class="form-control" name="address_proof" />
					<input type="hidden" id="o_address_proof" name="o_address_proof" value="<?php echo $address_proof;?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Office Front Photo</label>
					<input type="file" class="form-control" name="office_front_photo" />
					<input type="hidden" id="o_office_front_photo" name="o_office_front_photo" value="<?php echo $office_front_photo;?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Office Inside Photo</label>
					<input type="file" class="form-control" name="office_inside_photo" />
					<input type="hidden" id="o_office_inside_photo" name="o_office_inside_photo" value="<?php echo $office_inside_photo;?>">
				</div>

				<div class="form-group col-sm-6">
					<label>Upload Bank Passbook/Cancel Cheque</label>
					<input type="file" class="form-control" name="bank_proof" />
					<input type="hidden" id="o_bank_proof" name="o_bank_proof" value="<?php echo $bank_proof;?>">
				</div>

        <div class="clearfix"></div>
        <legend>Bank Details</legend>
        <div class="form-group col-sm-6">
              <input type="text" name="account_holder_name" value="<?php echo $account_holder_name; ?>" placeholder="Account Holder Name" class="form-control col-md-7 col-xs-12">
        </div>
        <div class="form-group col-sm-6">
              <input type="text" name="bank_name" value="<?php echo $bank_name; ?>" placeholder="Bank Name" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="bank_account" value="<?php echo $bank_account; ?>" placeholder="Account Number" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="ifsc" placeholder="IFSC Code" value="<?php echo $ifsc; ?>" class="form-control col-md-7 col-xs-12">
        </div>




				<div class="col-sm-3 col-sm-offset-9"><button type="submit" class="btn btn-primary btn-block">Submit Now</button></div>
				<?php echo form_close();?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>
