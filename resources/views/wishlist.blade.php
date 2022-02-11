@if($wishlist == null)
<p>Giỏ hàng trống</p>
@else
  @foreach($wishlist as $values)
    <div class="row">
      <div class="col-xl-3">
        <img src="{{url('')}}/img/product/{{$values -> product_image}}" alt="" style="width: 40px; height: 40px;">
      </div>
      <div class="col-xl-7">
        <a href="{{ url('product') }}/{{$values->product_id}}" style="font-size:11px;">{{$values->product_name}}</a><br>
        @if(($values->product_discount) != NULL)
        <span class="value-sale" style="font-size:11px;">{{number_format($values->product_discount)}}₫ x {{$values->wishlistquantity}}</span>
        @else
        <span class="value-sale" style="font-size:11px;">{{number_format($values->product_price)}}₫ x {{$values->wishlistquantity}}</span>
        @endif
      </div>
      <div class="col-xl-2 col-btn-wishlist">
        <button type="button" class="btn-delete-wishlist btn-wishlist" data-product_id="{{$values->product_id}}"><i class="fas fa-times"></i></button>
      </div>
    </div> 
  @endforeach
@endif