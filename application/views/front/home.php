<?php $this->load->view("front/common/header");?>

<header id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
        <div class="item active" data-parallax="scroll"  data-image-src="images/banner1.html">
            <div class="fill" style="background-image:url(images/banner1.jpg)"></div>

<div class="carousel-caption">
<div class="col-sm-5 white-box" style="padding-bottom: 30px;">
<div class="z_tabs">
<ul id="z_tabs">
<!-- <li class="active"><a data-toggle="tab" href="#menu2"><i class="fas fa-car"></i><span>Local cab</span></a></li>-->
<li class="active"><a data-toggle="tab" href="#home"><i class="fas fa-car-side"></i><span>Out Station</span></a></li>
<li><a data-toggle="tab" href="#menu1"><i class="fab fa-fort-awesome"></i><span>Sight Seeing</span></a></li>
</ul>
</div>

<div class="tab-content">

<!--
<div id="menu2" class="tab-pane fade in active">
  <?php //echo form_open("home/submit_local", array("id"=>"local_form")); ?>
  <div class="form-group col-sm-12" style="padding-top:15px;">
      <label class="form-label">From</label>
      <input type="text" id="taxi_from" name="_from" required class="form-control" placeholder="Tour City">
  </div>

  <div class="form-group col-sm-12">
      <label class="form-label">To</label>
      <input type="text" id="taxi_to" name="_to" required class="form-control" placeholder="Tour City">
  </div>

  <div class="col-xs-12">
    <button class="btn btn-primary btn-block" type="submit">Confirm</button>
  </div>
  <?php //echo form_close();?>
</div>
-->

<div id="home" class="tab-pane fade in active">

  <div class="col-xs-12">
  <ul class="nav outstation_link">
    <li class="active"><a data-toggle="tab" href="#one_way">One Way</a></li>
    <li><a data-toggle="tab" href="#round_trip">Round Trip</a></li>
  </ul>
</div>

<div class="clearfix"></div>

  <div class="tab-content">

    <div id="one_way" class="tab-pane fade in active">
      <?php echo form_open("home/submit_outstation", array("id"=>"one_form"));?>
      <div class="form-group col-sm-6">
          <label class="form-label">From</label>
          <input id="outstation_trip_from" type="text" list="outstation_from" name="_from" placeholder="Select or enter city" required class="form-control" required/>
            <datalist id="outstation_from">
              <?php foreach($locations->result() as $location){?>
              <option value="<?php echo $location->name;?>"><?php echo $location->name;?></option>
              <?php } ?>
            </datalist>
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">To</label>
          <input id="outstation_trip_to" type="text" list="outstation_to" name="_to" placeholder="Select or enter city" required class="form-control" required/>
            <datalist id="outstation_to">
              <?php foreach($locations->result() as $location){?>
              <option value="<?php echo $location->name;?>"><?php echo $location->name;?></option>
              <?php } ?>
            </datalist>
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">Departure Date</label>
          <input type="text" required class="form-control" autocomplete="off" name="departure_date" placeholder="Date & Time" id="datetimepicker1">
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">No. Of People</label>
          <input type="text" required class="form-control" name="passengers" id="one_passengers" placeholder="No. of People" oninput="myFunction(this.value)">
      </div>
      <p id="msg" style="color:red;margin-bottom:10px;margin-left:150px;"></p>
      <input type="hidden" name="type" id="one_type" value="1" />
      <input type="hidden" name="pool_type" id="one_pool_type" value="" /><!-- Shared / Reserved ---->
      <div class="clearfix"></div>
      <div class="col-xs-6">
      <button class="btn btn-primary btn-block one_btn" name="Reserved" type="submit">Reserve Now</button>
      </div>
      <div class="col-xs-6">
      <button class="btn btn-primary btn-block one_btn" name="Shared" type="submit">Share Now</button>
    </div>
    <?php echo form_close();?>
    </div>


    <div id="round_trip" class="tab-pane fade">
      <?php echo form_open("home/submit_outstation", array("id"=>"round_form"));?>
      <div class="form-group col-sm-6">
          <label class="form-label">From</label>
          <select class="form-control" name="_from" id="round_from" onchange="disable_option('round_from', 'round_to')" required >
            <option value="">Select Tour City</option>
            <?php foreach($locations->result() as $location){?>
            <option value="<?php echo $location->name;?>"><?php echo $location->name;?></option>
          <?php } ?>
          </select>
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">To</label>
          <select class="form-control" name="_to" id="round_to" required >
            <option value="">Select Tour City</option>
            <?php foreach($locations->result() as $location){?>
            <option value="<?php echo $location->name;?>"><?php echo $location->name;?></option>
          <?php } ?>
          </select>
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">Departure Date</label>
          <input type="text" class="form-control" required  autocomplete="off" placeholder="Date & Time" name="departure_date" id="datetimepicker2">
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">Return Date</label>
          <input type="text" class="form-control" required  autocomplete="off" placeholder="Date & Time" name="return_date"  id="datetimepicker3">
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">No. Of People</label>
          <input type="text" class="form-control" required name="passengers" id="round_passengers" placeholder="No. of People">
      </div>
      <input type="hidden" name="type" id="round_type" value="2" />
      <input type="hidden" name="pool_type" id="round_pool_type" value="" />
      <div class="clearfix"></div>
      <div class="col-xs-6">
      <button class="btn btn-primary btn-block roundbtn" name="Reserved" type="submit">Reserve Now</button>
      </div>
      <div class="col-xs-6">
      <button class="btn btn-primary btn-block roundbtn" name="Shared" type="submit">Share Now</button>
    </div>
