<div class="container">
	<h1>
		<?php echo $details->name ?>

		<button type="button" class="btn btn-info pull-right"
			onClick="window.location.href='<?php echo URL. '/' .$_SESSION['lang']. '/presentations/presentation/'. $id .'/full'; ?>'">
			View full page
		</button>

	</h1>
	<hr />
	<iframe style="height: 600px;" class="deck-frame col-xs-12" frameborder="0" src="<?php echo URL. '/' .$_SESSION['lang']. '/presentations/presentation/'. $id .'/full'; ?>">
	</iframe>
</div>