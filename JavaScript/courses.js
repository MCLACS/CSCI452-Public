var user;
var courses;
var table;


$(document).on('change', ':checkbox', function(){
  var taken = $('.courseCheckbox').is(':checked');
  var course = $(this).closest('tr')[0];
  course = course.cells[0];
  if(taken)
        taken =  1;
  else
        taken =  0;

  $.ajax({
    url: '/CSCI452-Public/PHP/courses.php?cmd=saveChecked',
    type: 'POST',
    data: 
    {
      'course': course.innerText,
      'taken': taken
    },
    contenttype: "application/json",
    success: function(json){
      console.log("success");
    },
    error:  function(request, status, error) {
      alert(request.responseText);
    }
  });
})

function loadCourses() {

  $.ajax({
    url: '/CSCI452-Public/PHP/courses.php?cmd=loadAll',
    type: 'GET',
    contenttype: "application/json",
    data: {},
    success: function(json){
      user = json.pop();
      $('#name')
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
            if(type == 'display')
              console.log(row);
              if(row.taken == true)
                return '<input type="checkbox" class="courseCheckbox" checked>';
              else
                return '<input type="checkbox" class="courseCheckbox">';
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
