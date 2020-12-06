<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo WEBSITE_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php if($this->session->flashdata('msg')){?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('msg');?></div>
          <?php } ?>
           <?php echo form_open('admin/common/check_login');?>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-default submit" name="submit" value="Log in">
                <!--a class="reset_pass" href="#">Lost your password?</a-->
              </div>
				<?php echo form_close();?>
              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> <?php echo WEBSITE_NAME; ?></h1>
                  <p>©2018 All Rights Reserved. <?php echo WEBSITE_NAME; ?> Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
