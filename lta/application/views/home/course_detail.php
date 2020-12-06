
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <?php $this->load->view("front/common/header");?>
  <div class="main-content">
  <section class="inner-header  divider parallax layer-overlay overlay-gray-8" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 64px;">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-left">
               <h2 class="text-uppercase title mt-0 text-left"><?php echo $result['name'];?></h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="#">Home</a></li>

                <li class="active text-theme-colored"><?php echo $result['name'];?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="cources-page cource-exam pt-30 pb-30">
    <div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-7">
            <img class="" src="<?php echo $result['image'];?>" alt="">


            <?php echo $result['textdata'];?>


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

<?php  /******Sidebar******/

echo $this->sidebar->videos();
/* echo $this->sidebar->publictaion(); */
?>


            </div>
    </div>
    </div>



    </div>




  </div>











  <?php $this->load->view("front/common/footer");?>
