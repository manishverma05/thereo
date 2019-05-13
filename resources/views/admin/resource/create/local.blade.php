@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="{{ route("admin.$relatedTo.update", [$$relatedTo->unique_id]) }}">Return to Program</a></div>
@endsection('left-breadcrumb')


@section('content')
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#local-tab"> Local</a></li>
        <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>
<form action="{{ route("admin.$relatedTo.resource.create.local",[$$relatedTo->unique_id]) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <div class="tab-content">
        <div id="local-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Attach an existing article, program, or merchandise, to the resource, using the settings below.</div>
            <section class="local_start_wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="artctitle">
                            <h5>Title: If you don't want the label of the resource to be the same as the label of the product, you may input something different here instead.</h5>
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter the title for the resource.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 artcover">
                    <p>Product Attachment: This resource is currently attached to the product displayed below.</p>
                    <a href="#" data-toggle="modal" data-target="#modal-productPopup">Attach Product</a>
                </div> 
                <div class="imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="{{ asset(config('constants.media.default_media_path_display')) }}" alt="product Image" id="product_preview" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text product_name"></div>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value=""/>
                    <div class="col-sm-9 editimg product_detail" style="display: none;">
                        <div class="postnbotm">
                            <h5 class="product_name"></h5>
                        </div>
                    </div>  
                </div>
            </section>
        </div>      
        <div id="public-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The publication tab controls how and when you want the resource to be published.</div>        
            <div class="col-sm-12 presentation">
                <h5>Presentation Style: How prominent would you like the resource to be displayed?</h5>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                    </div> 
                    <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                </div>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Publication: No changes have been made to the resource. The option to republish the resource will become available when changes have been made.</h5>
                <ul style="opacity:0.5">
                    <li>Schedule for Republication</li>
                    <li>Republish Now</li>
                </ul>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Depublication: You can depublish the resource using the settings below.</h5>
                <ul>
                    <li>Schedule for Depublication</li>
                    <li><a href="#" data-toggle="modal" data-target="#modal-depublication">Depublish Now</a></li>
                </ul>
            </div>
        </div>
        <div id="analytic-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this resource in particular.</div>
        </div>
    </div>
</form>
@include('admin._partial.depublication',['message'=>'This action will make this resource inaccessible to your audience. Are you sure you want to depublish the resource?'])
@include('admin._partial.productPopup',['galleries' => $galleries])
@endsection('content')

@section('after-script')
@include('admin._partial.formjs')
@endsection('after-script')
