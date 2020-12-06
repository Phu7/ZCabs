<?php $this->load->view('admin/home/header');?>
            <div class="page-title">
              <div class="title_left">
                <h3>Dashboard</h3>

              </div>


            </div>

            <div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                  <div class="x_content">
                    <h2>Users</h2>
                    <div class="row top_tiles">

                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #f47141;">
                      <div class="icon"><i class="fa fa-users"></i></div>
                      <div class="count">Total</div>
                      <h3><?php echo $total_users;?></h3>
                      <a href="<?php echo base_url();?>admin/user"><p>Show More</p></a>
                      </div>
                      </div>

                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #f49d41;">
                      <div class="icon"><i class="fa fa-users"></i></div>
                      <div class="count">Users</div>
                      <h3><?php echo $users;?></h3>
                      <a href="<?php echo base_url();?>admin/user"><p>Show More</p></a>
                      </div>
                      </div>


                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #f4bb41">
                      <div class="icon"><i class="fa fa-car"></i></div>
                      <div class="count">Drivers</div>
                      <h3><?php echo $drivers;?></h3>
                      <a href="<?php echo base_url();?>admin/driver"><p>Show More</p></a>
                      </div>
                      </div>


                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #9b7118">
                      <div class="icon"><i class="fa fa-users"></i></div>
                      <div class="count">Agents</div>
                      <h3><?php echo $agents;?></h3>
                      <a href="<?php echo base_url();?>admin/agent"><p>Show More</p></a>
                      </div>
                      </div>


                    </div>
                  </div>



                  <div class="x_content">
                    <h2>Trips</h2>
                    <div class="row top_tiles">

                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #177e9b;">
                      <div class="icon"><i class="fa fa-building"></i></div>
                      <div class="count">Total</div>
                      <h3><?php echo $total_trips;?></h3>
                      <a href="<?php echo base_url();?>admin/trips"><p>Show More</p></a>
                      </div>
                      </div>

                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #17549b;">
                      <div class="icon"><i class="fa fa-car"></i></div>
                      <div class="count">Local</div>
                      <h3><?php echo $locals;?></h3>
                      <a href="<?php echo base_url();?>admin/local"><p>Show More</p></a>
                      </div>
                      </div>


                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #171b9b">
                      <div class="icon"><i class="fa fa-car"></i></div>
                      <div class="count">Outstation</div>
                      <h3><?php echo $outs;?></h3>
                      <a href="<?php echo base_url();?>admin/out"><p>Show More</p></a>
                      </div>
                      </div>


                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="tile-stats" style="background: #4416a0;">
                      <div class="icon"><i class="fa fa-fort-awesome"></i></div>
                      <div class="count">Sight Seen</div>
                      <h3><?php echo $sights;?></h3>
                      <a href="<?php echo base_url();?>admin/sight"><p>Show More</p></a>
                      </div>
                      </div>


                    </div>
                  </div>



					       </div>
                </div>





			<?php $this->load->view('admin/home/footer');?>
