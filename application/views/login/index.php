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
		<input name="form_type" type="hidden" value="login">
		<fieldset>
		    <legend>
		    	<?php echo $lang_model->translate('Login') ?>
		    </legend>

			<div class="form-group">
		    	<label for="login_input_username" class="col-lg-3 col-lg-offset-2 control-label">
		    		<?php echo $lang_model->translate('Username') ?>
		    	</label>
			    <div class="col-lg-4">
			    	<input id="login_input_username" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,32}" name="user_name" required />
			    </div>
		    </div>
		    
		    <div class="form-group">
		    	<label for="login_input_password_new" class="col-lg-3 col-lg-offset-2 control-label">
		    		<?php echo $lang_model->translate('Password') ?>
	    		</label>
			    <div class="col-lg-4">
			    	<input id="login_input_password_new" class="form-control" type="password"  name="user_password" pattern=".{6,}" required autocomplete="off" />
			    </div>
		    </div>

		    <div class="form-group">
		        <div class="col-lg-3 col-lg-offset-6">
		        	<button type="submit" class="btn btn-primary">
		        		<?php echo $lang_model->translate('Login') ?>
		        	</button>
		        </div>
	        </div>

		</fieldset>
	</form>
</div>