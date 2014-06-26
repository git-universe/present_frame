$(function() {
	$('#commentForm').submit(commentSubmit);
	$('#editCommentForm').submit(commentEdit);

	$('.editComment').click(commentEditModal);
});

function commentSubmit() {
	var form = $(this);
	var data = {
		"type": "insert",
		"userId": form.find('#userId').val(),
		"presentationId": form.find('#presentationId').val(),
		"comment": form.find('#comment').val()
	};

	//console.log(data);

	$.ajax({
		type: 'POST',
		url: '../../ajax/comment',
		data: data,
		headers: {
			'X-Requested-With': 'XMLHttpRequest'
		},
		success: submitSuccess,
		error: submitFail
	});

	return false;
}

function submitSuccess(data) {
	console.log("Comment "+data+" inserted successfuly" );

	var formattedDate = new Date();
	var d = formattedDate.getDate();
	var m =  formattedDate.getMonth();
	m += 1;  // JavaScript months are 0-11
	var y = formattedDate.getFullYear();
	var M = formattedDate.getHours();
	var i = formattedDate.getMinutes();

	var html = "<div id='cmnt-"+data+"' class='text-center well well-sm'> " +
						"<button type='button' class='btn btn-primary btn-sm pull-right editComment'> " +
							"<span class='glyphicon glyphicon-pencil'></span> "+
						"</button> "+
						"<span class='text-primary pull-left'> " +
							M+":"+i+", "+d+". "+m+". "+y + " - <b class='text-info'>" + $('#userName').val() +"</b> : "+
						"</span> "+
						"<p id='"+data+"' class='comment'>" + $('#comment').val() + "</p> " +
				"</div>";

	$("#comments").prepend(html);

	$('#commentForm').get(0).reset();

	$('.editComment').click(commentEditModal);
}

function submitFail() {
	console.log("Failed to insert comment!");
}



function commentEdit() {
	var form = $(this);
	var data = {
		"type": "edit",
		"commentId": form.find("#commentId").val(),
		"comment": form.find("#textComment").val()
	};

	//console.log(data);

	$.ajax({
		type: 'POST',
		url: '../../ajax/comment',
		data: data,
		headers: {
			'X-Requested-With': 'XMLHttpRequest'
		},
		success: editSuccess,
		error: editFail
	});

	return false;
}

function editSuccess(data) {
	var id = $('#commentId').val();
	var comment = $('#textComment').val();
	console.log("Comment "+id+" has been updated!")
	$('#'+id).html(comment);
	$('#editModal').modal('hide');
}

function editFail(data) {
	console.log("Failed to delete comment!");
}

function commentEditModal(btn) {
	var $comment = $(btn.target).parent().find(".comment");
	$('#textComment').val( $comment.text() );
	$('#commentId').val( $comment.attr('id') );

	$('#editModal').modal('show');
}