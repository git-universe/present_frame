<div class="container">
	<h1>Presentations</h1>
	<hr/>

	<?php foreach ($categories as &$cat) { 
		if ( is_null($cat->parent_id) ) { ?>
			<h2>
				<?php echo $cat->name; ?>
			</h2>

			<?php foreach ($categories as &$c) { 
				if ($c->parent_id == $cat->id) { ?>
					
					<div class="panel panel-default">
						<div class="panel-heading clickable">
							<h3 class="panel-title "><?php echo $c->name; ?></h3>
							<span class="pull-right "><i class="glyphicon glyphicon-chevron-down"></i></span>
						</div>
						<div class="panel-body">
		                	<ul>
		                  		<li>Presentation1</li>
		                  		<li>Presentation1</li>
		                  	</ul>
		              	</div>
					</div>

				<?php } ?>
			<?php } ?>

			<hr/>

		<?php } ?>
	<?php } ?>
</div>

<script src="<?php echo URL; ?>public/js/sliding-panel.js"></script>