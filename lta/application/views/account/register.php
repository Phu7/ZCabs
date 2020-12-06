<?php $this->load->view("home/common/header_account"); ?>

<div class="wrappage">


<div class="container">

<ol class="breadcrumb">

    <li><a href="#">Home</a></li>

    <li class="active">Register</li>

  </ol>

</div>



<div class="container wrappad">

	<div class="col-sm-4 col-sm-offset-4">

	<LEGEND>CREATE ACCOUNT</LEGEND>

		<?php echo form_open("account/register_submit"); ?>
<input type="hidden" name="redirection_path" value="<?php /*echo $path;*/?>" />
			<div class="form-group">

				<label>Your Name</label>

				<input type="text" required class="form-control" name="name"/>

			</div>



			<div class="form-group">

				<label>Mobile Number</label>

				<input type="text" required class="form-control" name="mobile"/>

			</div>



			<div class="form-group">

				<label>Email Address (Optional)</label>

				<input type="text" class="form-control" name="email"/>

			</div>



			<div class="form-group">

				<label>Password</label>

				<input type="password" required class="form-control" name="password"/>

			</div>



			<input type="submit" value="LOGIN" class="btn btn-primary btn-sm" />

		<?php echo form_close(); ?>

	</div>

</div>

</div>
<?php $this->load->view("home/common/footer_account"); ?>
