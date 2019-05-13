@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="JavaScript:Void(0)" onclick="goBack()">Return to Sessions</a></div>
@endsection('left-breadcrumb')

@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#category-tab">Category Details</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>

</div>

<!-- Start Navigation -->
<form action="{{ route('admin.session.category.update',[$sessionCategory->unique_id]) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <input type="hidden" name="category_id" value="{{ $sessionCategory->id }}"/>
    <!-----Category Edit Section------>
    <div class="tab-content">
        <div id="category-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Edit this category using the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the category to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title',$sessionCategory->title) }}" placeholder="Enter the title for the category.">
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
            <li><a href="javascript:void(0)" onclick="formSubmit(1);">Edit Category</a></li>
        </ul>
    </div>
</form>
@endsection('content')

@section('after-script')
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js">
</script>
@include('admin._partial.formjs')
@endsection('after-script')
