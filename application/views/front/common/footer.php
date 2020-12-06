<div class="clearfix"></div>

<!--footr-------->
<footer id="footer">
<div class="container">
     <div class="column col-sm-3">
  <h3 href="#demo1" data-toggle="collapse">About Us<i class="fa fa-sort-down"></i></h3>
  <ul id="demo1" class="collapse nopad">
    <li style="list-style:none;">Z cabs can be available for most of the part of Sikkim, Darjeeling,  kalimpong, siliguri and its neighbouring countries like Nepal and Bhutan.</li>
    </ul>
</div>



<div class="column col-sm-3">
  <h3 href="#demo2" data-toggle="collapse">Quick Links <i class="fa fa-sort-down"></i></h3>
  <ul id="demo2" class="collapse">
    <li><a href="sights">Site Seeing</a></li>
    <li><a href="about-us">About Us</a></li>
    <li><a href="contact-us">Contact Us</a></li>
   </ul>
</div>



<div class="column col-sm-3">
  <h3 href="#demo3" data-toggle="collapse">Other Links<i class="fa fa-sort-down"></i></h3>
  <ul id="demo3" class="collapse">
    <li><a href="privacy-policy">Privacy Policy</a></li>
    <li><a href="terms-and-condition">Terms & Condition</a></li>
    <li><a href="cacellation-policy">Cancellation Policy</a></li>
    <li><a href="#">Site Map</a></li>
   </ul>
</div>





<div class="column col-sm-3">
  <h3 href="#demo4" data-toggle="collapse">Contact Us</h3>
  <ul id="demo4" class="collapse">
    <li class="address">ZCABS ONLINE PVT LTD, Pandey Colony, Gyalshing, West Sikkim,- 737111</li>
    <li class="mobile">+91-8170823370</li>
    <li class="emails">zcabsonline@gmail.com</li>
  </ul>
</div>





</div>

</footer>

<div class="midfooter">
<div class="container">

<div class="" style="padding:0px;">

<div class="col-sm-6">
<div class="footer-newsletter">Newsletter</div>
<div class="subcribetext">Subscribe Our Newsletter to Keep Yourself Update !</div>
<div>

<div class="input-group" >
<input type="text" class="form-control" placeholder="Enter Your Email" name="email" id="email_news">
<div class="input-group-btn">
  <button class="btn subscribebut" type="submit" onclick="submit_newsletter()">SUBSCRIBE</button>
</div>
</div>

<script>
function submit_newsletter(){
$.ajax({
  url: 'account/submit_newsletter',
  type: "POST",
  data: {"email":$("#email_news").val()},
  beforeSend: function() {
    $('#ajax-loader').removeClass('loaderhide');
  },
  complete: function() {
    $('#ajax-loader').addClass('loaderhide');
  },
  success:
   function(data){
     show_message(data);
     $("#email_news").val('');
  },
  error: function(){}
  });
}

function show_message(data){
  var result = JSON.parse(data);
  if(result['success'] == '1'){
      $("#flash_message").after('<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-success flash"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-check facc" style="font-size:28px"></i>&nbsp;&nbsp;<strong>Success!</strong>&nbsp;&nbsp;'+result['message']+'</div>');
  }
  if(result['success'] == '0'){
      $("#flash_message").after('<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-danger flash"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-exclamation-triangle facc" style="font-size:28px"></i>&nbsp;&nbsp;<strong>Error!</strong>&nbsp;&nbsp;'+result['message']+'</div>');
  }
  if(result['success'] == '2'){
      $("#flash_message").after('<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-info flash"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-info-circle facc" style="font-size:28px"></i>&nbsp;&nbsp;<strong>Info!</strong>&nbsp;&nbsp;'+result['message']+'</div>');
  }
}
</script>


</div>
</div>

<div class="col-sm-3 col-sm-offset-3">
<div class="footer-newsletter">Follow us on</div>
<div class="footer-social-icons">
<ul class="social-icons">
<li><a href="#" target="_blank" class="social-icon"><i class="fa fa-instagram"></i></a></li>
<li><a href="https://www.facebook.com/ZCabs-2140722082868289" target="_blank" class="social-icon"><i class="fa fa-facebook"></i></a></li>
<li><a href="#" target="_blank" class="social-icon"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" target="_blank" class="social-icon"><i class="fa fa-youtube"></i></a></li>
<li><a href="#" target="_blank" class="social-icon"><i class="fa fa-linkedin"></i></a></li>
</ul>
</div>
</div>
</div>

