function login() {
  $.ajax({
    url: '/CSCI452-Public/PHP/login.php?cmd=login',
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
        $('#edit-button').show();
        $('#create-button').hide();
        $('#csCourses').show();
      }
      else {
        $('#password').val("");
      }
    },
    error:  function(request, status, error) {
      alert(request.responseText);
    }
  });
}

function logout() {

  $.ajax({
    url: '/CSCI452-Public/PHP/login.php?cmd=logout',
    type: 'GET',
    contentType: "application/json",
    data: {},
    success: function(json){
      $('.welcome').hide();
      $('.loginHide').show();
      $('#name').empty();
      $('#password').val("");
      $('#edit-account').hide();
      $('#create-button').show();
      $('#csCourses').hide();
    },
    error:  function(request, status, error) {
      alert(request.responseText);
    }
  });
}

function checkLogin() {
  $.ajax({
    url: '/CSCI452-Public/PHP/login.php?cmd=checkLogin',
    type: 'GET',
    contentType: "application/json",
    data: {},
    success: function(json){
      if(json.length != 0) {
        $('#name').append(json[0].f_name + " " + json[0].l_name);
        $('.welcome').show();
        $('.loginHide').hide();
        $('#create-button').hide();
        $('#csCourses').show();
      }
    },
    error:  function(request, status, error) {
			alert(request.responseText);
    }
  });
}

function edit(){
  window.location.assign('/CSCI452-Public/Views/editAccount.html');
}

function enterLog(e){
  if(e== 13)
      login();
}

function init() {
  checkLogin();
  $('#login-button').click(login);
  $('#logout-button').click(logout);
  $('#edit-button').click(edit);
  $('#csCourses').hide();
  $('.loginField').on("keypress", function(event){
    enterLog(event.which);
})
}

$(document).ready(init);
