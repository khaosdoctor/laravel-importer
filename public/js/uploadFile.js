$(document).ready(function () {

  //Trata o formulário para que o botão suma quando clicado em enviar e a barra de progresso apareça  
  $('form#formProduto').submit(function (e) {
    $('.btn-submit').hide();
    $('.progress').toggleClass('hidden').fadeIn();
  });

  //Trat o formulário para desativar o botão se não tiver nenhum arquivo selecionado  
  $('.upload-button').change(function () {
    var ext = $(this).val().split('.').pop();
    if (($(this).val() && (ext == 'xls' || ext == 'xlsx')) ) {
      $('.btn-form-file-submit').removeAttr('disabled');
      $('.btn-form-file-submit').toggleClass('hidden');
    } else {
      $('.btn-form-file-submit').attr('disabled', true);
    }
  });

});
