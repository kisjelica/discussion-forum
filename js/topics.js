$( document ).ready(function() {

	$('#createNewtopic').on('submit','#topicForm', function(event){		
		var formData = $(this).serialize();
		$.ajax({
			url: "action.php",
			method: "POST",              
			data: formData,
			dataType:"json",
			success: function(topicId) {				
				window.location.href ="https://localhost/iteh-domaci-1/post.php?topic_id="+topicId;
			}
        });	
		return false;
	});


});