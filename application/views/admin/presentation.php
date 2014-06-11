<div id="main" class="container">

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

	<form method="post" action="" name="presentation_form" class="form-horizontal">
		<input name="form_type" type="hidden" value="<?php echo ($id == 'new' || $id == null ? 'new' : 'edit') ?>_presentation">
		<fieldset>
		    <legend> <?php echo ($id == 'new' || $id == null ? 'New Presenation' : 'Edit presentation'); ?> </legend>

			<div class="form-group">
		    	<label for="present_input_name" class="col-lg-3 col-lg-offset-1 control-label">
		    		Name
		    	</label>
			    <div class="col-lg-5">
			    	<input id="present_input_name" class="form-control" type="text" pattern=".{2,32}" name="present_name"
			    		value="<?php echo (isset($details) ? $details->name : '') ?>" required />
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="present_input_desc" class="col-lg-3 col-lg-offset-1 control-label">
		    		Description
		    	</label>
			    <div class="col-lg-5">
			    	<textarea id="present_input_desc" name="present_desc" class="form-control" rows="4"><?php echo (isset($details) ? $details->desc : '') ?></textarea>
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="category_input_priority" class="col-lg-3 col-lg-offset-1 control-label">
		    		Priority
		    	</label>
			    <div class="col-lg-1">
			    	<input id="present_input_priority" class="form-control" type="number" name="present_priority" 
			    		step="1" max="10" min="-10" 
			    		value="<?php echo (isset($details) ? $details->order : '0') ?>" required />
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="present_input_category" class="col-lg-3 col-lg-offset-1 control-label">
		    		Category
		    	</label>
			    <div class="col-lg-5">
			    	<select class="form-control" id="present_input_category" name="present_category">
	    	          	<?php foreach ($categories as &$c) { ?>
	    	          		<option value="<?php echo $c->id; ?>" <?php if(isset($details)) echo ($c->id == $details->categories_id ? 'selected' : ''); ?>>
	    	          			<?php echo $c->name; ?>
	    	          		</option>
	    	          	<?php } ?>
	    	        </select>
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="present_input_language" class="col-lg-3 col-lg-offset-1 control-label">
		    		Language
		    	</label>
			    <div class="col-lg-5">
			    	<select class="form-control" id="present_input_language" name="present_language">
	    	          	<?php foreach ($languages as &$l) { ?>
	    	          		<option value="<?php echo $l->id; ?>" <?php if(isset($details)) echo ($l->id == $details->languages_id ? 'selected' : ''); ?>>
	    	          			<?php echo $l->short; ?>
	    	          		</option>
	    	          	<?php } ?>
	    	        </select>
			    </div>
		    </div>

		    <div class="form-group">
		        <div class="col-lg-7 col-lg-offset-5">
		        	<button type="button" class="btn btn-default"
		        		onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/presentations'; ?>'">
		        		<span class="glyphicon glyphicon-chevron-left"></span> Presentations
		        	</button>
		        	<button type="submit" class="btn btn-primary">
		        		<?php echo (isset($catDetails)  ? 'Update' : 'Submit' ) ?>
		        	</button>
		        </div>
	        </div>


		</fieldset>
	</form>

	<?php if( $id != null && $id != 'new') { ?>
		
		<h2>Slides</h2>
		<hr />

		<?php foreach ($slides as &$s) { ?>
			<div class="panel panel-default">
			  	<div class="panel-body">
			    	<?php echo $s->content; ?>
			  	</div>
			  	<div class="panel-footer">
			  		<span class="label label-info">Priority: <?php echo $s->order; ?> </span> &nbsp;
			  		<button type="button" class="btn btn-primary btn-xs"
			  			onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/slide/' . $s->id; ?>'" >
			  			Edit
			  		</button>
			  		<button type="button" class="btn btn-danger btn-xs"
			  			onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/slide/' . $s->id . '/delete'; ?>'" >
			  			Delete
			  		</button>
			  	</div>
			</div>
		<?php } ?>
		
		<h3>New slide</h3>
		<hr />

		<h4>Preview</h4>

		<div id="slide_preview" class="well"></div>
		<hr />

		<form method="post" action="" name="slide_form" class="form-horizontal">
			<input name="form_type" type="hidden" value="new_slide">

			<fieldset>
			    <div class="form-group">
		        	<label for="slide_input_priority" class="col-lg-3 col-lg-offset-3  control-label">
		        		Priority
		        	</label>
		    	    <div class="col-lg-1">
		    	    	<input id="slide_input_priority" class="form-control" type="number" name="slide_priority" 
		    	    		step="1" max="20" min="-20" 
		    	    		value="<?php echo (isset($details) ? $details->order : '') ?>" required />
		    	    </div>
		        </div>

			    <div class="form-group">
			    	<label for="slide_input_content" class="col-lg-3  control-label">
			    		Content
			    	</label>
				    <div class="col-lg-7">
				    	<textarea id="slide_input_content" name="slide_content" class="form-control" rows="4"></textarea>
				    </div>
			    </div>

	    	    <div class="form-group">
	    	        <div class="col-lg-6 col-lg-offset-6">
	    	        	<button type="submit" class="btn btn-primary">
	    	        		<?php echo (isset($catDetails)  ? 'Update' : 'Submit' ) ?>
	    	        	</button>
	    	        </div>
	            </div>
			</fieldset>
		</form>
	<?php } ?>
</div>

<script>
	var textarea = document.getElementById('slide_input_content');
	var myCodeMirror = CodeMirror.fromTextArea( textarea, {
		lineNumbers: true,
	  	mode:  "xml",
	  	theme: 'monokai',
	  	value: ''
	} );

	myCodeMirror.on("keyup", function(cm, event) {
        $("#slide_preview").html(myCodeMirror.getValue());        
    });
</script>