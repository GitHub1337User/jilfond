<!doctype html>
<html lang="en">
  <head>
  <style>
   
        .full-height {
            height: 100vh;
        }
        .counter {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; 
        }
        .counter input {
            width: 60px; 
            text-align: center;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <!-- <h1>Hello, world!</h1> -->
    <div class="container-sm">
    @include('includes.header')
    <div class="container-fluid full-height row">
    @yield('main')
    </div>
    @include('includes.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
            function updateCartDisplay(){
            
            if(sessionStorage.getItem('cart')!==null)
            {
                document.querySelector('.cart-count').textContent = Object.keys(JSON.parse(sessionStorage.getItem('cart'))).length;
                console.log(Object.keys(JSON.parse(sessionStorage.getItem('cart'))).length)
            }
            else{
                document.querySelector('.cart-count').textContent = 0;
            }
            
        }
        window.onload = updateCartDisplay();
    </script>
  </body>
</html>