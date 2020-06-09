$(document).ready(() => {
  var mainContent = $('#main-content')
  var btnCheckout = mainContent.find('#btn-checkout')
  var messageFrete = mainContent.find('#message-frete')


  btnCheckout.on('click', (e) => {
    e.preventDefault()
    $.ajax({
      url: '/checkout',
      dataType: 'json',
      beforeSend: function() {
        btnCheckout.text('Finalizando compra...')
      },
      success: function(data) {
        console.log(data)
        if(data == 'empty') {
          btnCheckout.text('Finalizar compra')
          alert('É necessario obter carrinho no produto para fechar pedido')
        }

        if(data == 'notLoggedIn') {
          alert('É necessario estar logado para finalizar compra')
          window.location.href = '/login'
        }

        if(data == 'frete') {
          alert('É necessario calcular o frete para fechar pedido')
          messageFrete.focus()
        }

        if(data.redirect) {
          window.location.href = data.url
        }
      }
    })
  })
})