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

if ($(window).width() >1024) {
$('ul.nav li.dropdowns').hover(function() {
$(this).find('.dropdown-menus').stop(true, true).delay(200).fadeIn(500);
}, function() {
$(this).find('.dropdown-menus').stop(true, true).delay(200).fadeOut(500);
});
}

$('#datetimepicker1').datetimepicker({
  sideBySide: true
});
$('#datetimepicker2').datetimepicker({
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
              $("#loginModal").modal('hide');
              show_message(data);
              var result = JSON.parse(data);
              if(result['success'] == '1'){
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
          $("#registerModal").modal('hide');
            show_message(data);
            var result = JSON.parse(data);
            if(result['success'] == '1'){
            setafterlogin();
            }
        },
        error: function(){}
      });
}));
});

function setafterlogin(){
  $("#ajax_login").html('<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a><ul class="dropdown-menu"><li> <a href="#"><span>Profile</span></a> </li><li> <a href="#"><span>Previous trips</span></a></li><li> <a href="account/logout"><span>Logout</span></a></li></ul>');
}
