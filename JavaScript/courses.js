var user;
var courses;
var table;

$(document).on("click", ".courseCheckbox", function()
{
  var courseNumber = $(this).attr('courseNum');
  // alert(row);
  var checked = $(this).is(":checked");
  $.ajax({
        url: "http://localhost/CSCI452-Public/PHP/courses.php?cmd=saveChecked&checked=" + checked + "&courseNumber=" + courseNumber,
    type: 'POST',
    contenttype: "application/json",
    success: function(json){
      console.log("success");
    },
    error:  function(request, status, error) {
      alert(request.responseText);
    }
  });
});

function loadCourses() {

  $.ajax({
    url: 'http://localhost/CSCI452-Public/PHP/courses.php?cmd=loadAll',
    type: 'GET',
    contenttype: "application/json",
    data: {},
    success: function(json){
      user = json.pop();
      $('#name').append(user.f_name + " " + user.l_name);
      courses = json;
      table = $('#course_table').DataTable( {
        paging: false,
        data: courses,
        columns: [
        { data: 'course_number'},
        { data: 'course_name' },
        { data: 'prerequisite' },
        { data: 'concentration' },
          { // populate table with checkboxes
           data: 'taken',
           render: function(data, type, row)
           {
             console.log(row);
             if(type == 'display')
               return '<input type="checkbox" courseNum="'+row.course_number+'" class="editor-active courseCheckbox">';

             return row;
           }
         }],
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
    for(var i = 0; i < courses.length; i++)
    {
      if(courses[i].concentration.includes(val))
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
