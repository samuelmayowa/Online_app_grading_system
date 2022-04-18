 $(document).ready(function(){
	$('#facs').on('change', function(){
	var course_Id=$('#facs').val();
	$.ajax({
	method:"POST", 
	url:"getDepts.php",
	data:{FacID:course_Id},
	dataType:"html",
	success:function(data){
	 $("#dept").html(data);
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
