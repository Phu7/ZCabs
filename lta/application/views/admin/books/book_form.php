<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Books</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/books"><i class="fa fa-reply"></i></a>
				<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Books</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/books/add_book", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                          <input type="hidden" id="o_img" name="o_img" value="<?php echo $o_img;?>">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php echo $name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Author <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="writer" name="writer" value="<?php echo $writer;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amazon Link <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="amazon" name="amazon" value="<?php echo $amazon;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="image" name="image" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="titleurl" name="titleurl" value="<?php echo $titleurl;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Keyword
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="metakeyword" name="metakeyword" value="<?php echo $metakeyword;?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metadescription
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="metadescription" name="metadescription" class="form-control col-md-7 col-xs-12"><?php echo $metadescription;?></textarea>
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="status" name="status" class="form-control col-md-7 col-xs-12">
							<option value="1" <?php echo ($status == '1') ? "selected":"";?>>Enable</option>
							<option value="0" <?php echo ($status == '0') ? "selected":"";?>>Disable</option>
						  </select>
                      </div>
					  </div>

                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>
