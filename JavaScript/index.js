function login() {
console.log($('#aNumber').val());
console.log($('#password').val());
  $.ajax({
    url: 'http://localhost/CSCI452-Public/PHP/login.php?cmd=login',
    type: 'GET',
    contentType: "application/json",
    data: {
      'a_number': $('#aNumber').val(),
      'password': $('#password').val() },
    success: function(json){
      if(json.length != 0) {
        $('#name').append(json[0].f_name + " " + json[0].l_name);
        $('.welcome').show();
        $('.loginHide').hide();
      }
      else {
        $('#password').val("");
      }
    },
    error:  function() {
      console.log("ajax request failed..");
    }
  });

}

function logout() {
  $('.welcome').hide();
  $('.loginHide').show();
  $('#name').empty();
}

function init() {
  $('#login-button').click(login);
  $('#logout-button').click(logout);
};

$(document).ready(init);
