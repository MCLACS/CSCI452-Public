function loadCourses() {

  $.ajax({
    url: 'http://localhost/CSCI452-Public/PHP/courses.php?cmd=loadAll',
    type: 'GET',
    contenttype: "application/json",
    data: {},
    success: function(json){
      if(json.length != 0) {
        $('#course_table').DataTable( {
          paging: false,
	        data: json,
	        columns: [
	            { data: 'course_number'},
	            { data: 'course_name' },
	            { data: 'prereq_id' },
	            { data: 'concentration' }
	        ],
		    });
      }
    },
    error:  function() {
      console.log("ajax request failed..");
    }
  });

}

function init() {
  loadCourses();
};

$(document).ready(init);
