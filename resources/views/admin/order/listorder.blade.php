@extends('admin/admin')
@section('Admin', 'listorder')
@section('content')
<div class="container-fluid">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title" style="float: left;margin-right: 15px;padding: 7px 0px;">Danh sách oder</h5>
				<div class="table-responsive">
					<form action="/" method="get">
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
									<th>Trạng thái</th>
                                    <th>Xem chi tiết hóa đơn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($listcart['order'] as $values)
                                @if($values->action == 1)
                                <tr>
                                    <input type="" value="{{$values->order_id}}" id="order_id" hidden>
                                    <td>{{$values->order_id}}</td>
                                    <td>{{$values->customer_name}}</td>
                                    <td>{{$values->customer_address}}</td>
                                    <td>{{$values->customer_phone}}</td>
                                    <td>{{$values->order_time}}</td>
                                    <td>{{number_format($values->order_total_money)}}₫</td>
									<td>{{$values->action}}</td>
                                    <td>
										<!-- <button class="btn-spyt btn btn-danger" onclick="action({{$values->order_id}});">Xử lý</button> -->
										<a class="btn-spyt btn btn-danger" href="{{url('admin/order/product')}}/{{$values->order_id}}">Chi tiết</a>
									</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
@endsection
