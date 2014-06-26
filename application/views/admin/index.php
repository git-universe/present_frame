<div id="main" class="container">
	<h1> <?php echo $lang_model->translate('Administration panel') ?> </h1>

	<div class="list-group col-lg-5 col-lg-offset-3">
		<a href="<?php echo URL . $_SESSION['lang']; ?>/admin/pages" class="list-group-item">
	    	Edit pages
	 	</a>
	 	<a href="<?php echo URL . $_SESSION['lang']; ?>/admin/categories" class="list-group-item">
	    	Edit categories
	 	</a>
	 	<a href="<?php echo URL . $_SESSION['lang']; ?>/admin/presentations" class="list-group-item">
	    	Edit presentations
	 	</a>
	 	<a href="<?php echo URL . $_SESSION['lang']; ?>/admin/users" class="list-group-item">
	    	Edit users
	 	</a>
	 	<a href="<?php echo URL . $_SESSION['lang']; ?>/admin/translations" class="list-group-item">
	    	Edit UI translations
	 	</a>
	</div>
</div>