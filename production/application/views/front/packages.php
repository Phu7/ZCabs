<?php $this->load->view("front/common/header");?>

<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>

<!--div class="container">
<ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li class="active">Contact</li>
  </ol>
</div-->

<div class="container wrappad">
	<h1 class="h1marignten"> Sight Seen Packages</h1>
  <?php foreach($result->result() as $result){?>
  <div class="col-sm-4">
  <div class="pdiv">
  <a onclick="getDetail('<?php echo $result->id;?>')" >
    <img src="<?php echo $result->image;?>" class="img-responsive" /></a>
  <div class="pcontent">
  <div class="ptitle"><a onclick="getDetail('<?php echo $result->id;?>')" ><?php echo $result->name;?></a></div>
  <div class="psku"><a onclick="getDetail('<?php echo $result->id;?>')" >Lorem ipsum is dummy text. Lorem ipsum is dummy text. Lorem ipsum is dummy text. Lorem ipsum is dummy text. Lorem ipsum is dummy text. Lorem ipsum is dummy text. Lorem ipsum is dummy text. </a></div>
    <div class="pprice">
        <i class="fa fa-inr"></i>&nbsp;<?php echo $result->price;?>
    </div>
    <div class="pbtn">
      <button class="btn" onclick="getReserve('<?php echo $result->id;?>')" >Reserve Now</button>
    </div>
  </div>
  </div>
  </div>

<?php } ?>
</div>

<!-- detailModal -->
<div id="detailModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Package Details</h4>
      </div>
      <div class="modal-body" >
        <div id="ajax_response" style="display:inline-block;"></div>
    </div>

  </div>
</div>
</div>

<!-- reserveModal -->
<div id="reserveModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reserve your seats</h4>
      </div>
      <div class="modal-body" >
        <div id="ajax_response_reserve" style="display:inline-block;"></div>
    </div>

  </div>
</div>
</div>

<?php $this->load->view("front/common/footer");?>

<script>


function getDetail(u){
    $.ajax({
      url: '<?php echo base_url();?>home/package_detail',
      type: "POST",
      data:  {"id":u},
      beforeSend: function() {
        $('#ajax-loader').removeClass('loaderhide');
      },
      complete: function() {
        $('#ajax-loader').addClass('loaderhide');
      },
      success:
      function(data){
        $("#ajax_response").html(data);
        $("#detailModal").modal('show');
      },
      error: function(){}
    });
}

function getReserve(u){
	<?php if($this->customer->isLogged()){?>
    $.ajax({
      url: '<?php echo base_url();?>home/package_detail_reserve',
      type: "POST",
      data:  {"id":u},
      beforeSend: function() {
        $('#ajax-loader').removeClass('loaderhide');
      },
      complete: function() {
        $('#ajax-loader').addClass('loaderhide');
      },
      success:
      function(data){
        $("#ajax_response_reserve").html(data);
        $("#reserveModal").modal('show');
      },
      error: function(){}
    });
		<?php } else{ ?>
			$("#flash_message").after('<div style="position:fixed; top:0px; left:0px; z-index:10000000; width:100%;" class="alert alert-info flash"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-info-circle facc" style="font-size:28px"></i>&nbsp;&nbsp;<strong>Info!</strong>&nbsp;&nbsp;Please Login To Register Your Seats.</div>');
			$("#loginModal").modal('show');
			<?php } ?>
}
</script>
