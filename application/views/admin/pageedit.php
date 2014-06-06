

<div id="main" class="container">

	<?php if (isset($error)) { ?>
		<div class="alert alert-dismissable alert-danger">
		  <button type="button" class="close" data-dismiss="alert">×</button>
		  <?php echo $error ?>
		</div>
	<?php } ?>

	<h1> Edit page </h1>

	<h3> Preview </h3>
	<hr />
	<div id="preview">
		<?php echo $content; ?>
	</div>


	<form method="post" action="" name="loginform" class="form-horizontal">
		<input name="form_type" type="hidden" value="<?php echo $formType; ?>">
		<?php if($formType == "page_new") { ?>
			<input name="page_language" type="hidden" value="<?php echo $lang; ?>">
		<?php } ?>
		<fieldset>
		    <legend>
		    	Language <?php echo $lang; ?>
		    </legend>

			<div class="form-group">
		    	<label for="page_title" class="control-label">
		    		Title
		    	</label>
			    <div class="">
			    	<input id="page_title" class="form-control" type="text" name="page_title" value="<?php echo $title ?>" required />
			    </div>
		    </div>
		    
		    <div class="form-group">
		    	<label for="page_content" class="control-label">
		    		Content
	    		</label>
			    <div class="">
			    	<textarea id="page_content" name="page_content" class="form-control" rows="3"><?php echo $content ?></textarea>
			    </div>
		    </div>

		    <div class="form-group">
		        <div class="col-lg-2 col-lg-offset-5">
		        	<button type="submit" class="btn btn-primary">
		        		Submit
		        	</button>
		        </div>
	        </div>

		</fieldset>
	</form>
</div>

<script>
	var textarea = document.getElementById('page_content');
	var myCodeMirror = CodeMirror.fromTextArea( textarea, {
		lineNumbers: true,
	  	mode:  "xml",
	  	theme: 'monokai',
	  	value: ''
	} );

	myCodeMirror.on("keyup", function(cm, event) {
        $("#preview").html(myCodeMirror.getValue());        
    });
</script>