<?php include('header.html'); ?>

<div class="row">
	<div class="col-md-1"></div>

	<div class="col-md-10  formCol top">
		<form action="." method="POST" class="form-horizontal" role="form">
			<h2 class="titleCol">Respond To Proposal</h2>
			<input type="hidden" name="action" value="respondToRFP">
			<input type="hidden" name="associatedRFP" value="<?php echo $_GET['rfp'];?>">
			<div class="form-group">
                <label class="col-xs-3" for="propTitle">Proposal Title</label>
                <input type="text" class="form-control" name="propTitle">
            </div>

            <div class="form-group">
                <label class="col-xs-3" for="propCost">Proposal Cost</label>
                <input type="text" class="form-control" name="propCost">
            </div>

            <div class="form-group">
                <label class="col-xs-3" for="sumDesc">Summary Description</label>
                <textarea rows="10" cols="40" name="sumDesc"></textarea>
            </div>

            <div class="form-group">
                <label class="col-xs-3" for="contactName">File Upload</label>
                <input type="file" name="responseFile">
            </div>

            <div id="vendorPartnerInputs">
             	<div class="form-group">
             	   <label class="col-xs-3" for="vP0">Vendor Partner</label>
             	   <input type="text" class="form-control" name="vP0">
            	</div>
            	
            </div>
            <div id="addPartner" alt="add partner"><h3>+</h3></div>

            <input type="submit" class="btn btn-defualt tab" value="submit">
		</form>
	</div>

	<div class="col-md-1"></div>

</div><!-- end of row -->

<?php include('footer.html'); ?>