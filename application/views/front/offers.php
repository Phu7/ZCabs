<?php $this->load->view("front/common/header");?>
<style>

</style>
<div>
				<img src="images/smbanner.jpg" width="100%" />
			</div>

<!--div class="container">
<ol class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li class="active">Contact</li>
  </ol>
</div-->

<div class="innercontent">
	<div class="container wrappad">
		<h1 class="h1marignten">Notifications</h1>
		<?php
		if($result->num_rows()){
		foreach($result->result() as $result){?>
		<div class="col-sm-4">
			<div class="pdiv">
				<a><img src="<?php echo $result->image;?>" class="img-responsive img-cover-260"></a>
				<div class="pcontent">
					<div class="ptitle"><a><?php echo $result->name;?></a></div>
					<div class="psku"><a><?php echo $result->text_data; ?></a></div>
					</div>
			</div>
		</div>
		<?php } } else{ ?>
			<h2>No Offers Found</h2>
		<?php } ?>
	</div>
</div>



<!--  -->
<div id="myModalrr" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">

					<div id="fullData"></div>

			</div>

    </div>

  </div>
</div>

<?php $this->load->view("front/common/footer");?>
<script>
	$(document).ready(function(){
		$(".pdiv").on('click', function(){
			var nodeChild = $(this).find('.pcontent');
			var title = nodeChild.find(".ptitle").html();
			var data = nodeChild.find(".psku").html();
			$(".modal-title").html(title);
			$("#fullData").html(data);
			$("#myModalrr").modal('show');
		});
	});

</script>
