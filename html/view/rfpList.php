<?php include('header.html'); ?>


<!--Row containing list of rfps -->
<div clas="row">

	<div class="col-md-2"></div>

	<div class="col-md-8 formCol top">
		<h2 class="titleCol">Available RFPs</h2>
		<?php echo $rfpTable; ?>
	</div>

	<div class="col-md-2"></div>

</div><!-- End of row -->

<?php include('view/footer.html'); ?>