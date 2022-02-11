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
                        <a class="nav-link nav-link-sp" href="{{url('product-all')}}">ĐƠN HÀNG</a>
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
                            <th>Mã đơn hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Xem chi tiết hóa đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listcart['order'] as $values)
                        <tr>
                            <input type="" value="{{$values->order_id}}" id="order_id" hidden>
                            <td>{{$values->order_id}}</td>
                            <td>{{$values->customer_name}}</td>
                            <td>{{$values->customer_address}}</td>
                            <td>{{$values->customer_phone}}</td>
                            <td>{{$values->order_time}}</td>
                            <td>{{number_format($values->order_total_money)}}₫</td>
                            <td><button class="btn btn-success"><a href="showdetail/{{$values->order_id}}" style="color: #ffffff;">Chi tiết</a></button></td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
@endsection
