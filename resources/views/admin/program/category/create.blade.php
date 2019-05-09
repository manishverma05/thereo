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
        <li class="active"><a data-toggle="tab" href="#category-tab">Settings</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>

</div>

<!-- Start Navigation -->
<form action="{{ route('admin.program.category.create') }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <!-----Category Add Section------>
    <div class="tab-content">
        <div id="category-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Add this category using the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the category to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter the title for the category.">
                </div>
            </div> 
        </div>
        <div id="analytic-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this category in particular.</div>
        </div>
    </div>
    <br/>
    <div class="col-sm-12 appearence">
        <ul>
            <li><a href="javascript:void(0)" onclick="formSubmit(1);">Add Category</a></li>
        </ul>
    </div>
</form>
@endsection('content')

@section('after-script')
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js">
</script>
@include('admin._partial.formjs')
@endsection('after-script')
