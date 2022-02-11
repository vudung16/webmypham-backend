@extends('admin/admin')
@section('Admin', 'listproduct')
@section('content') 
<style>
	tr .sm-th{
		width:100px;
	}
	tr .lg-th{
		width:150px; 
	}
</style>
<div class="container-fluid">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title" style="float: left;margin-right: 15px;padding: 7px 0px;">Danh sách thể loại</h5>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproduct">
					Thêm sản phẩm
				</button>
				<div class="table-responsive">
					<form action="/" method="get">
					@csrf
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="lg-th">Tên sản phẩm</th>
									<th>Mô tả</th>
									<th>Ảnh</th>
									<th>Giá</th>
									<th>Giảm giá</th>
									<th>Loại hàng</th>
									<th>Nhãn hiệu</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($products as $product)
								<tr>
									<td>{{$product->product_name}}</td>
									<td>{!! $product->product_description !!}</td>
									<td><img src="{{url('')}}/img/product/{{$product->product_image}}" alt="" style="width:180px; height:180px;"></td>
									<td>{{number_format($product->product_price)}}</td>
									<td>{{number_format($product->product_discount)}}</td>
									<td>{{$product->name_cate}}</td>
									<td>{{$product->name_brand}}</td>
									<td><button type="button" class="btn btn-white" onclick="editproduct({{$product->product_id}})"><i class="fas fa-edit"></i></button> 
									<button type="button" class="btn btn-white" onclick="deleteproduct({{$product->product_id}})"><i class="fas fa-trash"></i></button>	
									</td>
								</tr>	
								@endforeach
							</tbody>
						
						</table>
						{!! $products->links('vendor.pagination.bootstrap-4') !!}
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form action="addproduct" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					Tên sản phẩm: <input class="form-control" type="text" name="product_name"><br>
					Mô tả sản phẩm: <textarea class="form-control ckeditor" id="product_description_add" name="product_description"></textarea><br>
					Ảnh: <input class="form-control" type="file" name="product_image"><br>
					Giá tiền: <input class="form-control" type="text" name="product_price"><br>
					Giảm giá: <input class="form-control" type="text" name="product_discount"><br>
					Loại hàng: <select class="form-control" name="category_id"><br>
					@foreach ($categorys as $category) 
						<option value="{{$category->category_id}}">{{$category->category_name}}</option><br>
					@endforeach
					</select>	
					Nhãn hiệu: <select class="form-control" name="brand_id"><br>
					@foreach ($brands as $brand) 
						<option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option><br>
					@endforeach
					</select>
				</div>
				<div class="modal-footer"> 
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="submit" onclick=" addproduct()" class="btn btn-primary">Thêm</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="editproduct" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Sửa </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form enctype="multipart/form-data" method="POST">
				@csrf
				<div class="modal-body">
					<input hidden id="id" name="product_id">
					Tên thể loại: <input class="form-control" type="text" name="product_name" id="productname"><br>
					Mô tả sản phẩm: <textarea class="form-control ckeditor" id="product_description" name="product_description"></textarea> <br>
					Ảnh: <input class="form-control" type="file" name="product_image" id=""><br><img style="width:80px" id="product_image" src="" alt=""><br>
					Giá tiền: <input class="form-control" type="text" name="product_price" id="productprice"><br>
					Giảm giá: <input class="form-control" type="text" name="product_discount" id="productdiscount"><br>
					Loại hàng: <select class="form-control" name="category_id" id="categoryid"><br>
					@foreach ($categorys as $category) 
						<option value="{{$category->category_id}}">{{$category->category_name}}</option><br>
					@endforeach
					</select>	
					Nhãn hiệu: <select class="form-control" name="brand_id" id="brandid"><br>
					@foreach ($brands as $brand) 
						<option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option><br>
					@endforeach
					</select>
				</div>
				<div class="modal-footer">
				<button type="button" onclick=" submitEditproduct()" class="btn btn-primary">Sửa</button>
				<button type="button" data-dismiss="modal" class="btn btn-danger">Hủy</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')

<script src="{{ asset('js/jquery-3.5.1.min.js') }}" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	CKEDITOR.replace('product_description_add');
	CKEDITOR.replace('product_description');
	function editproduct(product_id){
		event.preventDefault();
		openModal();
		$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: 'product/detailproduct/'+product_id,
			method: 'GET',
			contentType: false,
			processData: false,
			success:function(data){
				console.log(data); 
				$("#id").val(data.data.product.product_id);
				$("#productname").val(data.data.product.product_name);
				CKEDITOR.instances['product_description'].setData(data.data.product.product_description);
				$("#product_image").attr('src', '{{ url("") }}/img/product/' + data.data.product.product_image);
				$("#productprice").val(data.data.product.product_price);
				$("#productdiscount").val(data.data.product.product_discount);
				$("#categoryid").val(data.data.product.category_id);
				$("#brandid").val(data.data.product.brand_id);
			}
		});
	}
	function openModal(){
		$("#editproduct").modal('show');
	}
	function deleteproduct(product_id){
		event.preventDefault();
		if(confirm("Bạn có chắc muốn xóa sản phẩm này?")){
			$.ajax({
				url: 'product/deleteproduct/'+product_id,
				method: 'GET',
				contentType: false,
				processData: false,
				success:function(data){
					toastr.success('Xóa thành công');
					window.location.reload(1000);
				}
			});
		}
	}
	function addproduct(){
		event.preventDefault();
		var data = new FormData($("#addproduct form")[0]);
			data.append('product_description', CKEDITOR.instances['product_description_add'].getData());
		$.ajax({
			url: 'product/addproduct',
			method: 'POST',
			data: data,
			contentType: false,
			processData: false,
			success:function(data){
				toastr.success('Thành công');
				window.location.reload(1000);
			},
			error:function(data) {
				$('.error').html('');
				   $.each(data.responseJSON.errors, function(key,value) {
				     $('.error').append('<p class=" text-danger">'+value+'</p');
				 }); 
			}
		});
	}
	
	function submitEditproduct(){
		event.preventDefault();
		var data = new FormData($("#editproduct form")[0]);
			data.append('product_description', CKEDITOR.instances['product_description'].getData());
		$.ajax({
			url: 'product/editproduct',
			method: 'POST',
			data: data,
			contentType: false,
			processData: false,
			success:function(data){
				toastr.success('Thành công');
				window.location.reload(1000);
			},
			error:function(data) {
				$('.error').html('');
				   $.each(data.responseJSON.errors, function(key,value) {
				     $('.error').append('<p class=" text-danger">'+value+'</p');
				 }); 
			}
		});
	}
</script>

@endsection