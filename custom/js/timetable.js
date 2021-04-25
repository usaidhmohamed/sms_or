var base_url = $("#base_url").val();

$(document).ready(function() {
	$("#topNavTimeTable").addClass('active');

	/*
	*-------------------------------
	* fetches the class section
	* information 	
	*-------------------------------
	*/

	var classSideBar = $(".classSideBar").attr('id');
	var classId = classSideBar.substring(7);

	getClassSection(classId);

}); // /document

/*
*----------------------------
* get class section function
*----------------------------
*/
function getClassSection(classId = null) 
{
	if(classId) {
		$(".list-group-item").removeClass('active');
		$("#classId"+classId).addClass('active');
		$.ajax({
			url: base_url + 'timetable/fetchSubjectTable/' + classId,
			type: 'post',		
			success:function(response) {
				$(".result").html(response);
			} // /success
		}); // /ajax 

        $.ajax({
			url: base_url + 'timetable/fetchTimeTable/' + classId,
			type: 'post',		
			success:function(response) {
				$(".timetable").html(response);
			} // /success
		}); // /ajax 
	}
}