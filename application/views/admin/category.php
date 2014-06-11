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

	<form method="post" action="" name="loginform" class="form-horizontal">
		<input name="form_type" type="hidden" value="<?php echo ( isset($catDetails) ) ? 'edit' : 'new' ?>_category">
		<fieldset>
		    <legend> <?php echo ($id == 'new' ? 'NewCategory' : 'Edit category'); ?> </legend>

			<div class="form-group">
		    	<label for="category_input_name" class="col-lg-3 col-lg-offset-2 control-label">
		    		System name
		    	</label>
			    <div class="col-lg-4">
			    	<input id="category_input_name" class="form-control" type="text" pattern="[a-z0-9\-\_]{2,32}" name="category_name"
			    		value="<?php echo ( isset($catDetails) ) ? $catDetails->sys_name : '' ?>" required />
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="category_input_priority" class="col-lg-3 col-lg-offset-2 control-label">
		    		Priority
		    	</label>
			    <div class="col-lg-4">
			    	<input id="category_input_priority" class="form-control" type="number" name="category_priority" 
			    		step="1" max="10" min="-10" 
			    		value="<?php echo ( isset($catDetails) ) ? $catDetails->priority : '0' ?>" required />
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="category_input_parent" class="col-lg-3 col-lg-offset-2 control-label">
		    		Parent Category
		    	</label>
			    <div class="col-lg-4">
			    	<select class="form-control" id="category_input_parent" name="category_parent">
	    	          	<option value="0">None</option>
	    	          	<?php foreach ($mainCategories as &$mC) { ?>
	    	          		<option value="<?php echo $mC->id; ?>" <?php if(isset($catDetails)) echo ($mC->id == $catDetails->parent_id ? 'selected' : ''); ?>>
	    	          			<?php echo $mC->name; ?>
	    	          		</option>
	    	          	<?php } ?>
	    	        </select>
			    </div>
		    </div>

		    <legend> Translations </legend>

		    <?php foreach ($languages as &$l) { ?>
		    	<div class="form-group">
			    	<label for="category_input_name_<?php echo $l->short; ?>" class="col-lg-3 col-lg-offset-2 control-label">
			    		Name for <?php echo $l->short; ?> language
			    	</label>
				    <div class="col-lg-4">
				    	<input id="category_input_name_<?php echo $l->short; ?>" class="form-control" 
				    		type="text" min="2" max="45" name="category_name_<?php echo $l->short; ?>" 
				    		value="<?php echo $lang_model->getCategoryTranslation($id, $l->short); ?>" required />
				    </div>
			    </div>
		    <?php } ?>

		    <div class="form-group">
		        <div class="col-lg-7 col-lg-offset-5">
		        	<button type="button" class="btn btn-default"
		        		onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/categories'; ?>'">
		        		<span class="glyphicon glyphicon-chevron-left"></span> Categories
		        	</button>
		        	<button type="submit" class="btn btn-primary">
		        		<?php echo (isset($catDetails)  ? 'Update' : 'Submit' ) ?>
		        	</button>
		        </div>
	        </div>


		</fieldset>
	</form>
</div>