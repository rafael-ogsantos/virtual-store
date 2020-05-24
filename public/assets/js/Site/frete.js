$(document).ready(() => {
  var single_products = $('#main-content');
  var products_cart = single_products.find('#product');
  var btn_calculate_frete = single_products.find('#btn-calculate-frete');
  var message_frete = single_products.find('#message-frete');
  btn_calculate_frete.on('click', (e) => {
    e.preventDefault();
    var frete = message_frete.val();
    $.ajax({
      url: '/frete/calculate',
      type: 'post',
      data: 'frete=' + frete,
      dataType: 'json',
      beforeSend: function() {
        message_frete.html('Frete')
      },
      success: function(data) {
        console.log(data)
        if(data === 'login') {
          window.location.href = '/login';
        }

        if(data === 'products') {
          console.log(data)
          message_frete.html('Você precisa ter produtos no carrinho para calcular o frete');
        }

        if (data.erro == true) {
          console.log(data.message)
          message_frete.html(data.message)
        } 

        if (data.erro == false) {
          location.reload();
        }
      }
    });
  });
});