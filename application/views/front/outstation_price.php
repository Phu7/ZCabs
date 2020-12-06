<div class="col-sm-12">
<div class="col-sm-4"><span style="font-size:14px;color:#f5a129;">From: <?php echo $from;?></span>
<br/>
<br/> <select id="pickup_point"  class="form-control">
			<?php foreach($lo_from->result() as $lofrom){?>
			<option value="<?php echo $lofrom->name; ?>"><?php echo $lofrom->name; ?></option>
			<?php } ?>
		</select>
		</div>
<div class="col-sm-4"><span style="font-size:14px;color:#f5a129;">To: <?php echo $to;?></span>
<br/>
<br/> <select id="drop_point" class="form-control">
			<?php foreach($lo_to->result() as $loto){?>
			<option value="<?php echo $loto->name; ?>"><?php echo $loto->name; ?></option>
			<?php } ?>
		</select></div>
<div class="col-sm-2"><span style="font-size:14px;color:#f5a129;">Date: <?php echo date("d/m/Y", strtotime($date));?></span></div>
<div class="col-sm-2"><button class="btn btn-alert btn-sm" class="close" data-dismiss="modal">Edit</button></div>
</div>
<div class="clearfix"></div>
<div style="margin-top:7px;margin-bottom:10px;height:3px;background:#f5a129;"></div>
<div class="table-responsive">
<table class="table table-bordered table-responsive">
<thead>
<tr>
	<th>Vehicle</th>
	<th>Departure Time</th>
	<th>Available Seats</th>
	<th>Amenities</th>
	<th>Price</th>
	<th></th>
</tr>
</thead>
<tbody>

<?php foreach($result->result() as $result){?>
<tr>
	<td><img src="<?php echo $result->image;?>" class="img-responsive" width="70px"/><br/><?php echo $result->vehicle_name;?></td>
	<td><?php echo $result->departure_date;?></td>
	<td><?php echo $result->remaining_seats;?></td>
	<td><?php echo $result->amenities;?></td>
	<td><?php echo $result->fare * $type;?> / Seat</td>
	<td><a class="btn btn-success btn-sm" onclick="append_val('<?php echo $result->id;?>')" id="an<?php echo $result->id;?>" href="<?php echo base_url();?>home/add_final_outstation?id=<?php echo $result->id;?>&oedid=<?php echo $result->oedid;?>&passengers=<?php echo $passengers;?>&dep_date=<?php echo date("Y-m-d", strtotime($date))." ".$result->departure_date;?>&return_date=<?php echo $return_date;?>&type=<?php echo $type;?>&pool_type=<?php echo $pool_type;?>">Book Now</a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>

<script>
	function append_val(u){
		 var $this = $("#an"+u);
		 var _href = $this.attr("href");
		 $this.attr("href", _href + '&pickup='+$("#pickup_point").val()+'&drop='+$("#drop_point").val());
	}
</script>
