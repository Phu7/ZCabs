<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Courses Detail</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/page"><i class="fa fa-reply"></i></a>
				<button type="submit" form="demo-form2" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Course Detail</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/course_detail/add", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" required="required" value="<?php echo $id;?>" class="form-control col-md-7 col-xs-12">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Course Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="course_id" required="required" class="form-control col-md-7 col-xs-12">
						  <option value="">SELECT COURSE</option>
						  <?php foreach($course->result() as $course){ ?>
						  <option value="<?php echo $course->course_id;?>" <?php echo ($course->course_id == $course_id) ? "selected":""?>><?php echo $course->name;?></option>
						  <?php } ?>
						  </select>
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Location <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="location_id" required="required" class="form-control col-md-7 col-xs-12">
						  <option value="">SELECT Location</option>
						  <?php foreach($location->result() as $location){ ?>
						  <option value="<?php echo $location->id;?>" <?php echo ($location->id == $location_id) ? "selected":""?>><?php echo $location->city;?></option>
						  <?php } ?>
						  </select>
                        </div>
                      </div>

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
                          <textarea id="_data" name="_data" required="required" class="form-control col-md-7 col-xs-12"><?php echo $description;?></textarea>
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<img src="<?php echo base_url().$image;?>" width="100px;"><br/>
                          <input type="file" id="image" name="input-image" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" id="image" name="old_input-image" value="<?php echo $image;?>">
                        </div>
                      </div>

					  	<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="slug" name="slug" value="<?php echo $slug;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


					            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metatitle <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="title" value="<?php echo $title;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metakeyword
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




                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
            			<?php $this->load->view('admin/home/footer');?>
			<script>

			 $(document).ready(function() {
				$('#_data').summernote({
				height: 200
				});

      });
			</script>
