
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo WEBSITE_NAME; ?> </title>

     <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- bootstrap-datetimepicker -->
	<link href="<?php echo base_url() ?>vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<link href="<?php echo base_url()?>vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

	<!-- Datatables -->
	<link href="<?php echo base_url() ?>vendors/datatables-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>vendors/datatables-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>vendors/datatables-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>vendors/datatables-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>vendors/datatables-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="<?php echo base_url() ?>build/css/custom.min.css" rel="stylesheet">


	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />

	 <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url();?>" class="site_title"><i class="fa fa-paw"></i> <span><?php echo WEBSITE_NAME; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url();?>images/logo.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo WEBSITE_NAME; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?php echo base_url();?>admin"><i class="fa fa-home"></i> DashBoard</a></li>

                    <li><a><i class="fa fa-"></i> Publication <span class="fa fa-chevron-down"></span></a>
                       <ul class="nav child_menu">
                       <li><a href="<?php echo base_url()?>admin/books">Books </a></li>
                       <li><a href="<?php echo base_url()?>admin/topics">Topics </a></li>
                       <li><a href="<?php echo base_url()?>admin/pages">Page </a></li>

                     </ul>
                   </li>

                   <li><a><i class="fa fa-file-o"></i> Static Data<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li><a href="<?php echo base_url()?>admin/cms">Cms Pages </a></li>
                      <li><a href="<?php echo base_url()?>admin/block">Block Sections </a></li>
                      <li><a href="<?php echo base_url()?>admin/metas">Meta data </a></li>

                    </ul>
                  </li>

                  <li><a><i class="fa fa-file-o"></i> Course<span class="fa fa-chevron-down"></span></a>
                     <ul class="nav child_menu">
                     <li><a href="<?php echo base_url()?>admin/course">Courses </a></li>
                     <li><a href="<?php echo base_url()?>admin/course_detail">Course Detail </a></li>
                     <li><a href="<?php echo base_url()?>admin/course_syllabus">Course Syllabus & Pattern </a></li>

                   </ul>
                 </li>

                 <li><a><i class="fa fa-file-o"></i> Result<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="<?php echo base_url()?>admin/rescat">Result Category </a></li>
                    <li><a href="<?php echo base_url()?>admin/result">Result </a></li>

                  </ul>
                </li>

                  <li><a href="<?php echo base_url();?>admin/user"><i class="fa fa-users"></i> Users</a></li>
                   <li><a href="<?php echo base_url();?>admin/contact"><i class="fa fa-enevelope"></i>Contact Form</a></li>
                   <li><a href="<?php echo base_url();?>admin/newsletter"><i class="fa fa-users"></i>Subscribers</a></li>
				           <li><a href="<?php echo base_url()?>admin/common/change_password"><i class="fa fa-cog"></i> Change Password</a></li>
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url();?>uploads/logo.jpg" alt=""><?php echo WEBSITE_NAME; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url()?>admin/common/change_password"> Change Password</a></li>
                    <li><a href="<?php echo base_url()?>admin/common/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
