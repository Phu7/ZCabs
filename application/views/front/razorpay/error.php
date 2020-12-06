<?php
$this->load->view('front/common/header');
?>

<div>
	<img src="images/smbanner.jpg" width="100%" />
</div>

    <div class="col-sm-4 col-sm-offset-4">
        <center><h1 style="margin-bottom:15px;"><i class="fa fa-exclamation-triangle bordernone"></i>Failed</h1>
			<p> Your transaction has been not completed. Please try again later.</p>
			<a href="account" class="btn btn-success">Go to Account</a></center>

        <br/><br/>&nbsp;

    </div>

    <?php
    $this->load->view('front/common/footer');
    ?>
