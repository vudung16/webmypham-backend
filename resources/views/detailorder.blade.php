<?php
  use Illuminate\Support\Facades\Auth;
  use App\Models\User;
  use App\Models\Product;
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
                                <a class="nav-link nav-link-sp" href="{{url('product-all')}}">CHI TIẾT HÓA ĐƠN</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row pt-5">
                    <form action="" method="get" id="cart">
                        @csrf
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Mặt hàng</th>
                                    <th>Ảnh</th>
                                    <th>Số tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0 ?>
                                @foreach($listcart['orderdetail'] as $values)
                                <tr>
                                    <input type="" value="{{$values->order_id}}" id="order_id" hidden>
                                    <td><?php $i++; echo $i; ?></td>
                                    <td>{{$values->product_name}}</td>
                                    <td> <img src="{{url('')}}/img/product/{{$values -> product_image}}" alt="" style="width:100px;height:100px;"></td>
                                    <td>{{number_format($values->detail_amount)}}₫</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
              
            </div>
        </div>
        @endsection
        @section('script')
        <script type="text/javascript">
            function showdetailorder(order_id){
                event.preventDefault();
                openModal();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{asset("showdetail")}}/' +order_id ,
                    method: 'GET',
                    contentType: false,
                    processData: false,
                    success:function(data){
                        console.log(data);
                    },
                });
            }
        </script>
</body>

</html>