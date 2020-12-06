<?php
$this->load->view('front/common/header');
?>
<style>
	.hide{
		display:none;
	}
	.MoneyBox{
		text-align: center;
		padding: 20px 60px;
		border: 1px solid #f5a129;
	}
</style>
<div>
	<img src="images/smbanner.jpg" width="100%" />
</div>



    <div class="col-sm-4 col-sm-offset-4">
			<center><h2 style="margin-bottom: 20px;">Wallet</h2></center>
			<div class="MoneyBox wrappad">
				<h2 style="margin-bottom:15px;">INR <?php echo $this->customer->getWallet();?></h2>
				<button class="btn btn-lg btn-success" onclick="showMore()"> Add Money </button>
			</div>
			<div class="wrappad">
			<?php echo form_open('razorpay/checkout', array("class" => "hide", "id" => "form"));?>

          <div class="form-group">
            <label>Amount To Be Add</label>
            <input type="text" name="amount" class="form-control" />
          </div>

          <input type="submit" class="btn btn-success" value="Add Money" />

        <?php echo form_close();?>
        <br/><br/>&nbsp;
			</div>
    </div>

    <?php
    $this->load->view('front/common/footer');
    ?>
		<script>
			function showMore(){
				$("#form").removeClass("hide");
				$(".btn-lg").addClass("hide");
			}
		</script>
