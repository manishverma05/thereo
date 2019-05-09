@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="{{ route('admin.program.list') }}">Return to Programs</a></div>
@endsection('left-breadcrumb')


@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#update-tab">Update Details</a></li>
    </ul>

</div>

<!-- Start Navigation -->
<form action="{{ route('admin.program.update.update',[$program->unique_id,$programUpdate->unique_id]) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <input type="hidden" value="{{ $programUpdate->id }}" name="update_id"/>
    <!-----Article Edit Section------>
    <div class="tab-content">
        <div id="update-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Edit this update using the settings below.</div>
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
    <div class="col-sm-12 appearence">
        <ul>
            <li><a href="javascript:void(0)" onclick="formSubmit(1);">Edit Update</a></li>
        </ul>
    </div>
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
</script>
@include('admin._partial.formjs')
@endsection('after-script')
