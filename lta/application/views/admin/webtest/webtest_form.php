<?php $this->load->view('admin/common/header');?>
<div class="page-title">
              <div class="title_left">
                <h3>Test</h3>
			  </div>
			  <div class="title_right">
			  <a class="btn btn-sm btn-default pull-right"  data-toggle="tooltip" title="Back" href="<?php echo base_url();?>admin/category"><i class="fa fa-reply"></i></a>
				<button form="demo-form2" type="submit" class="btn btn-sm btn-info pull-right"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
              </div>
			  </div>
			  <div class="clearfix"></div>


<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5><i class="fa fa-pencil"></i> Add</h5>
                       <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php echo form_open("admin/test/webtest/edit", array("id"=>"demo-form2", "enctype"=>"multipart/form-data", "class"=>"form-horizontal form-label-left")); ?>

                          <input type="hidden" id="id" name="id" value="<?php echo $id;?>">

					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Combo Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control col-md-7 col-xs-12" required name="subject_id" id="subject_id" onchange="getPapers()">
            						        <option value="">--Choose Combo--</option>
            						<?php foreach($combos->result() as $combo){?>
                          		<option value="<?php echo $combo->id;?>" <?php echo $combo->id == $combo_id ? "selected":"";?>><?php echo $combo->name;?></option>
                				<?php } ?>
            						</select>
            						  </div>
          </div>

          <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Paper Name                        </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select class="form-control col-md-7 col-xs-12" required name="paper_id" id="paper_id" onchange="getSections()"></select>
                          </div>
          </div>


          <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> Section Name                      </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-7 col-xs-12" id="section_id" required name="section_id"></select>
              </div>
        </div>


					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Question
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea required id="question" name="question" class="form-control col-md-7 col-xs-12"><?php echo $question; ?></textarea>
                        </div>
            </div>


            		  <div class="form-group">
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Option 1                        </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                     <textarea required id="option1" name="option1" class="form-control col-md-7 col-xs-12"><?php echo $option1; ?></textarea>
                                                            </div>
                  </div>

                  			 <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Option 2                        </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                         <textarea required id="option2" name="option2" class="form-control col-md-7 col-xs-12"><?php echo $option2; ?></textarea>
                                            </div>
                        </div>


	<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Option 3                        </label>

                                               <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <textarea required id="option3" name="option3" class="form-control col-md-7 col-xs-12"><?php echo $option3; ?></textarea>
                                                </div>
                        </div>


                        		 <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Option 4                        </label>

                                                              <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                     <textarea required id="option4" name="option4" class="form-control col-md-7 col-xs-12"><?php echo $option4; ?></textarea>
                                                                                    </div>
                              </div>

	<div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Solution                        </label>
                                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                                                   <textarea required id="solution" name="solution" class="form-control col-md-7 col-xs-12"><?php echo $solution; ?></textarea>
                                                                                   </div>
                                                                                                    </div>

					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Right Option
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select required id="right" name="right" class="form-control col-md-7 col-xs-12">
							<option value="" <?php echo $right == 0 ? "selected":""; ?>>Choose Right Option</option>
              <option value="1" <?php echo $right == 1 ? "selected":""; ?>>Option 1</option>							<option value="2" <?php echo $right == 2 ? "selected":""; ?>>Option 2</option>							<option value="3" <?php echo $right == 3 ? "selected":""; ?>>Option 3</option>							<option value="4" <?php echo $right == 4 ? "selected":""; ?>>Option 4</option>
						  </select>
                      </div>
					  </div>

                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>





            <script>

            function getPapers(){
                $.ajax({
                  url: '<?php echo base_url();?>admin/test/webtest/getPapers',
                  type: "POST",
                  data: {"id":$("#combo_id").val()},
                  success:					   function(data){
                    $("#paper_id").html(data);
                    $("#paper_id").val(<?php echo $paper_id;?>);
                  },
error: function(){}
                });
              }

            function getSections(){
              $.ajax({
                url: '<?php echo base_url();?>admin/test/webtest/getSections',
                type: "POST",
                data: {"id":$("#paper_id").val()},
                success:					   function(data){
                  $("#section_id").html(data);
                  $("#section_id").val(<?php echo $section_id;?>);

                },
                error: function(){}
              });
            }			</script>
			<?php $this->load->view('admin/common/footer');?>
      <?php if($this->input->get("id")){ ?>
        <script>
          getPapers();
          setTimeout(function(){ getSections(); }, 1000);



        </script>
      <?php } ?>
			<script>

			 $(document).ready(function() {



        CKEDITOR.replace( 'question' );
        CKEDITOR.replace( 'option1' );
        CKEDITOR.replace( 'option2' );
        CKEDITOR.replace( 'option3' );
        CKEDITOR.replace( 'option4' );
        CKEDITOR.replace( 'solution' );





			});
			</script>
