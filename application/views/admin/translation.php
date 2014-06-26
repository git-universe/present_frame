<div class="container">
	<?php foreach ($errors as &$e) { ?>
	    <div class="alert alert-dismissable alert-danger">
    		<button type="button" class="close" data-dismiss="alert">×</button>
	    	<?php echo $e; ?>
	    </div>
	<?php } ?>

	<?php foreach ($messages as &$m) { ?>
	    <div class="alert alert-dismissable alert-success">
    		<button type="button" class="close" data-dismiss="alert">×</button>
	    	<?php echo $m; ?>
	    </div>
	<?php } ?>
	
	<form method="post" action="" name="translationform" class="form-horizontal">
		<input name="form_type" type="hidden" value="editTranslations">
		<fieldset>

		    <legend> Edit translations </legend>

		    <?php foreach ($translations as &$t) { ?>
		    	<div class="form-group">
			    	<label for="input_translation_<?php echo $t->short; ?>" class="col-lg-2 col-lg-offset-1 control-label">
			    		Translation for <?php echo $t->short; ?> language
			    	</label>
				    <div class="col-lg-8">
				    	<input id="input_translation_<?php echo $t->short; ?>" class="form-control" 
				    		type="text" min="2" max="100" name="input_translation_<?php echo $t->short; ?>" 
				    		value="<?php echo $t->translation ?>" required />
				    </div>
			    </div>
		    <?php } ?>

		    <div class="form-group">
		        <div class="col-lg-7 col-lg-offset-5">
		        	<button type="button" class="btn btn-default"
		        		onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/translations'; ?>'">
		        		<span class="glyphicon glyphicon-chevron-left"></span> All translations
		        	</button>
		        	<button type="submit" class="btn btn-primary">
		        		Submit
		        	</button>
		        </div>
	        </div>


		</fieldset>
	</form>
</div>