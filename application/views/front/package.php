

  <?php foreach($result['images'] as $imagee){?>
  <div class="col-sm-3">
  <div class="pdiv">
  <div class="pdivimg"><img src="<?php echo $imagee['image'];?>" class="img-responsive img-cover-125" /></div>
  <div class="pcontent">
  <div class="psku"><?php echo $imagee['text'];?></div>
  </div>
  </div>
  </div>

<?php } ?>
