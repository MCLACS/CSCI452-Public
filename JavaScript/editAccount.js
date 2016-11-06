function editAccount(){
	if($('#password').val() == $('#confirmPassword').val()) {
		$.ajax({
			url: '/CSCI452-Public/PHP/edit.php?cmd=edit',
			type: 'GET',
			contentType: "application/json",
			data: {
				'password': $('#password').val(),
				'f_name': $('#firstName').val(),
				'l_name': $('#lastName').val(),
				'email': $('#email').val()
			},
			success: function(json){
				window.location.assign('/CSCI452-Public/Views/index.html');
				console.log("success");
			},
			error:  function(request, status, error) {
				alert(request.responseText);
				$('#confirmPassword').val("");
			}
		});
	}
}

function deleteAccount(){
	$.ajax({
		url: '/CSCI452-Public/PHP/edit.php?cmd=delete',
		type: 'DELETE',
		contentType: "application/json",
		success: function(json){
			window.location.assign('/CSCI452-Public/Views/index.html');
			console.log("success");
		},
		error:  function(request, status, error) {
			alert(request.responseText);
		}
	});
}

function getAccount()
{
	$.ajax({
		url: '/CSCI452-Public/PHP/edit.php?cmd=account',
		contentType: "application/json",
		success: function(json){
			$('#firstName').val(json[0].f_name);
			$('#lastName').val(json[0].l_name);
			$('#email').val(json[0].email);
			console.log("success");
		},
		error:  function(request, status, error) {
			alert(request.responseText);
		}
	});
}

function init() {
	getAccount();
	$('#submit-button').click(editAccount);
	$('#delete-button').click(deleteAccount);
};

$(document).ready(init);