</div>
</div>

<div class="footer">
©2018, <a href="#">ZCabs</a><br>
Website Designed & Developed By : <a href="https://www.harshikainfotech.com" target="_blank">Harshika Infotech</a>
</div>

</div>
</div>






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<script type="application/javascript" src="js/aos.js"></script>
<script>
AOS.init({
easing: 'ease-out-back',
duration: 1000
});
</script>
<script>
jQuery(window).scroll(function () {
if (jQuery(window).scrollTop() >= 10) {
jQuery('nav').addClass('fixed');
}
else {
 jQuery('nav').removeClass('fixed');
}
});
</script>

<script src="js/parallax.min.js"></script>
<script type="text/javascript">
if ($(window).width() >1024) {
$('ul.nav li.dropdowns').hover(function() {
$(this).find('.dropdown-menus').stop(true, true).delay(200).fadeIn(500);
}, function() {
$(this).find('.dropdown-menus').stop(true, true).delay(200).fadeOut(500);
});
}
</script>

<!--read more script-->
<script src="<?php echo base_url() ?>vendors/moment/min/moment.min.js"></script>
  <script src="<?php echo base_url() ?>vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

  <script type="text/javascript">


                  $('#datetimepicker1').datetimepicker({
					  minDate: moment(),
                    sideBySide: true
                  });
                  $('#datetimepicker2').datetimepicker({
					  minDate: moment(),
                    sideBySide: true
                  });
                  $('#datetimepicker3').datetimepicker({
                    sideBySide: true,
                    useCurrent: false
                  });
                  $("#datetimepicker2").on("dp.change", function (e) {
                  $('#datetimepicker3').data("DateTimePicker").minDate(e.date);
                  });
                  $("#datetimepicker3").on("dp.change", function (e) {
                      $('#datetimepicker2').data("DateTimePicker").maxDate(e.date);
                  });
                  $('#datetimepicker4').datetimepicker({
					  minDate: moment(),
                    format: 'MM/DD/YYYY'
                  });
  </script>

  <script>
  $(document).ready(function(e) {
      $('#login_form').on('submit', (function(e) {
        e.preventDefault();
          $.ajax({
            url: '<?php echo base_url();?>account/login',
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
                  $("#loginModal").modal('hide');
                  $("#login_form")[0].reset();
                  setafterlogin();
                }
            },
            error: function(){}
          });
    }));

    $('#register_form').on('submit', (function(e) {
      e.preventDefault();
        $.ajax({
          url: '<?php echo base_url();?>account/register',
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
              $("#registerModal").modal('hide');
              $("#otpModal").modal('show');
              $("#register_form")[0].reset();
              }
          },
          error: function(){}
        });
  }));

  $('#agent_register_form').on('submit', (function(e) {
    e.preventDefault();
      $.ajax({
        url: '<?php echo base_url();?>account/agent_register',
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

  $('#otp_form').on('submit', (function(e) {
        e.preventDefault();
          $.ajax({
            url: '<?php echo base_url();?>account/check_otp',
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
                  $("#otpModal").modal('hide');
                  $("#otp_form")[0].reset();
                  setafterlogin();
                }
            },
            error: function(){}
          });
    }));
  });

  function setafterlogin(){
	  $.ajax({
      url: '<?php echo base_url();?>account/isAgent',
      type: "GET",
      success:
      function(data){
		var html = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a><ul class="dropdown-menu"><li> <a href="account"><span>My Profile</span></a> </li><li> <a href="account/get_history"><span>My Bookings</span></a></li>';
		if(data == '3'){
		html += '<li> <a href="account/withdrawal"><span>Withdrawal Request</span> </a></li>';
		html += '<li> <a href="account/transaction_history"><span>Transaction History</span></a></li>';
		html += '<li> <a href="razorpay"><span>My Wallet (<i class="fa fa-inr bordernone"></i><?php echo $this->customer->getWallet();?>)</span></a></li>';
    html += '<li> <a href="utility-service"><span>Utility Service</span></a></li>';
    html += '<li> <a href="driver/register"><span>Add Driver/ Cab</span></a></li>';
		}
		html += '<li> <a href="account/logout"><span>Logout</span></a></li></ul>';
        $("#ajax_login").html(html);
      },
      error: function(){}
    });
  }
  </script>

</body>

</html>
