function sendMessage() {
  var message = $("#sendie").val();
  $.ajax({
    url: "scripts/php/chat_sendMessage.php",
    type: "POST",
    data: {
      message: $("#sendie").val()
    },
    dataType: 'json',
    success: function (data) {
      if (data == 0) {
        swal("Oops!", "Você pode usar o Chat somente no Level 30!", "error");
      }
    },
  });
  $("#sendie").val('');
  update();
}

function update() {
  loadPart("chatDivLoad", "chat");
}

