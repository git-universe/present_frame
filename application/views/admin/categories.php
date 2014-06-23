<div id="main" class="container">

	<div class="alert alert-dismissable alert-info">
	  	<button type="button" class="close" data-dismiss="alert">×</button>
	  	<strong>Tip</strong> Hover over country flags to see the translated category name.
	</div>

	<h1> 
		Categories 
		<button type="button" class="btn btn-success pull-right" onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/category/new'; ?>'">
			Add new <span class="glyphicon glyphicon-plus"> </span>
		</button>
	</h1>

	

	<hr/>
	<ul>
		<?php foreach ($categories as &$cat) { 
			if ( is_null($cat->parent_id) ) { ?>
				<li>
					<?php echo $cat->name; ?> &nbsp;

					<?php foreach ($cat_model->getCategoryTranslations($cat->id) as $t) { ?>
						 <a href="#" title="<?php echo $t->name . ' - ' . $t->short ?>" class="ttip">
						 	<img src="<?php echo URL.'public/img/flags/'.$t->short.'.png'; ?>" height="10px" />
						 </a>
					<?php } ?>

					&nbsp;
					<button type="button" class="btn btn-primary btn-xs" 
						onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/category/' . $cat->id; ?>'">
						<span class="glyphicon glyphicon-pencil"></span>
					</button>

					<?php if( $cat_model->canBeDeleted($cat->id) ) { ?>
						<button type="button" class="btn btn-danger btn-xs"
							onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/categorydelete/' . $cat->id; ?>'">
							<span class="glyphicon glyphicon-remove"></span>
						</button>
					<?php } ?>

					<ul>
						<?php foreach ($categories as &$c) { 
							if ($c->parent_id == $cat->id) { ?>
								<li>
									<?php echo $c->name; ?> &nbsp;

									<?php foreach ($cat_model->getCategoryTranslations($cat->id) as $t) { ?>
										 <a href="#" title="<?php echo $t->name . ' - ' . $t->short ?>" class="ttip">
										 	<img src="<?php echo URL.'public/img/flags/'.$t->short.'.png'; ?>" height="10px" />
										 </a>
									<?php } ?>

									&nbsp;
									<button type="button" class="btn btn-primary btn-xs" 
										onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/category/' . $c->id; ?>'">
										<span class="glyphicon glyphicon-pencil"></span>
									</button>
									<?php if( $cat_model->canBeDeleted($c->id) ) { ?>
										<button type="button" class="btn btn-danger btn-xs"
											onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/categorydelete/' . $c->id; ?>'">
											<span class="glyphicon glyphicon-remove"></span>
										</button>
									<?php } ?>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
</div>

<script type="text/javascript">
	$(function() {
	    $('.ttip').tooltip();
	});
</script>