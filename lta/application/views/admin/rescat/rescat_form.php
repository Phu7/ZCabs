<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Result Category</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/rescat"><i class="fa fa-reply"></i></a>
				<button type="submit" form="demo-form2" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add New Result Category</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/rescat/add", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" required="required" value="<?php echo $id;?>" class="form-control col-md-7 col-xs-12">

                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="title" id="title" value="<?php echo $title;?>" class="form-control"/>
                          </div>
                          </div>

                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="title1" id="title1" value="<?php echo $title1;?>" class="form-control"/>
                          </div>
                          </div>

                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title URL:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="titleurl" id="titleurl" value="<?php echo $titleurl;?>" class="form-control" placeholder="Title url"/>
                          </div>
                          </div>

                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metakeyword:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="metakeyword" id="metakeyword" class="form-control"/><?php echo $metakeyword;?></textarea>
                          </div>
                          </div>

                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metadescription:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="metadescription" id="metadescription" class="form-control"/><?php echo $metadescription;?></textarea>
                          </div>
                          </div>

                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Select Status:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="status" id="status" class="form-control">
                          <option value="1" <?php echo $status == 1 ? 'selected':'';?>>Active</option>
                          <option value="0" <?php echo $status == 0 ? 'selected':'';?>>Block</option>
                          </select>
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
