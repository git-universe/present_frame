<div id="main" class="container" >
		<h4>Preview</h4>

		<div id="slide_preview" class="well">
			<?php echo (isset($details) ? $details->content : '') ?>
		</div>

		<form method="post" action="" name="slide_form" class="form-horizontal">
			<input name="form_type" type="hidden" value="edit_slide">

			<legend> Edit slide </legend>

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
				    	<textarea id="slide_input_content" name="slide_content" class="form-control" rows="4"><?php echo (isset($details) ? $details->content : '') ?></textarea>
				    </div>
			    </div>

	    	    <div class="form-group">
	    	        <div class="col-lg-7 col-lg-offset-5">
	    	        	<button type="button" class="btn btn-default"
	    	        		onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/presentation/' . (isset($details) ? $details->presentations_id : ''); ?>'">
	    	        		<span class="glyphicon glyphicon-chevron-left"></span> Presentation
	    	        	</button>
	    	        	<button type="submit" class="btn btn-primary">
	    	        		Update
	    	        	</button>
	    	        </div>
	            </div>
			</fieldset>
		</form>
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