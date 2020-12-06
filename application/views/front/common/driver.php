<?php $this->load->view("front/common/header");?>

            <div>
				          <img src="images/smbanner.jpg" width="100%" />
			      </div>

      <div class="container wrappad">
      	<h1 class="h1marignten">Driver Register</h1>
            <?php echo form_open("account/driver_register", array("id"=>"driver_register_form", "enctype" => "multipart/form-data"));?>
				<div class="form-group col-sm-6">
					<input type="text" placeholder="First Name" class="form-control" required name="first_name" />
				</div>

				<div class="form-group col-sm-6">
					<input type="text" placeholder="Last Name" class="form-control" required name="last_name" />
				</div>

					<input type="hidden" name="email" />

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Mobile Number" class="form-control" required name="mobile" />
				</div>

				<div class="form-group col-sm-4">
					<input type="password" placeholder="Password" class="form-control" required name="password" />
				</div>

				<div class="form-group col-sm-6">
					<label>Driver Image</label>
					<input type="file" class="form-control" placeholder="Driver Image" required name="image" />
				</div>

        <div class="form-group col-sm-6">
              <label>Vehicle Type</label>
                      <select name="vehicle_type"  class="form-control col-md-7 col-xs-12">
                          <option value="Mini">Micro</option>
                          <option value="SUV">Mini</option>
                          <option value="Hatchback">SUV</option>
                          <option value="MUV">MUV</option>
                            <option value="MUV">Bike</option>
                      </select>
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="vehicle_name" placeholder="Vehicle Name" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="vehicle_number" placeholder="Vehicle Number" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="vehicle_model" placeholder="Vehicle Model" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" id="dob" placeholder="Date Of Birth" name="dob" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <select id="gender" name="gender"  class="form-control col-md-7 col-xs-12">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
              </select>
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="address" placeholder="Address" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="city" placeholder="City" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="state" placeholder="State" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="zip" placeholder="PinCode" required="required" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="country" value="India" readonly class="form-control col-md-7 col-xs-12">
        </div>
        <div class="clearfix"></div>
        <legend>Upload Documents</legend>
				<div class="form-group col-sm-6">
					<label>Driving License</label>
					<input type="file" class="form-control" required name="license" />
				</div>

				<div class="form-group col-sm-6">
					<label>Address Proof</label>
					<input type="file" class="form-control" required name="address_proof" />
				</div>

				<div class="form-group col-sm-6">
					<label>Vehicle RC Book</label>
					<input type="file" class="form-control" required name="vehicle_rc_book" />
				</div>

				<div class="form-group col-sm-6">
					<label>Insurance</label>
					<input type="file" class="form-control" required name="insurance" />
				</div>

        <div class="form-group col-sm-6">
					<label>Vehicle Pictures</label>
					<input type="file" class="form-control" required name="vehicle_picture" />
				</div>

				<div class="form-group col-sm-6">
					<label>Upload Bank Passbook/Cancel Cheque</label>
					<input type="file" class="form-control" required name="bank_proof" />
				</div>
<div class="clearfix"></div>
        <legend>Bank Details</legend>
        <div class="form-group col-sm-6">
              <input type="text" name="account_holder_name" placeholder="Account Holder Name" class="form-control col-md-7 col-xs-12">
        </div>
        <div class="form-group col-sm-6">
              <input type="text" name="bank_name" placeholder="Bank Name" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="bank_account" placeholder="Account Number" class="form-control col-md-7 col-xs-12">
        </div>

        <div class="form-group col-sm-6">
              <input type="text" name="ifsc" placeholder="IFSC Code" class="form-control col-md-7 col-xs-12">
        </div>


				<div class="clearfix"></div>





				<div class="col-sm-3 col-sm-offset-9"><button type="submit" class="btn btn-primary btn-block">CREATE NOW</button></div>
				<?php echo form_close();?>



        <br/><br/>&nbsp;
      </div>


      <?php $this->load->view("front/common/footer");?>

      <script>
       $(document).ready(function(e) {

      $('#driver_register_form').on('submit', (function(e) {
          e.preventDefault();
            $.ajax({
              url: 'https://www.zcabs.in/account/driver_register',
              type: "POST",
              contentType: false,
              data:  new FormData(this),
              cache: false,
              processData:false,
              beforeSend: function() {
                $('#ajax-loader').removeClass('loaderhide');
              },
              complete: function() {
                $('#ajax-loader').addClass('loaderhide');
              },
              success:
              function(data){
                  show_message(data);
                  var result = JSON.parse(data);
                  if(result['success'] == '1'){
                  $("#otpModal").modal('show');
                  $("#driver_register_form")[0].reset();
                  }
              },
              error: function(){}
            });
      }));
    });

    $('#dob').datetimepicker();
    </script>
