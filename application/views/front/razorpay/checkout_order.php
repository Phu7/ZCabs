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
$merchant_order_id = $order_id;
$card_holder_name = $name;
$email = $email;
$phone = $mobile;
$name = 'Zcabs';
$return_url = base_url().'razorpay/callback_order';
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
<h2 style="margin-bottom:15px;">Confirm Money To Add</h2>

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
    <label>Amount To be Add</label>
  <input type="text" readonly class="form-control" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
</div>
</form><br/><br/>
            <a href="<?php print base_url();?>" name="reset_add_emp" id="re-submit-emp" class="btn btn-warning"><i class="fa fa-mail-reply"></i> Back</a>
            <input  id="submit-pay" type="submit" onclick="razorpaySubmit(this);" value="Pay Now" class="btn btn-primary" />
        <br/><br/>&nbsp;</div>


<?php

$this->load->view('front/common/footer');
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var razorpay_options = {
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
  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubmit(el){
    if(typeof Razorpay == 'undefined'){
      setTimeout(razorpaySubmit, 200);
      if(!razorpay_submit_btn && el){
        razorpay_submit_btn = el;
        el.disabled = true;
        el.value = 'Please wait...';
      }
    } else {
      if(!razorpay_instance){
        razorpay_instance = new Razorpay(razorpay_options);
        if(razorpay_submit_btn){
          razorpay_submit_btn.disabled = false;
          razorpay_submit_btn.value = "Pay Now";
        }
      }
      razorpay_instance.open();
    }
  }
</script>
