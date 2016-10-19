function create() {
  var form = $('#accountInfo');
  var formData = $(form).serialize();

  if($('#password').val() == $('#confirmPassword').val()) {
    $.ajax({
      url: 'http://localhost/CSCI452-Public/PHP/create.php?cmd=create',
      type: 'GET',
      contentType: "application/json",
      data: formData,
      success: function(json){
        window.location.assign('http://localhost/CSCI452-Public/Views/index.html');
        console.log("success");
      },
      error:  function(request, status, error) {
        alert(request.responseText);
        $('#confirmPassword').val("");
      }
    });
  }
  else {
    $('#confirmPassword').val("");
  }
}

function init() {
  $('#submit-button').click(create);
}

$(document).ready(init);
