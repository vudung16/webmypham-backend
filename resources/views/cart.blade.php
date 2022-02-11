<?php
  use Illuminate\Support\Facades\Auth;
  use App\Models\User;
  use App\Models\Product;
  use App\Models\Order_detail;
  use App\Models\Order;
?>
  @extends('layout.index')
  @section('content')
        <div class="body-sanpham mt-5" id="content">
            <div class="container">
                <div class="row">
                    <div class="d-flex ">
                        <ul class="nav nav-tabs nav-sp">
                            <li class="nav-item nav-it-sp">
                                <a class="nav-link nav-link-sp" href="{{url('home')}}">TRANG CHỦ</a>
                            </li>
                            <li class="nav-item nav-it-sp">
                                <a class="nav-link nav-link-sp" href="{{url('product-all')}}">GIỎ HÀNG</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-5">
                        @if(!isset($productOrders))
                            <tr>Giỏ hàng trống</tr>
                        @else
                            <form action="addorder/{{$order->order_id}}" method="post" id="cart">
                                @csrf
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Ảnh sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Nhãn hiệu</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                        
                                        @foreach($productOrders as $productOrder)
                                            <tbody>
                                                <tr>
                                                    <input type="" value="{{Auth::user()->id}}" hidden value="user_id" id="user_id">
                                                    <td>{{$productOrder->product_id}}</td>
                                                    <td>{{$productOrder->product_name}}</td>
                                                    <td><img src="{{url('')}}/img/product/{{$productOrder->product_image}}" alt="" style="width: 100px; height: 100px;"></td> 
                                                    <td><a href="{{url('category')}}/{{$productOrder->cateid}}">{{$productOrder->catename}}</a></td>
                                                    <td><a href="{{url('brand')}}/{{$productOrder->brandid}}">{{$productOrder->brandname}}</a></td>
                                                    @if( !isset($productOrder->product_discount) )
                                                    <td>{{number_format($productOrder->product_price)}}₫</td>
                                                    @else
                                                    <td>{{number_format($productOrder->product_discount)}}₫</td> 
                                                    @endif
                                                    <td>{{$productOrder->wishlistquantity}}</td>
                                                    <td>{{number_format($productOrder->detailamount)}}</td>
                                                    <td>
                                                        <button type="button" class="btn-delete btn btn-white" data-product_id="{{$productOrder->product_id}}"><i class="fas fa-trash"></i></button> 
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                        
                                </table>
                                <div>
                                    <?php
                                        $currentUserId = auth()->id();
                                        $currentOrder = Order::where('user_id', $currentUserId)->whereNull('action')->first();
                                        $totalMoney = Order_detail::where('order_id', $currentOrder->order_id)->sum('detail_amount');
                                    ?>
                                    <p>Tổng thành tiền: <span class="value-sale">{{number_format($totalMoney)}} Đ</span></p>
                                    <button type="button" class="btn-order btn btn-danger" data-order_id="{{$order->order_id}}">Đặt hàng</button>
                                </div>
                            </form>
                        @endif
                </div>
            </div>
        </div> 
        @endsection 
    @section('script') 
        <script type="text/javascript">

            $(document).ready(function() {         
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // $('.btn-order').click(function(event) {
                //   event.preventDefault();
                //   var order_id = $(this).data('order_id');
                //   var url = "{{url('addorder')}}/" + order_id;
                //     if(confirm('Bạn đã chắc chắn kiểm tra lại giỏ hàng trước khi đặt hàng?')){
                //       $.ajax(url, {
                //           type: 'POST',
                //           success: function (response) {
                //             alert('Đơn hàng đã được gửi đi, người bán sẽ liên hệ lại với bạn trong thời gian sớm nhất');
                //             window.location.href = "{{url('listcart')}}";
                //           },
                //           error: function () {
                //               alert('lỗi');
                //           }
                //       });
                //     } 
                // });

                $('.btn-delete').click(function(event) {
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
                                    $('.value-sale').text(new Intl.NumberFormat().format(resultObj.totalMoney) + ' Đ');
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