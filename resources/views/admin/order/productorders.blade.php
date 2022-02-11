<?php
  use Illuminate\Support\Facades\Auth;
  use App\Models\User;
  use App\Models\Product;
  use App\Models\Order_detail;
  use App\Models\Order;
?>
@extends('admin/admin')
@section('Admin', 'listproductorder')
@section('content')
<div class="container-fluid">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title" style="float: left;margin-right: 15px;padding: 7px 0px;">Danh sách oder</h5>
				<div class="table-responsive">
					<form  method="post" id="cart">
                        @csrf
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                                
                                @foreach($productOrders as $productOrder)
                                    <tbody>
                                        <tr>
                                            <input type="" value="{{Auth::user()->id}}" hidden value="user_id" id="user_id">
                                            <td>{{$productOrder->product_id}}</td>
                                            <td>{{$productOrder->productname}}</td>
                                            <td><img src="{{url('')}}/img/product/{{$productOrder->productimage}}" alt="" style="width: 100px; height: 100px;"></td>
                                            @if( !isset($productOrder->productdiscount) )
                                            <td>{{number_format($productOrder->productprice)}}₫</td>
                                            @else
                                            <td>{{number_format($productOrder->productdiscount)}}₫</td> 
                                            @endif
                                            <td>{{$productOrder->quantity}}</td>
                                            <td>{{number_format($productOrder->detail_amount)}}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                
                        </table> 
                        <div>
                            <p>Tổng tiền: <span class="value-sale">{{number_format($order->order_total_money)}} Đ</span></p>
                            <button type="button" class="btn btn-danger">In hóa đơn</button>
                            <button type="button" class="btn-spyt btn btn-success" data-order_id="{{$order->order_id}}">Xử lý đặt hàng</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
@endsection
@section('script')
<script src="{{ asset('js/jquery-3.5.1.min.js') }}" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('.btn-spyt').click(function(event) {
          event.preventDefault();
          var order_id = $(this).data('order_id');
          var url = "{{url('admin/order/product')}}/" + order_id;
            if(confirm('Bạn có chắc chắn đã in hóa đơn chưa')){
              $.ajax(url, {
                  type: 'POST',
                  success: function (response) {
                    toastr.success('Xử lý thành công');
                    window.location.href = "{{url('/admin/order')}}";
                  },
                  error: function () {
                      alert('lỗi');
                  }
              });
            } 
      });
  });
    // function action(order_id){
    //     event.preventDefault();
    //     if(confirm('Bạn có chắc chắn đã in hóa đơn chưa')){
    //         $.ajax({
    //             url: 'admin/order/product/' + order_id,
    //             method: 'POST',
    //             contentType: false,
    //             processData: false,
    //             success:function(data){
    //                 toastr.success('Xử lý thành công');
    //                 window.location.reload(1000);
    //             }
    //         });
    //     }
    // }

</script>
@endsection 