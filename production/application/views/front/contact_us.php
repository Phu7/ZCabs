<?php $this->load->view("front/common/header");?>
<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>



<div class="container webcontent collectiondiv wrappad">

<div class="col-sm-6 contactform">
	 	<?php echo form_open("home/submit_contact_us", array("id"=>"contact_form")); ?>
		<div class="contacthading">Contact Us</div>
		<div class="goodtosee">Good to see you using this form, please feel free to contact with Us. We will reply back Shortly (within 24 hours)</div>
<p><strong>*</strong> fields are mandatory</p>
		<div class="form-group">
			<input  type="text" name="name" id="name" class="form-control" placeholder="Name*" value="" required="required">
		</div>
		<div class="form-group">
			<input type="email" name="email" id="email" class="form-control" placeholder="Email*" value="" required="required">
		</div>
		<div class="form-group">
			<input  type="text" name="mobile" id="mobile" class="form-control" placeholder="Contact Number*" value="" required="required">
		</div>
    <div class="form-group">
			<input  type="text" name="subject" id="subject" class="form-control" placeholder="Subject*" value="" required="required">
		</div>
		<div class="form-group">
			<textarea cols="" rows="" name="message" id="message" placeholder="Message *" required="required" class="form-control"></textarea>
		</div>
		<div class="form-group"><button type="submit" class="btn btn-default">Submit</button></div>
	<?php echo form_close(); ?>
</div>







<div class="col-sm-6">

<div class="contacthading">Contact Details</div>

<div class="goodtosee"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14182.639633047946!2d88.24564211640856!3d27.292528595148077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e6843b9f8f2cd9%3A0xcf51301119e6d5d4!2sGeyzing%2C+Sikkim+737111!5e0!3m2!1sen!2sin!4v1534589933517" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe></div>

<div class="goodtosee" style="padding:10px 0px 20px 0px;">
<img src="images/office-icon.jpg">
ZCABS ONLINE PVT LTD, Pandey Colony, Gyalshing, West Sikkim,- 737111
<br/>&nbsp;
</div>



<div class="goodtosee" style="padding:10px 0px 20px 0px;">
<img src="images/phone-icon.jpg">+91-8170823370<br/>&nbsp;</div>

<div class="goodtosee" style="padding:10px 0px 20px 0px;">
<img src="images/email-icon.jpg"> zcabsonline@gmail.com
<br/>&nbsp;
</div>

</div>

</div>

<?php $this->load->view("front/common/footer");?>
<script>
$(document).ready(function(e) {
	$('#contact_form').on('submit', (function(e) {
      e.preventDefault();
        $.ajax({
          url: '<?php echo base_url();?>home/submit_contact_us',
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
              $("#contact_form")[0].reset();
							show_message(data);

          },
          error: function(){}
        });
  }));
});
</script>
