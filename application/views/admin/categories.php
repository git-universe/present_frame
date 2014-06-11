<div id="main" class="container">
	<h1> Categories </h1>
	<button type="button" class="btn btn-success" onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/category/new'; ?>'">
		Add new
	</button>
	<hr/>
	<ul>
		<?php foreach ($categories as &$cat) { 
			if ( is_null($cat->parent_id) ) { ?>
				<li>
					<?php echo $cat->name; ?> &nbsp;
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