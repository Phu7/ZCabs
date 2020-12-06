<?php $this->load->view('admin/common/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Combos</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/test/combo"><i class="fa fa-reply"></i></a>
				<button type="submit" form="demo-form2" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Combo</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" method="post" action="<?php echo base_url()?>admin/test/combo/add" class="form-horizontal form-label-left">

                          <input type="hidden" id="id" name="id" required="required" value="<?php echo $id;?>" class="form-control col-md-7 col-xs-12">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Subject Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php echo $name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price" name="price" value="<?php echo $price;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number of tests <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tests" name="tests" value="<?php echo $tests;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="status" name="status" required="required" class="form-control col-md-7 col-xs-12">
                            <option value="1" <?php echo $status == '1' ? 'selected':''; ?>>Enable</option>
                            <option value="0" <?php echo $status == '0' ? 'selected':''; ?>>Disable</option>
                          </select>
                        </div>
                      </div>

                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/common/footer');?>
