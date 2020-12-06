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

<div class="innercontent">
  <div class="container">
<h1 class="h1marignten"><?php echo $result->name; ?> </h1>
<p><?php echo $result->text_data; ?></p>
</div>
</div>
<?php $this->load->view("front/common/footer");?>
