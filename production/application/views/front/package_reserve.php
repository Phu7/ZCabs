
<div class="col-sm-6">
  <img src="<?php echo $result['image'];?>" class="img-responsive"/><br/><br/>
  <p><?php echo $result['description']; ?></p>
</div>
<div class="col-sm-6">
  <legend><?php echo $result['name'];?></legend>
<?php echo form_open("home/submit_sight",array("id"=>"reserve_sight_form"));?>
<input type="hidden" name="sight_id" value="<?php echo $result['id'];?>">
<div class="form-group">
  <input type="text" class="form-control" placeholder="Date" name="departure_date" id="datetimepicker4"/>
</div>

Number of Seats:&nbsp;&nbsp;<input type="number" name="passengers" id="quantity" value="1" min='1' max="100" style="width:50px!important;"/>
<br/>
<h3 id="quantity_price"><i class="fa fa-inr facc"></i> <?php echo $result['price']; ?> / Seat</h3>
<br/><br/>

<button type="submit" class="btn btn-primary">Reserve Now</button>
<?php echo form_close();?>
</div>
<script type="text/javascript">
$(document).ready(function(e) {
$('#reserve_sight_form').on('submit', (function(e) {
	e.preventDefault();
		$.ajax({
			url: '<?php echo base_url();?>home/submit_sight',
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
        $("#reserveModal").modal('hide');
					show_message(data);
			},
			error: function(){}
		});
}));
});

                  $('#datetimepicker4').datetimepicker({
                    format: 'MM/DD/YYYY'
                  });
  </script>
