  @extends('layout.index')
  @section('content')
    <div id="content">
      <div class="home-center" id="home-center">
        <div class="danhmucsp pt-5">
          <div class="container">
            <div class="row mb-5 hide-ip">
              <div class="col-12 col-md-4 col-lg-3">
                <div class="fake-menu-hbg">

                </div>
              </div>
              <div class="col-12 col-md-8 col-lg-9">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                  @foreach($home['slides'] as $key => $slide)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"></li>
                  @endforeach
                  </ol>
                  <div class="carousel-inner">
                    <?php $i=0; ?>
                    @foreach($home['slides'] as $slide)
                    @if($i == 0)
                    <?php $i=1; ?>
                    <div class="carousel-item active"> 
                      <a href=""><img class="d-block w-100" src="{{url('')}}/img/slide/{{$slide -> slide_image}}" alt="First slide"></a> 
                    </div>
                    @else
                    <div class="carousel-item"> 
                      <img class="d-block w-100" src="{{url('')}}/img/slide/{{$slide -> slide_image}}" alt="Secondary slide">
                    </div>
                    @endif
                    @endforeach
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="container fix-ip">
              <div class="row">
              @foreach($home['productimgs'] as $values)
                <div class="col-12 col-md-6 col-lg-3 fix-mb-ct1">
                  <img src="{{url('')}}/img/product_image/{{$values -> product_image_name}}" alt="" class="img-ct1">
                </div>
              @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="flash-sale my-5">
          <div class="container flash-sale-bgcl">
            <div class="fs-tt d-flex justify-content-between">
              <div class="fs-lf">
                <h3>Flash sale</h3>
                <p>Ưu đãi giới hạn</p>
              </div>
              <div class="fs-rg ">
                <a href="#" class="fs-rg-xt ">Xem thêm >></a>
              </div>
            </div>
            <div class="row fs-menu-all">
            @foreach($home['productfl'] as $values)
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
            </div>
          </div> 
        </div>
        <div class="thuonghieunoibat">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-12 img-thnb-tt">
                <a href="{{url('brand')}}"><img src="img/31c47b38-thnb.jpg" alt=""></a>
              </div>
              <div class="col-md-12 col-12 img-thnb-ct">
                <a href="#"><img src="img/eb177711-block3-hotbrand.jpg" alt=""></a>
              </div>
            </div>
            <div class="row my-4">
              <div class="col-12 col-md-3">
                <img src="img/ca3b1368-block5-thuonghieu-1.jpg" alt="">
              </div>
              <div class="col-12 col-md-9">
                <div class="row th-ct1">
                  <div class="col-6 col-md-6">
                    <img src="img/84091b91-block5-thuonghieu-2.jpg" alt="">
                  </div>
                  <div class="col-6 col-md-6">
                    <img src="img/d0fc73dd-block5-thuonghieu-3.jpg" alt="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-6">
                    <img src="img/8bbf3f3a-block5-thuonghieu-4.jpg" alt="">
                  </div>
                  <div class="col-6 col-md-6">
                    <img src="img/40ff398a-block5-thuonghieu-5.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="sanphammuanhieu">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-12 img-thnb-tt">
                <img src="img/6c7828ce-spmn.jpg" alt="">
              </div>
            </div>
            <div class="row my-4">
              <div class="col-6 col-md-6">
                <img src="img/spmn-1.jpg" alt="">
              </div>
              <div class="col-6 col-md-6">
                <img src="img/spmn-2.jpg" alt="">
              </div>
            </div>
            <div class="row my-4">
              <div class="col-6 col-md-6">
                <img src="img/spmn-3.jpg" alt="">
              </div>
              <div class="col-6 col-md-6">
                <img src="img/spmn-4.jpg" alt="">
              </div>
            </div>
            <div class="row my-4">
              <div class="col-6 col-md-6">
                <img src="img/spmn-1.jpg" alt="">
              </div>
              <div class="col-6 col-md-6">
                <img src="img/spmn-2.jpg" alt="">
              </div>
            </div>
            <div class="row my-4">
              <div class="col-6 col-md-6">
                <img src="img/spmn-3.jpg" alt="">
              </div>
              <div class="col-6 col-md-6">
                <img src="img/spmn-4.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="sanphamyeuthich">
          <div class="container">
            <div class="row my-2">
              <div class="col-12 col-md-12 img-thnb-tt">
                <img src="img/f032a895-spyt.jpg" alt="">
              </div>
            </div>
            <div class="row fs-menu-all mt-4">
            @foreach($home['products'] as $values)
              <div class="col-6 col-md-6 col-lg-3 col-xl-3 fs-menu">
                <div class="img-fs-menu"><a href="{{url('product')}}/{{$values -> product_id}}">
                    <img id="img-fs" src="{{url('')}}/img/product/{{$values -> product_image}}" alt="">
                  </a>
                  <div class="btn-in-img">
                    <button type="button" class="add-gds" data-product_id="{{ $values->product_id }}"><i class="fas fa-shopping-basket"></i></button>
                  </div>
                </div>
                <a href="#">{{$values -> product_name}}</a>
                <div class="value-fs"><strong class="value-sale">{{number_format($values->product_price)}}₫</strong>
                </div>
              </div>
              @endforeach
            </div>
            <div class="row d-flex justify-content-center">
              <a href="#" name="" class="btn-spyt btn btn-danger">Xem thêm</a>
            </div>
          </div>
        </div>
      </div>
      <!-- footer -->

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
                  $('.wishlist').html(resultObj.wishlist);
              },
              error: function () {
                  alert('Bạn chưa đăng nhập');
              }
          });
      });
      $('.btn-deletewishlist').click(function(event) {
              event.preventDefault();
              if(confirm('Bạn có chắc chắn muốn xóa sản phẩm')) {
                  var product_id = $(this).data('product_id');
                  $productElement = $(this).parent().parent();
                  var url = 'deletewishlist/' + product_id;
                  $.ajax(url, {   
                      type: 'GET',
                      success: function (result) {
                          var resultObj = JSON.parse(result);
                          if (resultObj.status) {
                              alert(resultObj.msg);
                              $productElement.remove();
                              $('.shopping-cart-i').text(resultObj.quantity);
                          } else {
                              alert(resultObj.msg);
                              location.reload();
                          }
                      },
                      error: function() {
                          console.log('error');
                      }
                  });
              }
          });
  });
</script>
@endsection