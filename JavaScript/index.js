$(document).ready(function() {
  $('#login-button').click(function(){

    $.ajax({
      url: '/PHP/login.php',
      type: 'POST',
      data: {
        'id': $('#aNumber').val(),
        'password': $('#password').val() },
      success: function(response){
        $('body').append(response);
      }
    });

  });
});
