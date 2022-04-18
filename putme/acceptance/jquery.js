 $(document).ready(function(){
	$('#CourseCode').on('change', function(){
	var course_Id=$('#CourseCode').val();
	$.ajax({
	method:"POST", 
	url:"getPay.php",
	data:{CourseID:course_Id},
	dataType:"html",
	success:function(data){
	 $("#CourseName").html(data);
	}
	});
});


$('#CourseCode').on('change', function(){
	var course_Units=$('#CourseCode').val();
	$.ajax({
	method:"POST", 
	url:"getPay.php",
	data:{CourseTitleID:course_Units},
	dataType:"html",
	success:function(data){
	 $("#courseUnits").html(data);
	}
	});
});

});
