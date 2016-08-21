function setProfileIcon(icon) {
  $.ajax({
    url: "scripts/php/f_setProfileIcon.php",
    type: "POST",
    data: {
      icon: icon,
    },
    dataType: 'json',
    success: function (data) {
      if (data == 1) {
        swal("Sucesso!", "Seu ícone foi trocado!", "success")
      }
      loadPart("sidebar", "sidebar");
    }
  });
}

function attInfo(tipo) {
  $.ajax({
    url: "scripts/php/acc_attInfo.php",
    type: "POST",
    data: {
      tipo: tipo,
      email: $("#novoEmail").val(),
      senha: $("#novaSenha").val()
    },
    dataType: 'json',
    success: function (data) {
      if (data == 1) {
        alert("Informações salva com sucesso!");
        $("#novaSenha").val('');
      } else {

      }
    },
    error: function (exception) {
      alert('Exeption:' + exception);
      console.log(exception)
    }
  });
}

function recPass() {
  $.ajax({
    url: "scripts/php/acc_recPass.php",
    type: "POST",
    data: {
      user: $("#recUsername").val(),
      email: $("#recEmail").val()
    },
    dataType: 'json',
    success: function (data) {
      if (data == 1) {
        alert("Verifique seu email!");
      } else {
        alert("Opa! Não encontramos nenhuma conta com essas informações! Verifique se o Usuário/Email estão corretos.");
      }
    },
    error: function (exception) {
      alert('Exeption:' + exception);
      console.log(exception)
    }
  });
}
