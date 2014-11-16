<?php include('header.html'); ?>



<div class="row">

	<div class="col-md-1"></div>

	<div class="col-md-10 formCol top" >
		<h2 class="titleCol">Contact Info</h2>
		<form class="form-horizontal" role="form">

			<div class="form-group">
                <label class="col-xs-3" for="companyName">Company Name</label>
                <input type="text" class="form-control" name="companyName" value="<?php echo $user->getCompanyName() ?>">
            </div>

            <div class="form-group">
                <label class="col-xs-3" for="companyAddress">Company Address</label>
                <input type="text" class="form-control" name="companyAddress" value="<?php echo $user->getUserContact() ?>">
            </div>

            <div class="form-group">
                <label class="col-xs-3" for="companyCEO">Company CEO</label>
                <input type="text" class="form-control" name="companyCEO" value="<?php echo $user->getUserCEO() ?>">
            </div>

            <div class="form-group">
                <label class="col-xs-3" for="contactName">Contact Name</label>
                <input type="text" class="form-control" name="contactName" value="<?php echo $user->getUserContact() ?>">
            </div>

             <div class="form-group">
                <label class="col-xs-3" for="contactNumber">Contact Number</label>
                <input type="text" class="form-control" name="contactNumber" value="<?php echo $user->getPhoneNumber() ?>">
            </div>

             <div class="form-group">
                <label class="col-xs-3" for="contactEmail">Contact Email</label>
                <input type="text" class="form-control" name="contactEmail" value="<?php echo $user->getUserEmail() ?>">
            </div>

		</form>
	</div>
		

	<div class="col-md-1"></div>

</div><!-- End of first row -->

<div class="row">
	<div class="col-md-1"></div>

	<div class="col-md-10 formCol">
		<h2 class="titleCol">Active RFPs</h2>

		<?php echo $responseTable; ?>

	</div>

	<div class="col-md-1"></div>
</div>


<?php include('view/footer.html'); ?>