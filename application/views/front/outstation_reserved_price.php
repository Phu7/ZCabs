<div class="col-sm-12">
<div class="col-sm-3"><span style="font-size:14px;color:#f5a129;">From: <?php echo $from;?></span></div>
<div class="col-sm-3"><span style="font-size:14px;color:#f5a129;">To: <?php echo $to;?></span></div>
<div class="col-sm-3"><span style="font-size:14px;color:#f5a129;">Date: <?php echo date("d/m/Y", strtotime($date));?></span></div>
<div class="col-sm-3"><button class="btn btn-alert btn-sm" class="close" data-dismiss="modal">Edit</button></div>
</div>
<div class="clearfix"></div>
<div style="margin-top:7px;margin-bottom:10px;height:3px;background:#f5a129;"></div>
<div class="table-responsive">
<table class="table table-bordered">
<thead>
<tr>
	<th>Vehicle</th>
	<th>Vehicle Name</th>
	<th>Amenities/Facilities</th>
	<th>Capacity</th>
	<th>Price</th>
	<th></th>
</tr>
</thead>
<?php foreach($result->result() as $result){?>
<tr>
	<td><img src="<?php echo $result->image;?>" class="img-responsive" width="70px" /></td>
	<td><?php echo $result->vehicle_name;?></td>
	<td><?php echo $result->amenities;?></td>
	<td><?php echo $result->seats;?> Persons</td>
	<td><?php echo $result->fare * $type;?></td>
	<td><a href="<?php echo base_url();?>home/add_final_outstation?id=<?php echo $result->id;?>&passengers=<?php echo $passengers;?>&dep_date=<?php echo $date;?>&return_date=<?php echo $return_date;?>&type=<?php echo $type;?>&pool_type=<?php echo $pool_type;?>" class="btn btn-success btn-sm" style="width: 100%;">Book Now</a></td>
</tr>
<?php } ?>

</tbody>
</table>
</div>