<?php $this->load->view("home/common/header_account");?>
<div class="wrappad">

      <div class="container webcontent wrappad">


	  <div class="login_back col-sm-4 col-sm-offset-4">
		<div id="ajax_response"></div>
		<h2>Verify OTP</h2>
      <?php echo form_open("account/verify_otp" ,array("role"=>"form", "style"=>"display: block;", 'id'=>'forget_form')); ?>
          <div class="form-group wrappad">
              <input type="text" name="otp" id="otp" tabindex="1" class="form-control" placeholder="Your OTP" value="">
					</div>


          <div class="form-group">
              <div class="col-sm-6">
                <input type="submit" name="submit" id="submit" tabindex="4" class="btn btn-primary btn-block" value="Submit">
							</div>
              <div class="col-sm-6">
                <a class="btn" href="account/resend_otp">Resend OTP</a>
							</div>
          </div>


			  <br/><br/>&nbsp;
          </div>
		  </div>

      <?php echo form_close(); ?>
</div>





    </div>






  <?php $this->load->view("home/common/footer_account");?>

  <script type="text/javascript" >
$(document).ready(function(e) {
$('#forget_form').on('submit',function(e) {
  e.preventDefault();
  var email=$("#username").val();
  $.ajax({
    url: '<?php echo base_url() ?>account/check_user',
    type: "POST",
    data:{email:email},
    complete: function() {
      $('.fa-spin').remove();
    },
    success: function(data){
	 $("#ajax_response").html('<div style="margin-bottom:10px;line-height:30px;padding:10px;border:1px solid #555;">'+data+'</div>');
    },
  });
});
});
</script>
