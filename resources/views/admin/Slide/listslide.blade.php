@extends('admin/admin')
@section('Admin', 'listslide')
@section('content')
<div class="container-fluid">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title" style="float: left;margin-right: 15px;padding: 7px 0px;">Danh sách Slide</h5>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addslide">
					Thêm slide
				</button>
				<div class="table-responsive">
					<form action="/" method="get">
					@csrf
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Image slide</th>
									<th>Activity</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($slides as $slide)
								<tr>
									<td><img src="{{url('')}}/img/slide/{{$slide -> slide_image}}" alt="" style="width:600px; height:180px;"></td>
									<td>@if($slide->slide_status==1)
										hiển thị
										@else
										ẩn
										@endif
									</td>
									<td><button type="button" class="btn btn-white" onclick="editSlide({{$slide->slide_id}})"><i class="fas fa-edit"></i></button> 
									<button type="button" class="btn btn-white" onclick="deleteslide({{$slide->slide_id}})"><i class="fas fa-trash"></i></button>	
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
<div class="modal fade" id="addslide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add slide</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form method="post" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<input type="file" name="slide_image">
					<span class="error-form"></span>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="addslide()" class="btn btn-primary">Thêm</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="EditSlide" tabindex="-1" role="dialog" aria-labelledby="editslide"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit slide</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="error alert-danger"></div>
			<form method="post" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<input hidden id="id" name="slide_id">
					<input type="file" name="imgslide" id="imgslide">
					<label >Trạng thái:</label>
					<select class="form-control" id="statusslide" name="slide_status">
						<option value="1">Hiển thị</option>
						<option value="0">Ẩn</option>
					</select>
				</div>
				<div class="modal-footer">
				<button type="button" onclick="submitEditslide()" class="btn btn-primary">Sửa</button>
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
	function editSlide(slide_id){
		event.preventDefault();
		openModal();
		$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: 'slide/detailslide/'+slide_id,
			method: 'GET',
			contentType: false,
			processData: false,
			success:function(data){
				console.log(data);
				$("#id").val(data.slide_id);
				$("#imgslide").val(data.slide_img);
				$("#statusslide").val(data.slide_status);
			}
		});
	}
	function addslide(){
		event.preventDefault();
		$.ajax({
			url: 'slide/addslide',
			method: 'POST',
			data: new FormData($("#addslide form")[0]),
			contentType: false,
			processData: false,
			success:function(data){
					toastr.success('Thêm thành công');
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
	function openModal(){
		$('.error-form').hide();
		$("#EditSlide").modal('show');
	}
	function deleteslide(slide_id){
		event.preventDefault();
		if(confirm("Bạn có chắc muốn xóa sản phẩm này?")){
			$.ajax({
				url: 'slide/deleteslide/'+slide_id,
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
	function submitEditslide(){
		event.preventDefault();
		$.ajax({
			url: 'slide/editslide',
			method: 'POST',
			data: new FormData($("#EditSlide form")[0]),
			contentType: false,
			processData: false,
			success:function(data){
				console.log(data);
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