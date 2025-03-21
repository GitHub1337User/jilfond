@extends('layouts.app')

@section('title',$product->name)

@section('main')

<h1>Продукт: {{$product->name}}</h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Идентификатор</th>
      <th scope="col">Наименование</th>
      <th scope="col">Цена</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row" id="product-id" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}">{{$product->id}}</th>
      <td>{{$product->name}}</td>
      <td>{{$product->price . " $"}}</td>
    </tr>
  </tbody>
</table>

<div class="container mt-5">
        <div class="counter">
            <button class="btn btn-outline-secondary" id="decrement">-</button>
            <input type="text" class="form-control" id="counterValue" value="1" readonly>
            <button class="btn btn-outline-secondary" id="increment">+</button>
            <button class="btn btn-outline-primary" id="addToCart">Добавить в корзину</button>
        </div>
       
    </div>


    <script>

        document.getElementById('increment').addEventListener('click', function() {
            let value = parseInt(document.getElementById('counterValue').value);
            document.getElementById('counterValue').value = value + 1;
        });

        document.getElementById('decrement').addEventListener('click', function() {
            let value = parseInt(document.getElementById('counterValue').value);
            if (value > 0) { 
                document.getElementById('counterValue').value = value - 1;
            }
        });


       
        document.getElementById('addToCart').addEventListener('click', function() {
            let productInfo = document.getElementById('product-id');
            const product = {
                id: productInfo.getAttribute('data-id'), 
                name: productInfo.getAttribute('data-name'), 
                quantity: parseInt(document.getElementById('counterValue').value), 
                price: parseFloat(productInfo.getAttribute('data-price'))
            };

         
            let cart = JSON.parse(sessionStorage.getItem('cart'));

           
            if(cart!==null){
            const existingProductIndex = cart.findIndex(item => item.id === product.id);
            
            if (existingProductIndex !== -1) {
               
                cart[existingProductIndex].quantity += product.quantity;
            } else {
               
                cart.push(product);
            }
        }
        else{
            cart = [];
            cart.push(product);
        }

         
            sessionStorage.setItem('cart', JSON.stringify(cart));
            console.log(JSON.parse(sessionStorage.getItem('cart')));
         
            updateCartDisplay();
          
        });

    </script>
@endsection