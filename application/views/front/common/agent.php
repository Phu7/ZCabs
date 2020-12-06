<?php $this->load->view("front/common/header");?>

            <div>
				          <img src="images/smbanner.jpg" width="100%" />
			      </div>

      <div class="container wrappad">
      	<h1 class="h1marignten">Agent Register</h1>
            <?php echo form_open("account/agent_register", array("id"=>"agent_register_form1", "enctype" => "multipart/form-data"));?>
				<div class="form-group col-sm-4">
					<input type="text" placeholder="First Name" class="form-control" required name="first_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Last Name" class="form-control" required name="last_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Father's Name" class="form-control" required name="father_name" />
				</div>

				<div class="form-group col-sm-4">
					<input type="email" placeholder="Email Address" class="form-control" name="email" />
				</div>

				<div class="form-group col-sm-4">
					<input type="text" placeholder="Mobile Number" class="form-control" required name="mobile" />
				</div>

				<div class="form-group col-sm-4">
					<input type="password" placeholder="Password" class="form-control" required name="password" />
				</div>

				<div class="form-group col-sm-6">
					<textarea placeholder="Residential Address" class="form-control" name="residential_address" style="height:100px"></textarea>
				</div>

				<div class="form-group col-sm-6">
					<textarea placeholder="Office Address" class="form-control" name="office_address" style="height:100px"></textarea>
				</div>

				<legend>Upload Documents</legend>
				<div class="form-group col-sm-6">
					<label>Photo</label>
					<input type="file" class="form-control" required name="photo" />
				</div>

				<div class="form-group col-sm-6">
					<label>ID Proof</label>
					<input type="file" class="form-control" required name="id_proof" />
				</div>

				<div class="form-group col-sm-6">
					<label>Address Proof</label>
					<input type="file" class="form-control" required name="address_proof" />
				</div>

				<div class="form-group col-sm-6">
					<label>Office Front Photo</label>
					<input type="file" class="form-control" required name="office_front_photo" />
				</div>

				<div class="form-group col-sm-6">
					<label>Office Inside Photo</label>
					<input type="file" class="form-control" required name="office_inside_photo" />
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

      $('#agent_register_form1').on('submit', (function(e) {
          e.preventDefault();
            $.ajax({
              url: 'https://www.zcabs.in/account/agent_register',
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
                  $("#registerAgentModal").modal('hide');
                  $("#otpModal").modal('show');
                  $("#agent_register_form")[0].reset();
                  }
              },
              error: function(){}
            });
      }));
    });
    </script>
