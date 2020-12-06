<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Results</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/result"><i class="fa fa-reply"></i></a>
				<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Results</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/result/add", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                          <input type="hidden" id="o_img" name="o_img" value="<?php echo $o_img;?>">

                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Parent Category</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="pid" id="pid" class="form-control">
                          <option value="">--[Parent Category]--</option>
                          <?php foreach($rescat->result() as $rescat){?>
                          	<option value="<?php echo $rescat->id;?>" <?php echo $rescat_id == $rescat->id ? 'selected':'';?>><?php echo $rescat->title;?></option>
                          <?php }?>
                          </select>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="title" id="title" value="<?php echo $name;?>" class="form-control"/>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title URL:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="titleurl" id="titleurl" value="<?php echo $titleurl;?>" class="form-control" placeholder="Title url"/>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">University:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="university" id="university" value="<?php echo $university;?>" class="form-control"/>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Roll Number:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="roll" id="roll" value="<?php echo $roll;?>" class="form-control"/>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rank:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="rank" id="rank" value="<?php echo $rank;?>" class="form-control"/>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Browse Image">Browse file ( pdf/image ):</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" name="image" id="image" class="btn btn-default">
                          </div>
                          <div class="col-sm-3">
                            <img src="<?php echo base_url().$o_img;?>" width="60px"/>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metakeyword:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="metakeyword" id="metakeyword" value="<?php echo $metakeyword;?>" class="form-control"/></textarea>
                          </div>
                          </div>
                          <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metadescription:</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="metadescription" id="metadescription" value="<?php echo $metadescription;?>" class="form-control"/></textarea>
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
