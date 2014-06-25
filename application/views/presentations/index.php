<div class="container">
	<h2>Presentations</h2>
	<hr />

	<div class="panel panel-info">
	  	<div class="panel-heading clickable">
	    	<h3 class="panel-title">Filter presentations</h3>
	    	<span class="pull-right "><i class="glyphicon glyphicon-chevron-down"></i></span>
	  	</div>
	  	<div class="panel-body">
	    	<div class="form-horizontal">
  				<fieldset>
  					<div class="form-group">
			      		<label for="inputName" class="col-lg-2 control-label">Name</label>
			      		<div class="col-lg-10">
        					<input class="form-control" id="inputName" placeholder="Presentation name" type="text">
      					</div>
   					</div>

   					<div class="form-group">
   						<label for="inputDescription" class="col-lg-2 control-label">Description</label>
			      		<div class="col-lg-10">
        					<input class="form-control" id="inputDescription" placeholder="Presentation description" type="text">
      					</div>
   					</div>

   					<div class="form-group">
   						<label for="selectCategory" class="col-lg-2 control-label">Category</label>
			      		<div class="col-lg-10">
					        <select class="form-control" id="selectCategory">
					          	<option value="all">All</option>
					          	<?php foreach ($categories as &$c) { ?>
					          		<option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
					          	<?php } ?>
					        </select>
				     	</div>
   					</div>

   					<div class="form-group">
      					<div class="col-lg-7 col-lg-offset-5">
        					<button onClick="reset()" class="btn btn-default">Reset</button>
        					<button onClick="filter()" class="btn btn-primary">Submit</button>
      					</div>
    				</div>
  				</fieldset>
  			</div>
	  	</div>
	</div>

	<table class="table table-striped table-hover ">
	  	<thead>
	    	<tr>
	      		<th>
	      			Name
	      		</th>
	      		<th>
	      			Description
	      		</th>
	      		<th>
	      			Category
	      		</th>
	      		<th>
	      			Slides count
	      		</th>
	    	</tr>
	  	</thead>
	  	<tbody id="search_result">
	    	
	    </tbody>
	</table>
</div>

<script type="text/javascript">
	var baseLink = "<?php echo URL . $_SESSION['lang'] . '/presentations/' ?>";
	var searchData = <?php echo json_encode($presentations); ?>;
	var filteredData = searchData;

	$(document).ready(function() {
		populateTable(searchData);
	});

	function filter(){
		filteredData = searchData;
		var name = $('#inputName').val();
		var description = $('#inputDescription').val();
		var category = $('#selectCategory').val();

		if(name != '') {
			filteredData = jQuery.grep(filteredData, function( n, i ) {
				return ( n.name.toLowerCase().search(name.toLowerCase()) != -1  );
			});
		}

		if(description != '') {
			filteredData = jQuery.grep(filteredData, function( n, i ) {
				return ( n.desc.toLowerCase().search(description.toLowerCase()) != -1  );
			});
		}

		if(category != 'all') {
			filteredData = jQuery.grep(filteredData, function( n, i ) {
				return ( n.cat_id == category  );
			});
		}

		populateTable(filteredData);
	}

	function reset() {
		$('#inputName').val('');
		$('#inputDescription').val('');
		$('#selectCategory').val('all');
		filteredData = searchData;
		populateTable(filteredData);
	}

	function populateTable(data) {
		$('#search_result').empty();

		$.each(data, function(idx, elem){
	        $("#search_result").append("<tr><td><a href='"+baseLink+"presentation/"+elem.present_id+"'>"+elem.name+"</a></td> " +
	        	"<td>"+elem.desc+"</td> <td>"+elem.category+"</td> <td>"+elem.slides+"</td></tr>");
	    });
	}
</script>

<script src="<?php echo URL; ?>public/js/sliding-panel.js"></script>