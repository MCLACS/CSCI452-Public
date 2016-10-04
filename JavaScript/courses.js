function loadCourses() {

  $.ajax({
    url: 'http://localhost/CSCI452-Public/PHP/courses.php?cmd=loadAll',
    type: 'GET',
    contenttype: "application/json",
    data: {},
    success: function(json){
      if(json.length != 0) {
        for(var i = 0; i < json.length; i++) {
          var table = document.getElementById('course_table');
          var row = table.insertRow();
          var courseNum = row.insertCell(0);
          var courseName = row.insertCell(1);
          var coursePre = row.insertCell(2);
          var courseConc = row.insertCell(3);
          courseNum.innerHTML = json[i].course_number;
          courseName.innerHTML = json[i].course_name;
          coursePre.innerHTML = "";
          courseConc.innerHTML = "";
        }
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
