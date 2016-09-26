function create() {
  if($('#password').val() == $('#confirmPassword').val()) {
    $.ajax({
      url: 'http://localhost/CSCI452-Public/PHP/create.php?cmd=create',
      type: 'GET',
      contentType: "application/json",
      data: {
        'a_number': $('#aNumber').val(),
        'password': $('#password').val(),
        'f_name': $('#firstName').val(),
        'l_name': $('#lastName').val(),
        'email': $('#email').val()
      },
      success: function(json){
        window.location.assign('http://localhost/CSCI452-Public/Views/index.html');
        console.log("success");
      },
      error:  function() {
        console.log("ajax request failed..");
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
};

$(document).ready(init);
