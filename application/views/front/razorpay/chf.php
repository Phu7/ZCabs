<?php
$this->load->view('front/common/header');
?>

<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>

<?php
$productinfo = 'description';
$txnid = time();
$surl = $surl;
$furl = $furl;
$key_id = 'rzp_live_fvzMeQrzobo4m4';
$currency_code = 'INR';
$total = $total;
$amount = $amount;
$merchant_order_id = $order_id."r".$oedid;
$card_holder_name = $name;
$email = $email;
$phone = $mobile;
$name = 'Zcabs';
$return_url = base_url().'razorpay/callback_final';
?>

<div class="row">
    <div class="col-lg-12">
        <?php if(!empty($this->session->flashdata('msg'))){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
    </div>
</div>

<div class="col-sm-4 col-sm-offset-4">

<div>
  <a href="<?php print base_url();?>" name="reset_add_emp" id="re-submit-emp" data-toggle="tooltip" title="Go Back">
     <i class="fas fa-arrow-left fa-lg" style="float:left;margin-top: 2%;"></i>
  </a>      
  <h2 style="margin-bottom:15px;margin-left: 35%;">Payment</h2>
</div>
 <form name="razorpay-form" id="razorpay-form" action="<?php echo $return_url; ?>" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
  <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
  <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
  <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $productinfo; ?>"/>
  <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
  <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
  <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
  <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
  <div class="form-group">
    <label>Total Amount</label>
      <input type="text" readonly class="form-control" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
  </div>
  </form><br/>
            <input id="submit-pay" type="submit" onclick="razorpaySubmit(this,1);" value="Pay Now(Full Amount)" class="btn btn-primary btn-lg" style="width:100%;" />
            <input id="submit-pay" type="submit" onclick="razorpaySubmit(this,2);" value="Pay (Half Amount)" class="btn btn-primary btn-lg" style="width:100%;margin-top: 10px;" data-toggle="tooltip" title="Pay half to driver later"/>
        <br/>&nbsp;
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

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
  var razorpay_options_full = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };

   var razorpay_options_half = {
    key: "<?php echo $key_id; ?>",
    amount: "<?php echo $total/2; ?>",
    name: "<?php echo $name; ?>",
    description: "Order # <?php echo $merchant_order_id; ?>",
    netbanking: true,
    currency: "<?php echo $currency_code; ?>",
    prefill: {
      name:"<?php echo $card_holder_name; ?>",
      email: "<?php echo $email; ?>",
      contact: "<?php echo $phone; ?>"
    },
    notes: {
      soolegal_order_id: "<?php echo $merchant_order_id; ?>",
    },
    handler: function (transaction) {
        document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
        document.getElementById('razorpay-form').submit();
    },
    "modal": {
        "ondismiss": function(){
            location.reload()
        }
    }
  };

  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el, oprion){
    if(oprion==1){
      if(typeof Razorpay == 'undefined'){
        setTimeout(razorpaySubmit, 200);
        if(!razorpay_submit_btn && el){
          razorpay_submit_btn = el;
          el.disabled = true;
          el.value = 'Please wait...';
        }
      } else {
        if(!razorpay_instance){
          razorpay_instance = new Razorpay(razorpay_options_full);
          if(razorpay_submit_btn){
            razorpay_submit_btn.disabled = false;
            razorpay_submit_btn.value = "Pay Now";
          }
        }
        razorpay_instance.open();
      }
    }
    else{ 
      if(typeof Razorpay == 'undefined'){
        setTimeout(razorpaySubmit, 200);
        if(!razorpay_submit_btn && el){
          razorpay_submit_btn = el;
          el.disabled = true;
          el.value = 'Please wait...';
        }
      } else {
        if(!razorpay_instance){
          razorpay_instance = new Razorpay(razorpay_options_half);
          if(razorpay_submit_btn){
            razorpay_submit_btn.disabled = false;
            razorpay_submit_btn.value = "Pay Now";
          }
        }
        razorpay_instance.open();
      }

    }
  }
</script>
