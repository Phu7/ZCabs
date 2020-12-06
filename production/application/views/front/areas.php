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
	<h1 class="h1marignten">Sights</h1>
  <?php foreach($result->result() as $result){?>
  <div class="col-sm-4">
    <div class="white-box">
      <a href="sight/<?php echo $result->name; ?>"><?php echo $result->name; ?></a>
  </div></div>
<?php } ?>
</div>


<?php $this->load->view("front/common/footer");?>
