function getMessage(messageID) {
  var message = "";
  messageID = parseInt(messageID);
  switch (messageID) {
    case 0:
      message = "Você precisa aceitar os Termos e Condições.";
      break;

    case 1:
      message = "As senhas diferem.";
      break;

    case 2:
      message = "O Usuário precisa ter de 4 a 12 caracteres.";
      break;

    case 3:
      message = "A Senha precisa ter de 4 a 12 caracteres.";
      break;

    case 4:
      message = "O Email deve ter de 9 a 32 caracteres.";
      break;
  }
  $("#msgbox2").fadeIn(1000).fadeTo(200, 1, function () {
    $(this).html(message).addClass("alert alert-danger");
  });
}

function register() {
  if (document.getElementById('cbTerms').checked) {

    if ($("#regPassword").val() != $("#regPassword2").val()) {
      getMessage(1);
    } else {
      if ($("#regUsername").val().length < 4) {
        getMessage(2);
      } else if ($("#regUsername").val().length > 12) {
        getMessage(2);
      } else {
        if ($("#regPassword").val().length < 4) {
          getMessage(3);
        } else if ($("#regPassword").val().length > 12) {
          getMessage(3);
        } else {
          if ($("#regEmail").val().length > 32) {
            getMessage(4);

          } else if ($("#regEmail").val().length < 9) {
            getMessage(4);
          } else {
            $("#msgbox2").removeClass().addClass("alert alert-info").text("Validando...").fadeIn(1000);
            $.ajax({
              url: "scripts/php/register.php",
              type: "POST",
              data: {
                username: $('#regUsername').val(),
                password: $("#regPassword").val(),
                password2: $("#regPassword2").val(),
                email: $("#regEmail").val()

              },
              dataType: 'json',
              success: function (data) {
                if (data == 1) {
                  $("#RegisterButton").toggle();
                  $("#msgbox2").fadeTo(200, 1, function () {
                    $(this).html("Registro completado com sucesso!").addClass("alert alert-success");
                  })
                } else {
                  $("#msgbox2").fadeTo(200, 1, function () {
                    $(this).html("Alguns dados parecem já existir em nosso Banco de Dados!").addClass("alert alert-danger");
                  })
                }
              },
              error:function(exception){alert('Exeption:'+exception);console.log(exception)}
            });
          }
        }



      }
    }
  } else {
    alert("Você precisa aceitar os Termos e Condições");
    getMessage(0);
  }
}
