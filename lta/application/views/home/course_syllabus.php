  <?php $this->load->view("home/common/header");?>
  <div class="main-content">
  <section class="inner-header  divider parallax layer-overlay overlay-gray-8" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 64px;">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-left">
               <h2 class="text-uppercase title mt-0 text-left"><?php echo $result['name'];?></h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="/">Home</a></li>

                <li class="active text-theme-colored"><?php echo $result['name'];?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="cources-page pt-30 pb-30">
    <div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-7">
            <img class="" src="<?php echo $result['image'];?>" alt="">




					<div class="body_text">
						<?php echo $result['textdata'];?>
					</div>








            </div>
   <div class="col-md-4 col-sm-5 mt-sm-60 ">
   <div class="features">
         <div class="head-bg">
              <h2 class="text-uppercase mt-0">Let's Talk  <span class=" font-weight-300">Academy</span></h2>
              <p>Many Reasons for Choosing us as Your Trainer</p>
          </div>
       <ul>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>DQPS </strong>– Daily Question Practice Sheet
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>Comparison of result</strong> on day to day basis
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   Teaching through <strong> scientific attitude</strong>
               </p>
               <p></p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>Branches</strong> in
                   <a href="https://www.letstalkacademy.com/" target="_blank">Jaipur</a>,
                   <a href="https://www.letstalkacademy.com/course-detail/net-life-science-institute-in-delhi"  target="_blank">Delhi</a> &amp;
                   <a href="https://www.letstalkacademy.com/course-detail/net-life-science-exam-coaching-in-varanasi" target="_blank">Varanasi</a>
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong> Individual </strong> attention
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>Inculcate basics</strong> &amp; fundamentals, nurture brain &amp; develop the concept.
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>Mock interviews</strong> for PhD @ Research Institutes
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>Paper presentation</strong>
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>One to one discussion</strong> on every burning topic of research
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong>Hostel facility is</strong> provided at all LTA centers
               </p>
           </li>
           <li>
               <span>
                   <i class="fa fa-check-circle-o" aria-hidden="true"></i>
               </span>
               <p>
                   <strong> Free Study material</strong> available on our <strong>Android app</strong> &amp; Publication web page
               </p>
           </li>
       </ul>

          </div>
       <div class="registration">
           <div class="head-bg">
               <h3 class="mt-0 mb-0">Interested Students?</h3>
               <p class="mt-0">Plese fill up the below form and we will contact to you in next 10 minutes!</p>
           </div>
           <div class="border-1px p-25">

               <div class="ajax-appointment"></div>
               <?php echo form_open("account/add_online", array("id"=>"appointment_form", "name"=>"appointment_form", "class"=>"mt-10 mb-0")); ?>
               <div class="row">
                   <div class="col-sm-12">
                       <div class="form-group mb-10">
                           <input name="name" class="form-control" required="" placeholder="Enter Name" aria-required="true" type="text">
                    </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="form-group mb-10">
                           <input name="email" class="form-control required email" required="" placeholder="Enter Email" aria-required="true" type="email">
                    </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="form-group mb-10">
                           <input name="mobile" class="form-control required" required="" placeholder="Enter Phone" aria-required="true" type="text">
                    </div>
                   </div>
                   <div class="col-sm-6">
                       <div class="form-group mb-10">
                           <select class="form-control" name="course" required="">
                               <option value=""> Course</option>
                               <option>Life Science</option>
                               <option>CSIR NET</option>
                               <option>Msc Entrance</option>
                               <option>DBT</option>
                               <option>GATE</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-sm-6">
                       <div class="form-group mb-10">
                           <select name="city" class="form-control" required="required">
                               <option value=""> City</option>
                               <option value="1">Jaipur</option>
                               <option value="2">Delhi</option>
                               <option value="3">Varansi</option>
                           </select>
                       </div>
                   </div>


               </div>
               <div class="form-group mb-10">
                   <textarea name="msg" class="form-control required" placeholder="Enter Message" rows="5" aria-required="true"></textarea>
               </div>
               <div class="form-group mb-0 mt-20">
                   <input type="submit" class="btn btn-dark btn-theme-colored" data-loading-text="Please wait..." value="Submit">
                </div>
               <?php echo form_close(); ?>
           </div>
       </div>


          <?php echo $this->sidebar->videos();
			echo $this->sidebar->publictaion();
			echo $this->sidebar->director();

			?>


            </div>
    </div>
    </div>



    </div>




  </div>
  <?php $this->load->view("home/common/footer");?>
