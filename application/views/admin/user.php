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
		  	<?php echo 'Profile created: ' . $userDetails->create_time ?>
		</div>

		<form method="post" action="" name="editUserForm" class="form-horizontal">
			<input name="form_type" type="hidden" value="editUser">
			<fieldset>
			    <legend>
			    	Edit user

	      			<button type="button" class="btn btn-default btn-sm pull-right" 
						onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/users' ?>'">
						<span class="glyphicon glyphicon-chevron-left"> </span>
						View all users
					</button>
			    </legend>

				<div class="form-group">
			    	<label for="login_input_username" class="col-lg-5 control-label">
			    		Username (only letters and numbers, 2 to 32 characters)
			    	</label>
				    <div class="col-lg-7">
				    	<input id="login_input_username" class="form-control" type="text" pattern="[a-zA-Z0-9]{2,32}" name="user_name" required
				    		value="<?php echo $userDetails->username ?>" />
				    </div>
			    </div>
			    
			    <div class="form-group">
			    	<label for="login_input_email" class="col-lg-5 control-label">
			    		User's email
	    			</label>
				    <div class="col-lg-7">
				    	<input id="login_input_email" class="form-control" type="email"  name="user_email" required
				    		value="<?php echo $userDetails->email ?>" />
				    </div>
			    </div>

			    <div class="form-group">
			    	<div class="col-lg-7 col-lg-offset-5">
    				    <div class="checkbox">
    		              	<label>
    		                	<input name="checkAdmin" type="checkbox" <?php echo ($userDetails->admin == true ? 'checked' : '' )?> > 
    		                	Set role administrator
    		              	</label>
    		            </div>

    		            <div class="checkbox">
    		              	<label>
    		                	<input name="checkDisabled" type="checkbox" <?php echo ($userDetails->disabled == true ? 'checked' : '' )?> >
    		                	Set user disabled (User wont be able to log in...)
    		              	</label>
    		            </div>
			    	</div>
			    </div>

			    <div class="form-group">
			        <div class="col-lg-7 col-lg-offset-5">
			        	<button type="submit" class="btn btn-primary">
			        		Update
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