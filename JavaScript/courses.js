var courses;
var table;

function loadCourses() {

  $.ajax({
    url: 'http://localhost/CSCI452-Public/PHP/courses.php?cmd=loadAll',
    type: 'GET',
    contenttype: "application/json",
    data: {},
    success: function(json){
      courses = json;
      table = $('#course_table').DataTable( {
        paging: false,
        data: json,
        columns: [
          { data: 'course_number'},
          { data: 'course_name' },
          { data: 'prerequisite' },
          { data: 'concentration' }
        ],
      });
    },
    error:  function() {
      console.log("ajax request failed..");
    }
  });

}
function filter(){
  var val=$("#dropMenu").val();
  if(val == "All") {
    buildTable(courses);
  }
  else {
    var filteredCourses = new Array();
    for(var i=0;i<courses.length;i++)
    {
      if(courses[i].concentration == val)
      {
        filteredCourses.push(courses[i]);
      }
    }
    buildTable(filteredCourses);
  }
}

function buildTable(data) {
  table.destroy();
  var tempTable = $('#course_table').DataTable( {
    paging: false,
    data: data,
    columns: [
      { data: 'course_number'},
      { data: 'course_name' },
      { data: 'prerequisite' },
      { data: 'concentration' }
    ],
  });
  table = tempTable;
}

function init() {
  loadCourses();
  $("#dropMenu").on('change', filter);
};

$(document).ready(init);
