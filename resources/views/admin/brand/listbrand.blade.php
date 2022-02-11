@extends('admin/admin')
@section('Admin', 'listbrand')
@section('content') 
<div class="container-fluid">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title" style="float: left;margin-right: 15px;padding: 7px 0px;">Danh sách thể loại</h5>
				<!-- <button type="button" class="btn btn-primary" data-toggle="modal" ta-target="#addbrand">
					Thêm nhãn hiệu
				</button> -->
				<button type="button" onclick="openModalAdd()" class="btn btn-primary">Add</button>
				<div class="table-responsive">
					<form action="/" method="get">
					@csrf
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tên nhãn hiệu</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($brands as $brand)
								<tr>
									<td>{{$brand->brand_name}}</td>
									<td><button type="button" class="btn btn-white" onclick="editBrand({{$brand->brand_id}})"><i class="fas fa-edit"></i></button> 
									<button type="button" class="btn btn-white" onclick="deleteBrand({{$brand->brand_id}})"><i class="fas fa-trash"></i></button>	
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
<div class="modal fade" id="addbrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add nhãn hiệu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form method="post" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					Tên nhãn hiệu: <input type="text" name="brand_name">
				</div>
				<div class="modal-footer">
					<button type="button" onclick="clodeModal()" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="button" onclick="addBrand()" class="btn btn-primary">Thêm</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="editbrand" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Sửa nhãn hiệu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form enctype="multipart/form-data" method="POST">
				@csrf
				<div class="modal-body form-group">
					<input hidden id="id" name="brand_id">
					Tên nhãn hiệu: <input type="text" name="brand_name" id="brandname">
				</div>
				<div class="modal-footer">
				<button type="button" onclick="submitEditBrand()" class="btn btn-primary">Sửa</button>
				<button type="button" onclick="clodeModal()" data-dismiss="modal" class="btn btn-danger">Hủy</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/jquery-3.5.1.min.js') }}" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript">
	function editBrand(brand_id){
		event.preventDefault();
		openModal();
		$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: 'brand/detailbrand/'+brand_id,
			method: 'GET',
			contentType: false,
			processData: false,
			success:function(data){
				// console.log(data);
				$("#id").val(data.brand_id);
				$("#brandname").val(data.brand_name);
			}
		});
	}
	function openModal(){
		$("#editbrand").modal('show');
	}
	function closeModal(){
		$("#addbrand").modal('hide');
		$("#editbrand").modal('hide');
	}
	function openModalAdd(){
		$("#addbrand").modal('show');
	}
	function deleteBrand(brand_id){
		event.preventDefault();
		if(confirm("Bạn có chắc muốn xóa sản phẩm này?")){
			$.ajax({
				url: 'brand/deletebrand/'+brand_id,
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
	function addBrand(){
		event.preventDefault();
		$.ajax({
			url: 'brand/addbrand',
			method: 'POST',
			data: new FormData($("#addbrand form")[0]),
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
	function submitEditBrand(){
		event.preventDefault();
		$.ajax({
			url: 'brand/editbrand',
			method: 'POST',
			data: new FormData($("#editbrand form")[0]),
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