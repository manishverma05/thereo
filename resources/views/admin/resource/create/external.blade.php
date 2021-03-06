@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="{{ route("admin.$relatedTo.update", [$$relatedTo->unique_id]) }}">Return to Program</a></div>
@endsection('left-breadcrumb')


@section('content')
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#external-tab"> External</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover</a></li>
        <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>
<form action="{{ route("admin.$relatedTo.resource.create.external",[$$relatedTo->unique_id]) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <div class="tab-content">
        <div id="external-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Attach an external link (https://example.com), as the resource, using the settings below.</div>
            <section class="local_start_wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="artctitle">
                            <h5>Title: If you don't want the label of the resource to be the same as the label of the external, you may input something different here instead.</h5>
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter the title for the resource.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 artcover">
                    <p>Link Attachment: This resource is currently attached to the external displayed below.</p>
                    <a href="#" data-toggle="modal" data-target="#modal-externalPopup">Attach Link</a>
                </div> 
                <div class="imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="{{ asset(config('constants.media.default_media_path_display')) }}" alt="external Image" id="external_preview" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text external_name"></div>
                        </div>
                    </div>
                    <input type="hidden" name="external_id" value=""/>
                    <div class="col-sm-9 editimg external_detail" style="display: none;">
                        <div class="postnbotm">
                            <h5 class="external_name"></h5>
                        </div>
                    </div>  
                </div>
            </section>
        </div>      
        <div id="cover-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The cover represents the media. Add the settings below to control what the cover looks like.</div>
            <div class="col-sm-12 artctitle">
                <h5>Cover Title: If you don't want the label of the cover to be the same as the title of the media, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control"  value="{{ old('cover_title') }}" name="cover_title">
                </div>
            </div>
            <div class="col-sm-12 artcover">
                <p>Image: The external is currently associated with the image displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-coverPopup">Attach Image</a>
            </div> 
            <div class="col-sm-12 imagewrap">
                <div class="col-sm-3 covercontainer">
                    <img src="{{ asset(config('constants.media.default_media_path_display')) }}" alt="Cover Image" id="cover_image_preview" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text cover_image_name"></div>
                    </div>
                </div>
                <input type="hidden" name="cover_id" value=""/>
                <div class="col-sm-9 editimg cover_image_detail" style="display: none;">
                    <div class="postnbotm">
                        <h5 class="cover_image_name"></h5>
                    </div>
                </div>   
            </div>
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
@include('admin._partial.externalPopup',['galleries' => $galleries])
@include('admin._partial.coverPopup',['galleries' => $galleries])
@endsection('content')

@section('after-script')
@include('admin._partial.formjs')
@endsection('after-script')
