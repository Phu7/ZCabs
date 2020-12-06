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
				<button class="btn btn-lg btn-success" onclick="showMore()"> Pay INR <?php echo $this->session->userdata('payment')['walletToCut'];?> By Wallet </button>
			</div>
			<div class="wrappad">
					<?php echo form_open("home/confirmByWallet", array("id"=>"form", "class"=>"hide"));?>
						<input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
						<input type="hidden" name="oedid" value="<?php echo $oedid; ?>"/>
						<input type="submit">
					<?php echo form_close();?>
			</div>
    </div>

		<!-- Update Modal -->
		<div id="updateModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-sm">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Please Fill Customer detail</h4>
		      </div>
		      <div class="modal-body">
		        <?php echo form_open('account/update_out', array("id" => "update_form")); ?>
						<div class="form-group">
							<input type="text" placeholder="Passanger Name" class="form-control" required name="full_name" id="full_name" />
						</div>

						<div class="form-group">
							<input type="text" placeholder="Passenger Mobile Number" class="form-control" required name="mobile" id="update_mobile" />
						</div>

						<div class="form-group">
							<textarea placeholder="Comment" class="form-control" required name="comment" id="update_comment"></textarea>
						</div>


						<input type="hidden" name="id" id="update_id" value="<?php echo $order_id; ?>" />
						<button type="submit" class="btn btn-primary">Update</button>
						<?php echo form_close(); ?>
					</div>
		    </div>
		  </div>
		</div>
    <?php
    $this->load->view('front/common/footer');
    ?>
		<?php if($this->customer->isType() == 3){?>
		<script>

		$(document).ready(function(){
			$("#updateModal").modal("show");

			$('#update_form').on('submit', (function(e) {
		        e.preventDefault();
		          $.ajax({
		            url: '<?php echo base_url(); ?>account/update_out',
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
		              $("#updateModal").modal("hide");
		            },
		            error: function(){}
		          });
		    }));
		});
		</script>
		<?php } ?>

		<script>
		function showMore(){
			$('#ajax-loader').removeClass('loaderhide');
			$("#form").submit();
		}

		</script>
