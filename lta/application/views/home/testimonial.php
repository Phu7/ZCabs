<?php $this->load->view("home/common/header");?>
<div class="main-content">
  <section class="inner-header  divider parallax layer-overlay overlay-dark-8" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 64px;">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
          <h2 class="text-uppercase title mt-0 text-center">Student's <span class="text-black font-weight-300">Review</span></h2></div>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>

                <li class="active text-theme-colored">Review</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="review-page testimonial pt-30 pb-30">
    <div class="container">
    <div class="row">
    <div class="col-md-12">
<ul id="myTab" class="nav nav-tabs boot-tabs">
  <li class="active"><a href="#Video-Testimonial" data-toggle="tab">Video Testimonial</a></li>
  <li><a href="#Testimonial" data-toggle="tab">Feedback By Student</a></li>

</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade in active" id="Video-Testimonial">
    <div class="video-sec">
                <div class="col-md-4 col-sm-6">
                  <div class="video">
                    <div class="fluid-width-video-wrapper" style="padding-top: 60.7143%;"><iframe src="https://www.youtube.com/embed/K0V4w8e4iuM" gesture="media" allow="encrypted-media" allowfullscreen="" id="fitvid0" frameborder="0"></iframe></div>

                 </div>
                </div>
                <div class="col-md-4 col-sm-6">
                  <div class="video">
                    <div class="fluid-width-video-wrapper" style="padding-top: 60.7143%;"><iframe src="https://www.youtube.com/embed/J1Wvgzp7T5U" gesture="media" allow="encrypted-media" allowfullscreen="" id="fitvid1" frameborder="0"></iframe></div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6">
                  <div class="video">
                    <div class="fluid-width-video-wrapper" style="padding-top: 60.7143%;"><iframe src="https://www.youtube.com/embed/WtZx-Y_CtfE" gesture="media" allow="encrypted-media" allowfullscreen="" id="fitvid2" frameborder="0"></iframe></div>
                </div>
                </div>

                <div class="col-md-4 col-sm-6">
                  <div class="video">
                    <div class="fluid-width-video-wrapper" style="padding-top: 60.7143%;"><iframe src="https://www.youtube.com/embed/GmmJHVQuAXs" gesture="media" allow="encrypted-media" allowfullscreen="" id="fitvid3" frameborder="0"></iframe></div>
                  </div>
                </div>
                <div class="clearfix"></div>
                </div>
  </div>
  <div class="tab-pane fade" id="Testimonial">
      <div class="row">

	  <?php if($result->num_rows()) {
		  $i = 1;
					foreach($result->result() as $result){?>
          <div class="col-md-6">
              <div class="feedback-row">
                  <div class="feed-content">
                      <?php echo trim($result->description);?>
                      <a href="#" data-toggle="modal" data-target="#deleteProductModal<?php echo $i;?>" data-productid="3" data-productname="Product 3">Read More</a>
                  </p>

                  </div>

                  <div class="feed-top-bar">
                      <div class="img">
					  <?php
					if($result->image != "" AND file_exists("./".$result->image)){
						$image = base_url().$result->image;
					}
					else{
						$image = base_url()."images/default_male.jpg";
					}
				  ?>
                          <img class="img-responsive" src="<?php echo $image;?>" alt="">
                      </div>
                      <div class="name-title">
                          <h4><?php echo $result->title;?></h4>
                          <p>
                              <b>Designation:</b> <?php echo $result->designation;?></p>
                      </div>
                   </div>
                  <div class="clearfix"></div>
              </div>
              <div class="modal fade feed" id="deleteProductModal<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>

                          <div class="modal-body">
                              <?php echo $result->description;?>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
        <?php $i = $i+1;
}}?>
      </div>

               </div>
                   <div class="clearfix"></div>
              </div>
            </div>



               </div>
                   <div class="clearfix"></div>
              </div>
            </div>




  </div>

 <div class="clearfix"></div>
</div>






            </div>



    </div>



    </div>




  </div>
  <?php $this->load->view("home/common/footer");?>
