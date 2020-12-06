<?php $this->load->view("home/common/header");?>
<div class="main-content">
  <section class="inner-header  divider parallax layer-overlay overlay-gray-8" data-bg-img="http://placehold.it/1920x1280" style="background-image: url(&quot;http://placehold.it/1920x1280&quot;); background-position: 50% 64px;">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
               <h2 class="text-uppercase title mt-0 text-center">Results <span class="text-black font-weight-300"></span></h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>

                <li class="active text-theme-colored">Results</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>


    <div class="result-page pt-30 pb-30">
    <div class="container">
    <div class="row">



          <div class="col-md-9 col-sm-8">
          <div class="Result-year">


            <div class="form-group">

                  <select class="form-control" id="searchresult">


					      <?php foreach($cate->result() as $categ){?>
                    <option value="<?php echo $categ->title;?>"><?php echo $categ->title;?></option>
					      <?php } ?>
				          </select>
                </div>



                <div class="btn-search">
                <button type="submit" class="btn btn-dark btn-theme-colored" onclick="searchresult()">Search Result</button>
                </div>

				<script>
				function searchresult(){
					var u = $("#searchresult").val();
					location.href="<?php echo base_url();?>lta-clasroom-results?search="+u;
				}
				</script>
                 <div class="clearfix"></div>
            </div>
            <div id="result-1" class="mb-50">
			<h3>Results</h3>
             <p>

			 <?php echo (!empty($z)) ? $z->textdata:"";?></p>

			 <?php foreach($result as $result){?>
			 <h3><?php echo $result['name'];?></h3>


              <div class="row">
			  <?php foreach($result['result'] as $res){?>
			  <div class="col-md-3 col-sm-6">
              <div class="item border-theme-colored  mb-sm-30">
                <div class="icon-box text-center pl-0 pr-0 mb-0">
                  <a class="icon icon-circled icon-border-effect effect-circle icon-xl" href="#">
                    				  <?php
					if($res['image'] != "" AND file_exists("./".$res['image'])){
						$image = base_url().$res['image'];
					}
					else{
						$image = base_url()."images/default_male.jpg";
					}
				  ?>
                    <img src="<?php echo $image;?>" />
                  </a>
                  <h4 class="icon-box-title mt-0 mb-0 letter-space-1 text-uppercase"><a href="#"><strong><?php echo $res['name'];?></strong></a></h4>
                  <p><?php echo ($res['university']) ? '<b>University:</b>'.$res['university'] :'';?></p>
                  <p><?php echo ($res['rank']) ? "<b>Rank:</b> " . $res['rank']:"";?></p>
                  <p><?php echo ($res['roll_number']) ? "<b>Roll No.:</b> " . $res['roll_number']:"";?></p>
                </div>
              </div>
            </div>
			  <?php } ?>

              </div>
			 <?php } ?>
                </div>

          </div>
           <div class="col-md-3 col-sm-4">


			<?php /**Videos**/

			echo $this->sidebar->videos();
			echo $this->sidebar->director();

			?>

           </div>



    </div>
    </div>



    </div>




  </div>

  <?php $this->load->view("home/common/footer");?>
