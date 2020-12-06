<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Block Form</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/block"><i class="fa fa-reply"></i></a>
				<button type="submit" form="demo-form2" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add New Block</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/block/add", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" required="required" value="<?php echo $id;?>" class="form-control col-md-7 col-xs-12">

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php echo $name;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Data <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="textdata" name="textdata" required="required" class="form-control col-md-7 col-xs-12"><?php echo $textdata;?></textarea>
                        </div>
                      </div>


		            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="title" value="<?php echo $title;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>



                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
            			<?php $this->load->view('admin/home/footer');?>
			<script>

			 $(document).ready(function() {
				$('#textdata').summernote({
				height: 200
				});

      });
			</script>
