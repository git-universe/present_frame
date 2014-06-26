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

	<div class="clearfix"></div>

	<?php if(isset($_SESSION['username'])) { ?>
		<hr>
		<div class="row">
			<form class="form-horizontal" id="commentForm" action="" >
				<input type="hidden" name="userId" id="userId" value="<?php echo $_SESSION['userId']?>">
				<input type="hidden" name="userName" id="userName" value="<?php echo $_SESSION['username']?>">
				<input type="hidden" name="presentationId" id="presentationId" value="<?php echo $id?>">

				<fieldset>
					<div class="form-group text-center col-lg-2" > <!-- Submit -->
				       	<button type="submit" class="btn btn-primary">
				       		<?php echo $lang_model->translate('Comment') ?>
				       	</button>
				    </div><!-- /Submit -->

				    <div class="form-group col-lg-10"> <!-- Description -->
							<textarea class="form-control" name="comment" placeholder="<?php echo $lang_model->translate('Comment') ?>..." 
								rows="2" id="comment" required ></textarea>
					</div>
				</fieldset>
			</form>
		</div>
		<?php }?>

		<div id="comments">
			<?php foreach ($comments as &$c) { ?>
			<div class="text-center well well-sm" id="cmnt-<?php echo $c->id?>">
					<?php if(isset($_SESSION['username']) && $c->username == $_SESSION['username']) { ?>
						<button type="button" class="btn btn-primary btn-sm pull-right editComment">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>
					<?php } ?>

					<span class="text-primary pull-left"><?php echo date("H:i, d. m. Y", strtotime($c->posted))?> - <b class="text-info"><?php echo $c->username?></b> :</span>
					
					<p id="<?php echo $c->id?>" class="comment"> <?php echo $c->comment?> </p>
			</div>
			<?php } ?>
		</div>

	
</div>

<?php if( isset($_SESSION['username']) ) { ?>
	<!-- Modal -->
	<div class="modal fade" id="editModal" role="dialog" aria-labelledby="editComment" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="editComment">
						<?php echo $lang_model->translate('Edit comment') ?>
					</h4>
				</div>

				<form class="form-horizontal" id="editCommentForm" action="">
					<input type="hidden" id="commentId" name="commentId" value="">

					<div class="modal-body">
						<fieldset>
							<textarea class="form-control" id="textComment" name="textComment" placeholder="<?php echo $lang_model->translate('Comment') ?>..." 
								rows="2"required ></textarea>
						</fieldset>
						
						<button type="submit" class="btn btn-primary col-sm-offset-5">
							<?php echo $lang_model->translate('Update') ?>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php }?>

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

<script src="<?php echo URL; ?>public/js/comments.js"></script>