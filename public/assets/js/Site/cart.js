$(document).ready(() => {
  var single_products = $('#main-content');
  var products_cart = single_products.find('#product');
  var price_cart = single_products.find('#total-products');
  var product_info = single_products.find('.productinfo');
  var btn_add_cart = product_info.find('.add-to-cart');
  var btn_update_product_quantity = single_products.find('.btn-update-product');
  var btn_delete_product = single_products.find('.btn-delete-product');



  function totalProductsInCart() {
    return $.ajax({
      url: '/cart/get',
      dataType: 'json',
      success: function (data) {
        numeral.locale('pt-BR');
        products_cart.html(data.numberProductsCart + ' produtos');
        price_cart.html(numeral(data.valueProductsCart).format('$0,0.00'));
      }
    });
  }

  btn_add_cart.on('click', (e) => {
    e.preventDefault();
    var idProduct = $(e.target).attr('data-id');

    $.ajax({
      url: '/cart/add/' + idProduct,
      type: 'POST',
      success: function (data) {
        totalProductsInCart();
      }
    })
  })

  btn_update_product_quantity.on('click', (e) => {
    e.preventDefault();
    var quantityProducts = $('.quantity-products').val();
    var id = $(e.target).attr('data-id');
    $.ajax({
      url: '/cart/update',
      data: 'id=' + id + '&qtd=' + quantityProducts,
      type: 'post',
      success: function (data) {
        if(data === 'semEstoque'){
          alert('Esse produto acabou no estoque!')
          location.reload()
        }
        if (data === 'updated' || data === 'deleted') {
          location.reload();
        }
      }
    });
  });

  btn_delete_product.on('click', (e) => {
    e.preventDefault();
    var id = $(e.target).attr('data-id');
    $.ajax({
      url: '/cart/delete',
      data: 'id=' + id,
      type: 'post',
      success: function (data) {
        console.log(data)
        if(data === 'deleted') {
          location.reload();
        }
      }
    });
  })
});