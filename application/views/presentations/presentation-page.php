<div class="container">
	<h1>
		<?php echo $details->name ?>


		<span class="pull-right">
			<button type="button" class="btn btn-default"
				onClick="window.history.back()">
				<span class="glyphicon glyphicon-chevron-left"></span>
				Go back
			</button>

			<button type="button" class="btn btn-primary"
				onClick="window.location.href='<?php echo URL. '/' .$_SESSION['lang']. '/presentations/presentation/'. $id .'/full'; ?>'">
				View full page &nbsp;
				<span class="glyphicon glyphicon-resize-full"></span>
			</button>
		</span>
	</h1>
	<hr />
	<iframe style="height: 600px;" class="deck-frame col-xs-12" frameborder="0" src="<?php echo URL. '/' .$_SESSION['lang']. '/presentations/presentation/'. $id .'/full'; ?>">
	</iframe>
</div>

<script type="text/javascript">
	$( document ).ready( function() {
		resizeFrame();
	} );

	$( window ).resize( function() {
		resizeFrame();
	} );

	function resizeFrame() {
	    $( '.deck-frame' ).css('height', $('.deck-frame').contents().width() * 0.7 | 0);
	}
</script>