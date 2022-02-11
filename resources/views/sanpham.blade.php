@extends('layout.index')
@section('content')
<style>
  .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:20px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
.thumbnail {
    padding:0px;
}
.panel {
  position:relative;
}
.panel>.panel-heading:after,.panel>.panel-heading:before{
  position:absolute;
  top:11px;
  left:-16px;
  right:100%;
  width:0;
  height:0;
  display:block;
  content:" ";
  border-color:transparent;
  border-style:solid solid outset;
  pointer-events:none;
}
.panel>.panel-heading:after{
  border-width:7px;
  border-right-color:#f7f7f7;
  margin-top:1px;
  margin-left:2px;
}
.panel>.panel-heading:before{
  border-right-color:#ddd;
  border-width:8px;
}
.container .media .img-user img{
  padding-right: 20px;
}
.container .well .rate span{
  font-size: 20px;
  margin-right: 15px; 
}

</style>
        <div class="body-sanpham my-5" id="content">
            <div class="container">
                <div class="row">
                    <div class="d-flex ">
                        <ul class="nav nav-tabs nav-sp">
                            <li class="nav-item nav-it-sp">
                                <a class="nav-link nav-link-sp" href="{{url('home')}}">TRANG CHỦ</a>
                            </li>
                            <li class="nav-item nav-it-sp">
                                <a class="nav-link nav-link-sp" href="{{url('product-all')}}">DANH SÁCH SẢN
                                    PHẨM</a>
                            </li>
                            <li class="nav-item nav-it-sp">
                                <a class="nav-link nav-link-sp active" href="">SẢN PHẨM</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                  @foreach ($product['productshow'] as $values)
                      <div class="col-12 col-md-4">
                          <div class="sp-ct1-img">
                              <img class="sp-img"
                                  src="{{url('')}}/img/product/{{$values -> product_image}}"
                                  alt="">
                          </div>
                      </div>
                      <div class="col-12 col-md-8">
                          <div class="sp-ct1 pt-5">
                              <h3>{{$values -> product_name}}</h3>
                              <p class="sp-ct1-mt">{!! $values -> product_description !!}</p>
                              <strong class="sp-ct1-value">{{number_format($values -> product_price)}}đ</strong>
                              <ul class="sp-ct2-ul mt-3">
                                  <li class="sp-ct2-li">Thương hiệu: <a href="{{url('brand')}}/{{$values-> brand_id}}">{{$values -> brandname}}</a> </li>
                                  <li class="sp-ct2-li">Xuất xứ: Nhật Bản </li>
                                  <button type="button" value="" class="addtocart button-sp-add my-3" data-product_id="{{ $values->product_id }}">Thêm vào giỏ hàng</button>
                              </ul>
                          </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
          @foreach($product['productshow'] as $value)
            <div class="well">
              <h4>Viết bình luận về sản phẩm ...<span class="glyphicon glyphicon-pencil"></span></h4>
              <form role="form" action="{{url('rate/')}}/{{$value->product_id}}" method="POST">
                  @csrf
                  <div class="rate">
                    <span>Đánh giá</span>
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
                  </div>
                  <div class="form-group">
                      <textarea class="form-control" name="Comment" rows="3"></textarea>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Gửi">
              </form>
          </div><br>
          @endforeach

          @foreach($test->cosmetics_rate as $rate)
          <div class="media">
              <div class="img-user">
                  <img class="media-object" src="http://placehold.it/64x64" alt="">
              </div>
              <div class="media-body">
                  <h4 class="media-heading">{{$rate->user->name}}
                      <small>{{$rate->created_at}}</small>
                  </h4>
                  {{$rate->rate_comment}}
              </div>
          </div><br>
          @endforeach

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
      $('.addtocart').click(function(event) {
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
                  $('.wishlist').html(resultObj.wishlist);
              },
              error: function () {
                  console.log('error');
              }
          });
      });
  });
</script>
@endsection
