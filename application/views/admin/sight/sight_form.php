<?php $this->load->view('admin/home/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Sights</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/sight"><i class="fa fa-reply"></i></a>
				<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add Sight Seeing</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/sight/add_sight", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                        </li>
						<li role="presentation" class=""><a href="#tab_content8" role="tab" id="links-tab" data-toggle="tab" aria-expanded="false">Image</a>
                        </li>
						<li role="presentation" class=""><a href="#tab_content9" role="tab" id="links-tab" data-toggle="tab" aria-expanded="false">SEO</a>
                        </li>
                      </ul>
                     <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
                          <input type="hidden" id="o_img" name="o_img" value="<?php echo $image;?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php echo $name;?>" onblur="createseo()" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">location <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="location" name="location" required="required" class="form-control col-md-7 col-xs-12">
                             	<option value="">Select</option>
                              <?php foreach($locations->result() as $location){?>
                              <option value="<?php echo $location->id; ?>" <?php echo ($location_id == $location->id) ? 'selected':'';?>><?php echo $location->name;?></option>
                              <?php } ?>
                           </select>
                        </div>
                      </div>

                      	  <div class="form-group">

                                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description                        </label>						<div class="col-md-6 col-sm-6 col-xs-9">                          <textarea id="description" name="description" rows="5"  class="form-control col-md-7 col-xs-12"><?php echo $description; ?></textarea>                        </div>						<div class="col-md-3 col-sm-3 col-xs-3">						<span style="color:red;font-size:12px;">*Please type as usual in the box below and click on Save to bring the changes on the website. Please do not copy anything directly from the website or from any word document. Please write it directly in the box below and click on Save. Or you can copy in note pad and then paste.</span>						</div>		                      </div>

					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price" name="price" value="<?php echo $price;?>" required="required" class="form-control col-md-7 col-xs-12">
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
				  </div>



						<div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab">

				<table id="image" class="table table-striped table-bordered table-hover">
				<thead>
				<tr>
				<td colspan="3">
				<label>Image</label>
				<?php if($image){ ?>
					<img src="<?php echo base_url().$image;?>" width="100px"/>
				<?php } ?>
				<input type="hidden" name="old_input-image" value="<?php echo $image;?>"/>
				<input type="file" name="input-image" class="btn btn-primary" />
				</td>
				</tr>
				</thead>
                  <thead>
                    <tr>
                      <td class="text-left">Additional Image</td>
                      <td class="text-left">Text</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>

                  <?php $image_row = 1;
                  foreach($sight_image->result() as $sight_images){ ?>
                  <tr id="image-row<?php echo $image_row; ?>">
                    <td class="text-left" style="width: 60%;">
					<img src="<?php echo base_url().$sight_images->image;?>" width="70px">
					<input type="file" name="sight_image[]" class="form-control btn btn-default" />
					<input type="hidden" name="sight_image_count[]" value="1" />
					<input type="hidden" name="old_sight_image[]" value="<?php echo $sight_images->image; ?>" />
                    </td>
                    <td class="text-left">
                      <div class="input-group">
                        <input type="text" name="sight_image_sort[]" value="<?php echo $sight_images->sort_order;?>" placeholder="Text" class="form-control" />
                      </div>
                      </td>
                    <td class="text-right"><button type="button" onclick="remove_image(<?php echo $image_row;?>)" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                  </tr>
                  <?php $image_row = $image_row + 1;
                  }?>
                    </tbody>

                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-right"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Add" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
							</div>

						<div role="tabpanel" class="tab-pane fade" id="tab_content9" aria-labelledby="home-tab">


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">URL <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="slug" name="slug" value="<?php echo $slug;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="carat">Meta-Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="metatitle" name="metatitle" value="<?php echo $metatitle;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta-keyword
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="metakeyword" name="metakeyword" value="<?php echo $metakeyword;?>" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>



					   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta-Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="metadescription" name="metadescription" class="form-control col-md-7 col-xs-12"><?php echo $metadescription;?></textarea>
                        </div>
                      </div>


				  </div>

				  </div>
				  </div>

                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $this->load->view('admin/home/footer');?>



			<script type="text/javascript">

function createseo(){
	var name1 = $("#name").val();
	var slug = name1.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-').toLowerCase();
	$("#slug").val(slug);
}
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left" style="width: 50%;"><input type="file" name="sight_image[]" class="form-control" /><input type="hidden" name="sight_image_count[]" value="1" class="form-control" /><input type="hidden" name="old_sight_image[]" value="" /></td>';
	html += '  <td class="text-left">';
	html += '<div class="input-group"><input type="text" name="sight_image_sort[]" placeholder="Text" class="form-control" /></div>';
    html += '  </td>';
	html += '  <td class="text-right"><button type="button" onclick="remove_image(' + image_row + ')" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

	$('#image tbody').append(html);
	image_row++;
}

function remove_image(u){
	$('#image-row'+u).remove();
 }
 </script>
