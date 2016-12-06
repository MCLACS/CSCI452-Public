var element = "";

function displayFields() {
  $(element).hide();
  element = "#" + $('#action').val().toLowerCase() + "-" + $('#type').val().toLowerCase();
  $(element).show();
  console.log(element);
};

function submitForm() {
  var cmd = $("#action").val() + $("#type").val();
  
  var form = $('#contentInfo');
  var formData = $(form).serialize();

  $.ajax({
    url: '/CSCI452-Public/PHP/createCourse.php?cmd=' + cmd,
    type: 'GET',
    contentType: "application/json",
    data: formData,
    success: function(json){
      window.location.assign('/CSCI452-Public/Views/index.html');
      console.log("success");
    },
    error:  function(request, status, error) {
      alert(request.responseText);
    }
  });
}

function init() {
  $('#submit-button').click(submitForm);
  $('#action').change(displayFields);
  $('#type').change(displayFields);
};

$(document).ready(init);
