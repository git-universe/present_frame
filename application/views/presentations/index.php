<div class="container">
	<?php foreach ($categories as &$cat) { 
		if ( is_null($cat->parent_id) ) { ?>
			<h2>
				<?php echo $cat->name; ?>
			</h2>

			<ul>
          		<?php $presentations = $present_model->getPresentations($cat->id, $_SESSION['lang']); ?>
          		<?php foreach ($presentations as &$p) { ?>
          			<li>
	          			<a href="<?php echo URL . $_SESSION['lang'] . '/presentations/presentation/' . $p->id;?>">
	          				<?php echo $p->name ?>
	      				</a>
	      			</li>
          		<?php } ?>
          	</ul>

			<?php foreach ($categories as &$c) { ?>
				<?php $presentations = $present_model->getPresentations($c->id, $_SESSION['lang']); ?>
				<?php if ( $c->parent_id == $cat->id && count($presentations) > 0 ) { ?>
					
					<div class="panel panel-default">
						<div class="panel-heading clickable">
							<h3 class="panel-title "><?php echo $c->name; ?></h3>
							<span class="pull-right "><i class="glyphicon glyphicon-chevron-down"></i></span>
						</div>
						<div class="panel-body">
		                	<ul>
		                  		<?php foreach ($presentations as &$p) { ?>
			                  		<li>
			                  			<a href="<?php echo URL . $_SESSION['lang'] . '/presentations/presentation/' . $p->id;?>">
			                  				<?php echo $p->name ?>
		                  				</a>
		                  			</li>
		                  		<?php } ?>
		                  	</ul>
		              	</div>
					</div>

				<?php }  ?>
			<?php } ?>

			<hr/>

		<?php } ?>
	<?php } ?>
</div>

<script src="<?php echo URL; ?>public/js/sliding-panel.js"></script>