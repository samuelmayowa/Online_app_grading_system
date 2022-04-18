 $(document).ready(function(){
	$('#payType').on('change', function(){
	var pay_Id=$('#payType').val();
	$.ajax({
	method:"POST", 
	url:"getFees.php",
	data:{PayType:pay_Id},
	dataType:"html",
	success:function(data){
	 $("#fees").html(data);
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
