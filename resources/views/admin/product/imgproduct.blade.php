@extends('admin/admin')
@section('Admin', 'productimage')
@section('content') 
<div class="container-fluid">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title" style="float: left;margin-right: 15px;padding: 7px 0px;">Danh sách ảnh sản phẩm</h5>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproductimg">
					Thêm ảnh sản phẩm
				</button>
				<div class="table-responsive">
					<form action="/" method="get">
					@csrf
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID sản phẩm</th>
									<th>Ảnh sản phẩm nổi bật</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($productimgs as $product)
								<tr>
									<td>{{$product->product_id}}</td>
									<td><img src="{{url('')}}/img/product_image/{{$product->product_image_name}}" alt="" style="width:380px; height:180px;"></td>
									<td><button type="button" class="btn btn-white" onclick="editproductimg({{$product->product_image_id}})"><i class="fas fa-edit"></i></button> 
									<button type="button" class="btn btn-white" onclick="deleteproductimg({{$product->product_image_id}})"><i class="fas fa-trash"></i></button>	
									</td>
								</tr>	
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
<div class="modal fade" id="addproductimg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Thêm ảnh sản phẩm</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form method="post" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					Loại sản phẩm: <select class="form-control" name="product_id"><br>
					@foreach ($products as $product) 
						<option value="{{$product->product_id}}">{{$product->product_name}}</option><br>
					@endforeach
					</select>	
				</div>
				<div class="form-group">
					Ảnh sản phẩm: <input type="file" name="product_image_name" id="product_image_name"><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="button" onclick="addproductimg()" class="btn btn-primary">Thêm</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="editproductimg" tabindex="-1" role="dialog"
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
				<div class="modal-body form-group">
					<input hidden id="id" name="product_image_id">
					Loại sản phẩm: <select class="form-control" name="product_id"><br>
					@foreach ($products as $product) 
						<option value="{{$product->product_id}}">{{$product->product_name}}</option><br>
					@endforeach
					</select>
				</div>
				<div class="form-group">
					Ảnh sản phẩm: <input type="file" name="product_image_name" id="product_image_name"><br>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="submitEditproductimg()" class="btn btn-primary">Sửa</button>
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
	function editproductimg(product_image_id){
		event.preventDefault();
		openModal();
		$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: 'productimage/detailproductimg/'+product_image_id,
			method: 'GET',
			contentType: false,
			processData: false,
			success:function(data){
				console.log(data);
				$("#id").val(data.product_image_id);
			},
		});
	}
	function openModal(){  
		$("#editproductimg").modal('show');
	}
	function deleteproductimg(product_image_id){
		event.preventDefault();
		if(confirm("Bạn có chắc muốn xóa sản phẩm này?")){
			$.ajax({
				url: 'productimage/deleteproductimg/'+product_image_id,
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
	function addproductimg(){
		event.preventDefault();
		$.ajax({
			url: 'productimage/addproductimg',
			method: 'POST',
			data: new FormData($("#addproductimg form")[0]),
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
	function submitEditproductimg(){
		event.preventDefault();
		$.ajax({
			url: 'productimage/editproductimg',
			method: 'POST',
			data: new FormData($("#editproductimg form")[0]),
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