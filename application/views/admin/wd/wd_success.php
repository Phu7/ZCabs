<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Withdrawal Success</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/driver"><i class="fa fa-reply"></i></a>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Withdrawal Success </h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/wd_req/suc", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $result->id;?>">
                          <input type="hidden" name="customer_id" value="<?php echo $result->customer_id;?>">
                          <input type="hidden" name="amount" value="<?php echo $result->amount;?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first_name" name="first_name" readonly value="<?php echo $result->first_name . " " . $result->last_name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Transaction Id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="transaction_id" required class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                    <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date Of Transaction <span class="required">*</span>
                                </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="dot" name="dot"  class="form-control col-md-7 col-xs-12">
                          </div>
                    </div>

					<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i> SUBMIT</button>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>
    <script>
    $('#dot').datetimepicker({
          minDate: moment(),
          format: 'MM/DD/YYYY'
    });
    </script>
