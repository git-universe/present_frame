<div class="container">
	<h2>Translations</h2>
	<hr />

	<ul >
		<?php foreach ($mainTranslations as &$mT) { ?>
			<li>
				<h4 class="text-primary">
					<?php echo $mT->translation?>
					<img src="<?php echo URL.'public/img/flags/'.LANG.'.png'; ?>" height="10px" />
					&nbsp;
					<button type="button" class="btn btn-primary btn-xs" 
						onclick="window.location.href='<?php echo URL . $_SESSION['lang'] . '/admin/translation/' . $mT->id; ?>'">
						<span class="glyphicon glyphicon-pencil"></span>
					</button>
				</h4>

				<ul>
					<?php foreach ($lang_model->getTranslationsForParent($mT->id) as $t) {?>
						<li <?php echo ( is_null($t->translation) ? 'class="text-warning"' : '' ) ?>>
							<?php echo ( !is_null($t->translation) ? $t->translation : 'Not translated' ) ?> - <?php echo $t->short?>
							<img src="<?php echo URL.'public/img/flags/'.$t->short.'.png'; ?>" height="10px" />
							
						</li>
					<?php } ?>
				</ul>

			</li>
		<?php } ?>
	</ul>
</div>