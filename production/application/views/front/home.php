<?php $this->load->view("front/common/header");?>

<header id="myCarousel" class="carousel slide">
    <div class="carousel-inner">



        <div class="item active" data-parallax="scroll"  data-image-src="images/banner1.html">
            <div class="fill" style="background-image:url(images/banner1.jpg)"></div>

<div class="carousel-caption">
<div class="col-sm-5 white-box">
<div class="z_tabs">
<ul id="z_tabs">
<li class="active"><a data-toggle="tab" href="#menu2"><i class="fa fa-taxi facc"></i><span>Local cab</span></a></li>
<li><a data-toggle="tab" href="#home"><i class="fa fa-map-o facc"></i><span>OutStation</span></a></li>
<li><a data-toggle="tab" href="#menu1"><i class="fa fa-map-marker facc"></i><span>Sight Seeing</span></a></li>
</ul>
</div>

<div class="tab-content">

<div id="menu2" class="tab-pane fade in active">
  <?php echo form_open("home/submit_local", array("id"=>"local_form"));?>
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
  <?php echo form_close();?>
</div>

<div id="home" class="tab-pane fade">




  <div class="col-xs-12">
  <ul class="nav outstation_link">
    <li class="active"><a data-toggle="tab" href="#one_way">One Way</a></li>
    <li><a data-toggle="tab" href="#round_trip">Round Trip</a></li>
  </ul>
</div>

  <div class="tab-content">


    <div id="one_way" class="tab-pane fade in active">
      <?php echo form_open("home/submit_outstation", array("id"=>"one_form"));?>
      <div class="form-group col-sm-6">
          <label class="form-label">From</label>
          <select class="form-control" name="_from" id="one_from" required>
            <option value="">Select Tour City</option>
            <?php foreach($locations->result() as $location){?>
            <option value="<?php echo $location->name;?>"><?php echo $location->name;?></option>
          <?php } ?>
          </select>
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">To</label>
          <select class="form-control" name="_to" id="one_to" required>
            <option value="">Select Tour City</option>
            <?php foreach($locations->result() as $location){?>
            <option value="<?php echo $location->name;?>"><?php echo $location->name;?></option>
          <?php } ?>
          </select>
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">Departure Date</label>
          <input type="text" required class="form-control" name="departure_date" placeholder="Date & Time" id="datetimepicker1">
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">No. Of People</label>
          <input type="text" required class="form-control" name="passengers" id="one_passengers" placeholder="No. of People">
      </div>
      <input type="hidden" name="type" id="one_type" value="1" />
      <input type="hidden" name="pool_type" id="one_pool_type" value="" />
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
          <select class="form-control" name="_from" id="round_from" required >
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
          <input type="text" class="form-control" required placeholder="Date & Time" name="departure_date" id="datetimepicker2">
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">Return Date</label>
          <input type="text" class="form-control" required placeholder="Date & Time" name="return_date"  id="datetimepicker3">
      </div>

      <div class="form-group col-sm-6">
          <label class="form-label">No. Of People</label>
          <input type="text" class="form-control" required name="passengers" id="round_passengers" placeholder="No. of People">
      </div>
      <input type="hidden" name="type" id="round_type" value="1" />
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
        <?php foreach($locations->result() as $location){?>
        <option value="<?php echo $location->name;?>"><?php echo $location->name;?></option>
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
<h1 class="theme_h1">Call 9898989898</h1>
<h1>OR</h1>
<a class="btn btn-primary btn-block btn-swap">Enquiry Now</a>
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
<p class="title-desc pmargin"><br/>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br/><br/>&nbsp;</p>
      </div>
    </div>

    </div>

<div class="clearfix"></div>
  <div class="">
    <img src="images/androidbanner.jpg" class="img-responsive"/>
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
        $.ajax({
          url: '<?php echo base_url();?>home/submit_outstation',
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
  }));

  $('#one_form').on('submit', (function(e) {
    e.preventDefault();
      $.ajax({
        url: '<?php echo base_url();?>home/submit_outstation',
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
}));

$('#local_form').on('submit', (function(e) {
  e.preventDefault();
    $.ajax({
      url: 'home/submit_local',
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

</script>