<?php echo form_close();?>
    </div>




</div>
</div>

<div id="menu1" class="tab-pane fade">
  <div class="form-group col-sm-12" style="padding-top:15px;">
      <label class="form-label">City</label>
      <select class="form-control" id="city_sight" required >
        <option value="">Select Tour City</option>
        <?php foreach($site_locations->result() as $slocation){?>
        <option value="<?php echo $slocation->name;?>"><?php echo $slocation->name;?></option>
      <?php } ?>
      </select>
  </div>

  <div class="col-xs-12">
    <button class="btn btn-primary btn-block" id="sight_seeing">Search</button>
  </div>
</div>

</div>
</div>

<div class="col-sm-6 col-sm-offset-1 mobile-off">
<h1>Any Assistance while <br/>booking?</h1>
<h1 class="theme_h1">Call 81708 23370</h1>
<h1>OR</h1>
<a href="contact-us" class="btn btn-primary btn-block">Enquire Now</a>
</div>


                              </div>

        </div>


          </div>

    <!-- Controls -->

</header>


    <div class="parallax-window1 text-center" id="what">
      <div class="innercontent">
        <div class="container">
      <h1 class="bluetext h1marign">Who We Are </h1>
<p class="title-desc pmargin"><br/>Your Satisfaction is Our Service</p>
<p>In this era of technology where the whole world is just a click away from your hand. As internet has become prime service for many purposes. Now online taxi booking is most convenient and easy process for our daily life. Online booking taxi is completely secure with us and saves your time at affordable price .we provide you easy booking ,renting or hiring cabs in a few steps only. <a href="about-us">See more</a><br/><br/>&nbsp;</p>
      </div>
    </div>

    </div>

<div class="clearfix"></div>
  <div class="">
    <a href="https://play.google.com/store/apps/details?id=com.zcabs" target="_blank"><img src="images/androidbanner.jpg" style="width:100%" /></a>
  </div>


  <!-- Confirm Modal -->
<div id="confirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Book your ride</h4>
      </div>
      <div class="modal-body">
    <h4>Confirm your trip</h4>
      <?php echo form_open('razorpay/ch');?>
        <input type="hidden" id="odr" name="order_id" />
        <input type="hidden" id="amnt" name="amount" />
        <input type="submit" class="btn btn-primary" value="Pay">
      <?php echo form_close();?>
    </div>

    </div>

  </div>
</div>


  <!-- Price Modal -->
<div id="priceModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Book your ride</h4>
      </div>
      <div class="modal-body">
      <div id="price_ajax" style="overflow:hidden;"></div>
    </div>

    </div>

  </div>
</div>

  <!-- Price Reserved Modal -->
<div id="priceReservedModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Book your ride</h4>
      </div>
      <div class="modal-body">
      <div id="price_reserved_ajax" style="overflow:hidden;"></div>
    </div>

    </div>

  </div>
</div>

  <script>function ini() {
      var input = document.getElementById('taxi_from');
      var drop = document.getElementById('taxi_to');
      var autocomplete = new google.maps.places.Autocomplete(input);
      var autocomplete = new google.maps.places.Autocomplete(drop);
    }
    google.maps.event.addDomListener(window, 'load', ini);
  </script>


