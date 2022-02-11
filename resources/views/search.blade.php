@extends('layout.index')
@section('content')
<div id="content">
      <div class="home-center" id="home-center">
        <div class="danhmucsp pt-5">
			<div class="flash-sale my-5">
		          <div class="container flash-sale-bgcl">
		            <div class="fs-tt d-flex justify-content-between">
		              <div class="fs-lf">
		                <h3>Kết quả tìm kiếm: {{$key}}</h3>
		              </div>
		              <div class="fs-rg ">
		                <a href="#" class="fs-rg-xt ">Xem thêm >></a>
		              </div>
		            </div>
		            <div class="row fs-menu-all">
	            	@if($product->isEmpty() || $key == null)
                    	<p class="result">Xin lỗi, không có gì phù hợp với tiêu chí tìm kiếm của bạn</p>
                    @else
		            @foreach($product as $values)
		              <div class="col-6 col-md-6 col-lg-3 col-xl-3 fs-menu">
		                <div class="img-fs-menu">
		                  <a href="{{url('product')}}/{{$values -> product_id}}">
		                    <img id="img-fs" src="{{url('')}}/img/product/{{$values -> product_image}}" alt="">
		                  </a>
		                  <div class="btn-in-img">
		                    <button type="button" class="add-gds" data-product_id="{{ $values->product_id }}"><i class="fas fa-shopping-basket"></i></button>
		                  </div>
		                </div>
		                @if(($values->product_discount)!= NULL)
		                <div class="label-fs">
		                  <span class="lbsale">{{(ceil(100-($values -> product_discount)/($values -> product_price)*100))}}%</span>
		                  <div class="label-fs-1"></div>
		                </div>
		                <a href="#">{{$values -> product_name}}</a>
		                <div class="value-fs"> <small>{{number_format($values->product_price)}}₫</small> <strong class="value-sale">{{number_format($values->product_discount)}}₫</strong>
		                </div>
		                @endif
		              </div>
		              @endforeach
		            @endif
		            </div>
		            <div>
		            	{!! $product->appends(Request::all())->links('vendor.pagination.bootstrap-4') !!}
		            </div>
		          </div> 
		        </div>
		    </div>
		</div>
	</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('.add-gds').click(function(event) {
          event.preventDefault();
          var product_id = $(this).data('product_id'); // data-product_id="value"
          var url = "{{url('listcart')}}";
          $.ajax(url, {
              type: 'POST',
              data: {
                  product_id: product_id,
              },
              success: function (result) {
                  var resultObj = JSON.parse(result);
                  alert(resultObj.msg);
                  $('.shopping-cart-i').text(resultObj.quantity);
              },
              error: function () {
                  console.log('error');
              }
          });
      });
  });
</script>
@endsection