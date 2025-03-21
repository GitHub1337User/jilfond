@extends('layouts.app')

@section('title','Корзина')

@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}">

<h1>Корзина</h1>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Идентификатор</th>
      <th scope="col">Наименование</th>
      <th scope="col">Цена</th>
      <th scope="col">Количество</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
<p ><span id='total'>Сумма: 0;</span> <button class="btn btn-primary order">Оформить</button></p>


<script>
    
    function renderCart(){
        let cartContainer = document.querySelector('tbody');
        let orderBtn = document.querySelector('.order');
        if(sessionStorage.getItem('cart')!==null)
        { 
               let productsCart = JSON.parse(sessionStorage.getItem('cart'));

               productsCart.forEach(item=>{
                cartContainer.innerHTML += `
                <tr>
                    <th scope="row" id="product-id" data-id="${item.id}" data-name="${item.name}" data-price="${item.price}">${item.id}</th>
                    <td>${item.name}</td>
                    <td>${item.price}$</td>
                    <td>${item.quantity}</td>
                </tr>
                `;
                
               });
               document.querySelector("#total").textContent = "Сумма: "+ productsCart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2)+"$";
            orderBtn.addEventListener('click',makeOrder);
        }else{
            cartContainer.innerHTML = 'Корзина пуста';
            orderBtn.disabled = true;
            document.querySelector("#total").textContent = "Сумма: "+ 0;
        }
    }
    window.onload = renderCart();



function makeOrder() {
    const cartData = JSON.parse(sessionStorage.getItem('cart'));

    fetch('/make-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        },
        body: JSON.stringify({ cart: cartData }) 
    })
    .then(response =>  {
        if (!response.ok) {
            
            throw new Error(`Ошибка: ${response.status} ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Успешно:', data);
        alert('Корзина сохранена!');
        sessionStorage.removeItem('cart');
        renderCart();
        updateCartDisplay();
    })
    .catch((error) => {
        console.error('Ошибка:', error);
        alert('Произошла ошибка при сохранении корзины.');
    });
}


</script>
@endsection