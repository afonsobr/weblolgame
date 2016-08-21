function login() {
	$("#msgbox").removeClass().addClass("alert alert-info").text("Validando...").fadeIn(1000);
	$.ajax({
		url: "scripts/php/validation.php",
		type: "POST",
		data: {
			username: $('#loginUsername').val(),
			password: $("#loginPassword").val()
		},
		dataType: 'json',
		success: function (data) {
			if (data == 1) {
        $("#LoginButton").toggle();
				$("#msgbox").fadeTo(200, 1, function () {
					$(this).html("Logando...").addClass("alert alert-success").fadeTo(900, 1, function () {
						//location.reload();
            buildPage();
					});
				});
			} else {
				$("#msgbox").fadeTo(200, 1, function () {
					$(this).html("Usuário e/ou senha incorretos.").addClass("alert alert-danger");
				});
			}
		}
	});
}

function logout()
{
  $.ajax(
  {
    url: "scripts/php/logout.php",
    type: "POST",
    data: {},
    dataType: 'json',
    success: function(data)
    {
      //alert("Volte Sempre!");
      location.reload();
    }
  });
}