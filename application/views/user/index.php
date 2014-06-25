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

	<div class="well well-sm">
	  	<?php echo $lang_model->translate('Profile created ') . $userDetails->create_time ?>
	</div>

	<form method="post" action="" name="editUserForm" class="form-horizontal">
		<input name="form_type" type="hidden" value="editUser">
		<fieldset>
		    <legend>
		    	<?php echo $lang_model->translate('Edit your profile') ?>
		    </legend>

			<div class="form-group">
		    	<label for="login_input_username" class="col-lg-5 control-label">
		    		<?php echo $lang_model->translate('Username (only letters and numbers, 2 to 32 characters)') ?>
		    	</label>
			    <div class="col-lg-7">
			    	<input id="login_input_username" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,32}" name="user_name" required
			    		value="<?php echo $userDetails->username ?>" />
			    </div>
		    </div>
		    
		    <div class="form-group">
		    	<label for="login_input_email" class="col-lg-5 control-label">
		    		<?php echo $lang_model->translate("User's email") ?>
    			</label>
			    <div class="col-lg-7">
			    	<input id="login_input_email" class="form-control" type="email"  name="user_email" required
			    		value="<?php echo $userDetails->email ?>" />
			    </div>
		    </div>

		    <div class="form-group">
		        <div class="col-lg-7 col-lg-offset-5">
		        	<button type="submit" class="btn btn-primary">
		        		<?php echo $lang_model->translate('Update') ?>
		        	</button>
		        </div>
	        </div>

		</fieldset>
	</form>

	<form method="post" action="" name="newPasswordForm" class="form-horizontal">
		<input name="form_type" type="hidden" value="newPassword">
		<fieldset>
		    <legend>
		    	<?php echo $lang_model->translate('Set new password') ?>
		    </legend>

		    <div class="form-group">
		    	<label for="login_input_password_old" class="col-lg-5 control-label">
		    		<?php echo $lang_model->translate('Old password') ?>
	    		</label>
			    <div class="col-lg-7">
			    	<input id="login_input_password_old" class="form-control" type="password"  name="user_password_old" pattern=".{6,}" required autocomplete="off" />
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="login_input_password_new" class="col-lg-5 control-label">
		    		<?php echo $lang_model->translate('Password (min. 6 characters)') ?>
	    		</label>
			    <div class="col-lg-7">
			    	<input id="login_input_password_new" class="form-control" type="password"  name="user_password_new" pattern=".{6,}" required autocomplete="off" />
			    </div>
		    </div>

		    <div class="form-group">
		    	<label for="login_input_password_repeat" class="col-lg-5 control-label">
		    		<?php echo $lang_model->translate('Repeat password') ?>
		    	</label>
			    <div class="col-lg-7">
			    	<input id="login_input_password_repeat" class="form-control" type="password"  name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
			    </div>
		    </div>

		    <div class="form-group">
		        <div class="col-lg-7 col-lg-offset-5">
		        	<button type="submit" class="btn btn-primary">
		        		<?php echo $lang_model->translate('Submit') ?>
		        	</button>
		        </div>
	        </div>

		</fieldset>
	</form>
</div>