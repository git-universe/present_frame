<div  id="main" class="container">
	<h1>
		Presentations

		<button type="button" class="btn btn-success pull-right" 
			onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/presentation/new'; ?>'">
			Add new presentation <span class="glyphicon glyphicon-plus"> </span>
		</button>
	</h1>
	<hr/>

	<?php foreach ($mainCategories as &$cat) { ?>
		<div class="panel panel-primary">
		  	<div class="panel-heading">
				<h3 class="panel-title">
					<?php echo $cat->name; ?>
				</h3>
			</div>
			<div class="panel-body">

				<?php if($cat->has_presentations) { ?>
					<ul>
						<?php foreach ($languages as &$l) { ?>
							<li>
								<h5>
									<img src="<?php echo URL."public/img/flags/".$l->short.".png"; ?>" height="14px" />
									Presentations in <?php echo $l->short ?>
								</h5>
								
								<ul>
									<?php $presentations = $present_model->getPresentations($cat->id, $l->id); ?>
									<?php foreach ($presentations as $p) { ?>
							  			<li>
							  				<a href="<?php echo URL . $_SESSION['lang'] . '/presentations/presentation/' . $p->id; ?>">
							  					<?php echo $p->name; ?>
							  				</a>
							  				<button type="button" class="btn btn-primary btn-xs" 
							  					onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/presentation/' . $p->id; ?>'">
							  					<span class="glyphicon glyphicon-pencil"></span>
							  				</button>
							  				
						  					<button type="button" class="btn btn-danger btn-xs"
						  						onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/presentation_delete/' . $p->id; ?>'">
						  						<span class="glyphicon glyphicon-remove"></span>
						  					</button>
							  			</li>
							  		<?php } ?>

							  		<?php if( !(count($presentations) > 0) ) { ?>
							  			<li class="text-warning">
							  				Empty
							  			</li>
							  		<?php } ?>
							  	</ul>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>

				<?php foreach ($categories as &$c) { 
					if ($c->parent_id == $cat->id) { ?>
						
						<div class="panel panel-default">
							<div class="panel-heading clickable">
								<h3 class="panel-title "><?php echo $c->name; ?></h3>
								<span class="pull-right "><i class="glyphicon glyphicon-chevron-down"></i></span>
							</div>

							<div class="panel-body">
								<ul>
									<?php foreach ($languages as &$l) { ?>
										<li>
											<h5>
												<img src="<?php echo URL."public/img/flags/".$l->short.".png"; ?>" height="14px" />
												Presentations in <?php echo $l->short ?>
											</h5>
											
											<ul>
												<?php $presentations = $present_model->getPresentations($c->id, $l->id); ?>
												<?php foreach ($presentations as $p) { ?>
										  			<li>
										  				<a href="<?php echo URL . $_SESSION['lang'] . '/presentations/presentation/' . $p->id; ?>">
										  					<?php echo $p->name; ?>
										  				</a>
										  				<button type="button" class="btn btn-primary btn-xs" 
										  					onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/presentation/' . $p->id; ?>'">
										  					<span class="glyphicon glyphicon-pencil"></span>
										  				</button>
										  				
									  					<button type="button" class="btn btn-danger btn-xs"
									  						onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/presentation_delete/' . $p->id; ?>'">
									  						<span class="glyphicon glyphicon-remove"></span>
									  					</button>
										  			</li>
										  		<?php } ?>
										  		<?php if( !(count($presentations) > 0) ) { ?>
										  			<li class="text-warning">
										  				Empty
										  			</li>
										  		<?php } ?>
										  	</ul>
										</li>
									<?php } ?>
								</ul>
			              	</div>

						</div>

					<?php } ?>
				<?php } ?>

			</div>
		</div>

		<hr/>

	<?php } ?>
</div>