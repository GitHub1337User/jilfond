<div class="card col-3" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">{{$product->name}}</h5>
    <p class="card-text">{{$product->price . ' $'}}</p>

    <a href="{{route('product-by-id',$product->id)}}" class="btn btn-primary">Просмотр</a>
  </div>
</div>