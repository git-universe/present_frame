<div class="container">
	<h2>Users</h2>
	<hr />

	<div class="panel panel-default">
	  	<div class="panel-heading clickable">
	    	<h3 class="panel-title">Filter users</h3>
	  	</div>
	  	<div class="panel-body">
	    	<form class="form-horizontal" method="POST">
	    		<input type="hidden" name="form_type" value="filter_users"> </input>
  				<fieldset>
  					<div class="form-group">
			      		<label for="inputName" class="col-lg-2 control-label">Username</label>
			      		<div class="col-lg-10">
        					<input class="form-control input-sm" id="inputName" name="inputName" placeholder="Username" type="text" 
        						value="<?php echo $username?>">
      					</div>
   					</div>

   					<div class="form-group">
   						<label for="inputEmail" class="col-lg-2 control-label">Email</label>
			      		<div class="col-lg-10">
        					<input class="form-control input-sm" id="inputEmail" name="inputEmail" placeholder="Users email" type="text"
        						value="<?php echo $email?>">
      					</div>
   					</div>

   					<div class="form-group">
   						<label for="selectAdmin" class="col-lg-2 control-label">Admin</label>
			      		<div class="col-lg-10">
					        <select class="form-control input-sm" id="selectAdmin" name="selectAdmin">
					          	<option value="-1">All</option>
					          	<option <?php echo $isAdmin == 1 ? 'selected' : ''?> value="1">Yes</option>
					          	<option <?php echo $isAdmin == 0 ? 'selected' : ''?> value="0">No</option>
					        </select>
				     	</div>
   					</div>

   					<div class="form-group">
   						<label for="selectDisabled" class="col-lg-2 control-label">Disabled</label>
			      		<div class="col-lg-10">
					        <select class="form-control input-sm" id="selectDisabled" name="selectDisabled">
					          	<option value="-1">All</option>
					          	<option <?php echo $isDisabled == 1 ? 'selected' : ''?> value="1">Yes</option>
					          	<option <?php echo $isDisabled == 0 ? 'selected' : ''?> value="0">No</option>
					        </select>
				     	</div>
   					</div>

   					<div class="form-group">
      					<div class="col-lg-7 col-lg-offset-5">
        					<button type="reset" class="btn btn-default btn-sm">Reset</button>
        					<button type="submit" class="btn btn-primary btn-sm">Submit</button>
      					</div>
    				</div>
  				</fieldset>
  			</form>
	  	</div>
	</div>

	<table class="table table-striped table-hover ">
	  	<thead>
	    	<tr>
	      		<th>Id</th>
	      		<th>Username</th>
	      		<th>Email</th>
	      		<th>Registered date</th>
	      		<th>Admin</th>
	      		<th>Disabled</th>
	      		<th class="text-right">Options</th>
	    	</tr>
	  	</thead>
	  	<tbody>
			<?php foreach ($users as &$u) { ?>
				<tr class="<?php if ($u->admin == '1' ) echo 'info '; if ($u->disabled == '1' ) echo 'warning'; ?> " >
		      		<td>
		      			<?php echo $u->id; ?>
		      		</td>
		      		<td>
		      			<?php echo $u->username; ?>
		      		</td>
		      		<td>
		      			<?php echo $u->email; ?>
		      		</td>
		      		<td>
		      			<?php echo $u->create_time; ?>
		      		</td>
		      		<td>
		      			<?php echo $u->admin; ?>
		      		</td>
		      		<td>
		      			<?php echo $u->disabled; ?>
		      		</td>
		      		<td class="text-right">
		      			<button type="button" class="btn btn-primary btn-xs" 
							onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/user/' . $u->id; ?>'">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
		      		</td>
		    	</tr>
			<?php } ?>
		</tbody>
	</table>
</div>