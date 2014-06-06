<div id="main" class="container">
	<h1> Home pages </h1>

	<table class="table table-striped table-hover ">
	  	<thead>
	    	<tr class="success">
	      		<th>Hompage title</th>
	      		<th>Content (250 chars)</th>
	      		<th>Language</th>
	      		<th>Flag</th>
	      		<th>Options</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  		<?php foreach ($pages as &$p) { ?>
		    	<tr <?php if ($p->page_name == 'N/A' ) echo 'class="warning"'; ?> >
		      		<td>
		      			<?php echo $p->page_name; ?>
		      		</td>
		      		<td>
		      			
			      			<?php echo htmlSpecialChars( (strlen($p->content) > 253) ? substr($p->content,0,250).'...' : $p->content); ?>
		      			
		      		</td>
		      		<td>
		      			<?php echo $p->lang_name.' - '.$p->short; ?>
		      		</td>
		      		<td>
		      			<img src="<?php echo URL."public/img/flags/".$p->short.".png"; ?>" height="18px" />
		      		</td>
		      		<td>
		      			<?php if( $p->id != 0 ) { ?>
		      				<a href="<?php echo URL . $_SESSION['lang'] . '/admin/page/' . $p->id; ?>" >
		      					Edit
		      				</a>
		      			<?php } else { ?>
		      				<a href="<?php echo URL . $_SESSION['lang'] . '/admin/page/' . $p->id . '/' . $p->short; ?>" >
		      					Add
		      				</a>
		      			<?php } ?>
		      		</td>
		    	</tr>
	    	<?php } ?>
	  	</tbody>
	</table>
</div>