@extends('admin/admin')
@section('Admin', 'listcategory')
@section('content')
<div class="container-fluid">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title" style="float: left;margin-right: 15px;padding: 7px 0px;">Danh sách thể loại</h5>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcategory">
					Thêm category
				</button>
				<div class="table-responsive">
					<form action="/" method="get">
					@csrf
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Tên thể loại</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($categorys as $category)
								<tr>
									<td>{{$category->category_name}}</td>
									<td><button type="button" class="btn btn-white" onclick="editcategory({{$category->category_id}})"><i class="fas fa-edit"></i></button> 
									<button type="button" class="btn btn-white" onclick="deletecategory({{$category->category_id}})"><i class="fas fa-trash"></i></button>	
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
<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form action="/category/addcategory" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					Tên thể loại: <input type="text" name="category_name">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
					<button type="button" onclick="addcategory()" class="btn btn-primary">Thêm</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="Editcategory" tabindex="-1" role="dialog" aria-labelledby="editcategory"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form enctype="multipart/form-data" method="POST">
				@csrf
				<div class="modal-body">
					<input hidden id="id" name="category_id">
					Tên thể loại: <input type="text" name="category_name" id="categoryname">
				</div>
				<div class="modal-footer">
				<button type="button" onclick="submitEditcategory()" class="btn btn-primary">Sửa</button>
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
	function addcategory(){
		event.preventDefault();
		$.ajax({
			url: 'category/addcategory',
			method: 'POST',
			data: new FormData($("#addcategory form")[0]),
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
	function editcategory(category_id){
		event.preventDefault();
		openModal();
		$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: 'category/detailcategory/'+category_id,
			method: 'GET',
			contentType: false,
			processData: false,
			success:function(data){
				// console.log(data);
				$("#id").val(data.category_id);
				$("#categoryname").val(data.category_name);
			}
		});
	}
	function openModal(){
		$("#Editcategory").modal('show');
	}
	function deletecategory(category_id){
		event.preventDefault();
		if(confirm("Bạn có chắc muốn xóa sản phẩm này?")){
			$.ajax({
				url: 'category/deletecategory/'+category_id,
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
	function submitEditcategory(){
		event.preventDefault();
		$.ajax({
			url: 'category/editcategory',
			method: 'POST',
			data: new FormData($("#Editcategory form")[0]),
			contentType: false,
			processData: false,
			success:function(data){
				toastr.success('Thành công');
				window.location.reload(1000);
			}
		});
	}
</script>
@endsection