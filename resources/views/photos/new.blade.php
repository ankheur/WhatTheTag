@extends('app')

@section('header_assets')
{{-- version 0.5 --}}
<link rel="stylesheet" href="//cdn.rawgit.com/timschlechter/bootstrap-tagsinput/28bfe3ece301e66e530e8b0e6fc5056cd34602e5/dist/bootstrap-tagsinput.css" />
{{-- To fix the width --}}
<style type="text/css">
.bootstrap-tagsinput {
  width: 100% !important;
}
</style>
@stop

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create a new Photo</div>
				<div class="panel-body">
					
					@include('partials.messages')

					<form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('/photo/new') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Photo</label>
							<div class="col-md-6">
								<input type="file" class="form-control" name="photo" accept="image/*">
							</div>
						</div>
						
						{{-- Photo preview container, hidden as default with class hide from app.css --}}
						<div class="form-group hide" id="previewGrp">
							<label class="col-md-4 control-label">Preview</label>
							<div class="col-md-6">
								<img src="" width="100%" id="previewImg" />
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label">Tags</label>
							<div class="col-md-6">
								{{-- bootstrap-tagsinput needs this to have 100% width to show properly --}}
								<input data-role="tagsinput" style="width:100%" type="text" class="form-control" name="tags">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Create
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer_assets')
{{-- bootstrap-tagsinput --}}
{{-- version 0.5, ignore the 4.2 in release name --}}
{{-- https://github.com/timschlechter/bootstrap-tagsinput/blob/28bfe3ece301e66e530e8b0e6fc5056cd34602e5/dist/bootstrap-tagsinput.min.js --}}
<script type="text/javascript" src="//cdn.rawgit.com/timschlechter/bootstrap-tagsinput/28bfe3ece301e66e530e8b0e6fc5056cd34602e5/dist/bootstrap-tagsinput.min.js"></script>
{{-- /bootstrap-tagsinput --}}

{{-- IMG Preview --}}
{{-- Taken from http://stackoverflow.com/a/4459419/570763 --}}
<script type="text/javascript">

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function (e) {
			$('#previewGrp').removeClass('hide');
			$('#previewImg').attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}

$('input[name="photo"]').change(function(){
	readURL(this);
});
{{-- /IMG Preview --}}
</script>
@endsection