@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#update-tab">Update Details</a></li>
    </ul>

</div>

<!-- Start Navigation -->
<form action="{{ route('admin.program.update.update',[$program->unique_id,$programUpdate->unique_id]) }}" method="post" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" value="{{ $programUpdate->id }}" name="update_id"/>
    <!-----Article Edit Section------>
    <div class="tab-content">
        <div id="update-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Add this update using the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the update to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title',$programUpdate->title) }}" placeholder="Enter the title for the update.">
                </div>
            </div> 
            <div class="col-sm-12 artcontent">
                <h5>Description: What would you like to say about the program?</h5>
                <div class="form-group">
                    <textarea name="description" id="editor" placeholder="Enter description.">
                       {{ old('description',$programUpdate->description) }}
                    </textarea>
                </div>
            </div> 
        </div>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary">Add Update</button>
</form>
@endsection('content')

@section('after-script')
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js">
</script>
<script>
    ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#cover_image_preview').attr('src', e.target.result);
            };
            $('.editimg').show();
            $('.cover_image_name').text(input.files[0].name);
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection('after-script')
