function login() {

  $.ajax({
    url: 'http://localhost/CSCI452-Public/PHP/login.php?cmd=login',
    type: 'GET',
    contentType: "application/json",
    data: {
      'a_number': $('#aNumber').val(),
      'password': $('#password').val() },
    success: function(json){
      if(json.length != 0)
        console.log(json[0].f_name + " " + json[0].l_name + " login successful");
      else {
        console.log("Incorrect ANumber or Password");
      }
    },
    error:  function() {
      console.log("ajax request failed..");
    }
  });
  
}

function createUser() {

}

function init() {
  $('#login-button').click(login);
  $('#create-user-button').click(createUser);
};

$(document).ready(init);
