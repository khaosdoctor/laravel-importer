$(document).ready(function () {

  //Esconde qualquer alerta depois de 5 segundos
  setInterval(function () {
    $('.alert').fadeOut(500, function () { $('.alert').remove();});
  }, 5000);

  //Botão remover
  $('.delete-btn').on('click', function (e) {

    var id = $(this).data('id');
    var button = $(this);
    var row = $(this).closest('tr');
    var message = "";

    button.text("Removendo");
    row.toggleClass('danger');

    var deleteRequest = $.ajax({
      url: "/Produtos/" + id,
      method: "DELETE"
    });

    deleteRequest.done(function (data, textStatus, xhr) {
      if (xhr.status == 200) {
        message = "Item removido";
        row.toggleClass('danger').toggleClass('success');
        row.fadeOut(800, function () { row.remove(); });
        $(".alert-session").append("<div class='alert alert-info'>" + message + "</div>");
      }
    });

    deleteRequest.fail(function (xhr, textStatus) {
      message = "Erro ao remover item: " + textStatus;
      button.text("Erro");
      $(".alert-session").append("<div class='alert alert-danger'>" + message + "</div>");
    })

  });

});