<?php $this->load->view("front/common/footer");?>
<script>
$(document).ready(function(e) {

  var roundpressed;
  $('.roundbtn').click(function() {
      roundpressed = $(this).attr('name');
      $("#round_pool_type").val(roundpressed);
  });

  var onepressed;
  $('.one_btn').click(function() {
      onepressed = $(this).attr('name');
      $("#one_pool_type").val(onepressed);
  });



    $('#round_form').on('submit', (function(e) {
      e.preventDefault();
      var that = this;
      $.ajax({
          url: '<?php echo base_url();?>account/isLogged',
          type: "GET",
          success:
          function(data){
            if(data == '1'){
            $.ajax({
            url: '<?php echo base_url();?>home/get_outstation_price',
            type: "POST",
            contentType: false,
            data:  new FormData(that),
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
                if(data == '2'){
                  location.href = '<?php echo base_url();?>contact-us?status=2';
                }
                else{
                  $("#price_reserved_ajax").html(data);
                  $("#priceReservedModal").modal('show');
                }
            },
            error: function(){}
            });
          }
          else{
            $("#flash_message").after('<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-info flash"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-info-circle facc" style="font-size:28px"></i>&nbsp;&nbsp;<strong>Info!</strong>&nbsp;&nbsp;Please Login To Register Your Seats.</div>');
            $("#loginModal").modal('show');
          }
      },
      error: function(){}
    });
  }));

  $('#one_form').on('submit', (function(e) {
    e.preventDefault();
    var that = this;
    $.ajax({
        url: '<?php echo base_url();?>account/isLogged',
        type: "GET",
        success:
        function(data){
          if(data == '1'){
      $.ajax({
        url: '<?php echo base_url();?>home/get_outstation_price',
        type: "POST",
        contentType: false,
        data:  new FormData(that),
        cache: false,
        processData:false,
        beforeSend: function(){
          $('#ajax-loader').removeClass('loaderhide');
        },
        complete: function() {
          $('#ajax-loader').addClass('loaderhide');
        },
        success:
        function(data){
            /* var result = JSON.parse(data); */
            if(data == '2'){
              location.href = '<?php echo base_url();?>contact-us?status=2';
            }
      else{
        $("#price_ajax").html(data);
        $("#priceModal").modal('show');
      }
        },
        error: function(){}
      });
    }
    else{
      $("#flash_message").after('<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-info flash"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-info-circle facc" style="font-size:28px"></i>&nbsp;&nbsp;<strong>Info!</strong>&nbsp;&nbsp;Please Login To Register Your Seats.</div>');
      $("#loginModal").modal('show');
    }
},
error: function(){}
});
}));

$('#sight_seeing').on('click', (function(e) {
  e.preventDefault();
  $('#ajax-loader').removeClass('loaderhide');
  if($("#city_sight").val() != ""){
    location.href = '<?php echo base_url();?>sight/'+$("#city_sight").val();
  }
  else{
    $('#ajax-loader').addClass('loaderhide');
    $("#flash_message").after('<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-danger flash"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-exclamation-triangle facc" style="font-size:28px"></i>&nbsp;&nbsp;<strong>Error!</strong>&nbsp;&nbsp;No city selected. Please select a city.</div>');
  }
}));
});

function final_outstation_submit(){
  $.ajax({
        url: '<?php echo base_url();?>home/submit_outstation',
        type: "POST",
        data:  $('#one_form').serialize(),
        beforeSend: function() {
          $('#ajax-loader').removeClass('loaderhide');
        },
        complete: function() {
          $('#ajax-loader').addClass('loaderhide');
        },
        success:
        function(data){
            var result = JSON.parse(data);
            show_message(data);
            if(result['success'] == 2){
                  $("#login_extra").val(JSON.stringify(result['code_string']));
                  $("#register_extra").val(JSON.stringify(result['code_string']));
                  $("#loginModal").modal('show');
            }
        },
        error: function(){}
      });
}

function final_outstation_round_submit(){
  $.ajax({
        url: '<?php echo base_url();?>home/submit_outstation',
        type: "POST",
        data:  $('#round_form').serialize(),
        beforeSend: function() {
          $('#ajax-loader').removeClass('loaderhide');
        },
        complete: function() {
          $('#ajax-loader').addClass('loaderhide');
        },
        success:
        function(data){
            var result = JSON.parse(data);
            show_message(data);
            if(result['success'] == 2){
                  $("#login_extra").val(JSON.stringify(result['code_string']));
                  $("#register_extra").val(JSON.stringify(result['code_string']));
                  $("#loginModal").modal('show');
            }
        },
        error: function(){}
      });
}

function disable_option(t, f){
  $('#'+f+' option').prop('disabled', false);
  $("#"+f+" option[value='"+$("#"+t).val()+"']").prop("disabled", true);
}

function myFunction(val) {
  document.getElementById("msg").innerHTML = "";
    if(val>9)
    {
     val = "Can reserve for upto 9 people at a time";
     document.getElementById("one_passengers").value = '';
     document.getElementById("msg").innerHTML = val;
  }
}
</script>
