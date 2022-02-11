 <?php
  use Illuminate\Support\Facades\Auth;
  use App\Models\User;
?> 
<!DOCTYPE html>
<html>

<head>
  <title>Web mỹ phẩm</title>
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/hamburger.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}" type="text/css">
</head>

<body>
	@include('layout.header')

	@yield('content')

	@include('layout.footer') 
  
  <script src="{{ asset('js/jquery-3.5.1.min.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap.bundle.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="{{ asset('js/home.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/hamburger.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/jquery-ui.js') }}" language="JavaScript" type="text/javascript"></script>
  <script src="{{ asset('js/toastr.min.js')}}" language="JavaScript" type="text/javascript"></script>

  @yield('script')


  <script type="text/javascript">

      $(document).ready(function() {         
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });


          $('.btn-order').click(function(event) {
            event.preventDefault();
            var order_id = $(this).data('order_id');
            var url = "{{url('addorder')}}/" + order_id;
              if(confirm('Bạn đã chắc chắn kiểm tra lại giỏ hàng trước khi đặt hàng?')){
                $.ajax(url, {
                    type: 'POST',
                    success: function (response) {
                      alert('Đơn hàng đã được gửi đi, người bán sẽ liên hệ lại với bạn trong thời gian sớm nhất');
                      window.location.href = "{{url('listcart')}}";
                    },
                    error: function () {
                        alert('lỗi');
                    }
                });
              } 
          }); 

          $('.btn-delete-wishlist').click(function(event) {
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
</body>