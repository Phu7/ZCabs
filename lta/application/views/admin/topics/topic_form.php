<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Topics</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/topics"><i class="fa fa-reply"></i></a>
				<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Topic</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/topic/add_topic", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">


                          <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Book Name:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<select name="book_id" class="form-control col-md-7 col-xs-12">
<option value="">--Select a book--</option>
<?php foreach($books->result() as $books){?>
	<option value="<?php echo $books->book_id;?>" <?php echo $books->book_id == $book_id ? 'selected':''; ?>><?php echo $books->book_name;?></option>
<?php }?>
</select>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Topic Name:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<input type="text" name="topicname" value="<?php echo $topicname; ?>" class="form-control col-md-7 col-xs-12" required="" />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title URL:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<input type="text" name="titleurl" value="<?php echo $titleurl; ?>" class="form-control col-md-7 col-xs-12" required="" />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metakeywords:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<input type="text" name="metakeyword" value="<?php echo $metakeyword; ?>" class="form-control col-md-7 col-xs-12" required="" />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metadescription:</label>
<div class="col-md-6 col-sm-6 col-xs-12">
<textarea name="metadescription" value="<?php echo $metadescription; ?>" class="form-control col-md-7 col-xs-12"></textarea>
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
			<script>

			 $(document).ready(function() {
				$('#description').summernote({
				height: 200
				});
			});
			</script>
