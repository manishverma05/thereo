@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="{{ route("admin.$relatedTo.update", [$$relatedTo->unique_id]) }}">Return to Program</a></div>
@endsection('left-breadcrumb')


@section('content')
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#media-tab"> Media</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover</a></li>
        <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>
<form action="{{ route("admin.$relatedTo.resource.update.media",[$$relatedTo->unique_id,$resource->unique_id]) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <div class="tab-content">
        <div id="media-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Attach an existing article, program, or merchandise, to the resource, using the settings below.</div>
            <section class="local_start_wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="artctitle">
                            <h5>Title: If you don't want the label of the resource to be the same as the label of the media, you may input something different here instead.</h5>
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ old('title',$resource->title) }}" placeholder="Enter the title for the resource.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 artcover">
                    <p>Media Attachment: This resource is currently attached to the media displayed below.</p>
                    <a href="#" data-toggle="modal" data-target="#modal-mediaPopup">
                        @if(isset($resource->media->unique_id)) 
                        Attach
                        @else
                        Change
                        @endif
                        Media</a>
                </div>             
                @php
                $media = asset(config('constants.media.default_media_path_display'));
                $filename = '';
                if(isset($resource->media->media->file)):
                $filename = $resource->media->media->file; 
                $media = asset(config('constants.media.media_path_display').$resource->media->media->file);
                endif;
                @endphp
                <div class="col-sm-12 imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="{{ $media }}" alt="Cover Image" id="media_preview" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text media_name">{{ $filename }}</div>
                        </div>
                    </div>
                    <input type="hidden" name="media_id" value="{{ @$resource->media->media_id }}"/>
                    <div class="col-sm-9 editimg media_detail" @if(!$filename) {{ 'style=display:none;' }} @endif>
                         <div class="postnbotm">
                            <h5 class="media_name">{{ $filename }}</h5>
                            @if(isset($resource->media->media_id))
                            @endif
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
                    <input type="text" class="form-control"  value="{{ old('cover_title',$resource->cover_title) }}" name="cover_title">
                </div>
            </div>
            <div class="col-sm-12 artcover">
                <p>Image: The media is currently associated with the image displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-coverPopup">
                    @if(isset($resource->cover_media->unique_id)) 
                    Attach
                    @else
                    Change
                    @endif
                    Image</a>
            </div> 
            @php
            $cover_image = asset(config('constants.media.default_media_path_display'));
            $filename = '';
            if(isset($resource->cover_media->media->file)):
            $filename = $resource->cover_media->media->file; 
            $cover_image = asset(config('constants.media.media_path_display').$resource->cover_media->media->file);
            endif;
            @endphp
            <div class="col-sm-12 imagewrap">
                <div class="col-sm-3 covercontainer">
                    <img src="{{ $cover_image }}" alt="Cover Image" id="cover_image_preview" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text cover_image_name">{{ $filename }}</div>
                    </div>
                </div>
                <input type="hidden" name="cover_id" value="{{ @$resource->cover_media->media_id }}"/>
                <div class="col-sm-9 editimg cover_image_detail" @if(!$filename) {{ 'style=display:none;' }} @endif>
                     <div class="postnbotm">
                        <h5 class="cover_image_name">{{ $filename }}</h5>
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
                <ul>
                    <li>Schedule for Republication</li>
                    <li><a href="#" data-toggle="modal" data-target="#modal-publication">Republish Now</a></li>
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
@include('admin._partial.publication',['message'=>'No changes have been made to the resource. The option to republish the resource will become available when changes have been made.'])
@include('admin._partial.depublication',['message'=>'This action will make this resource inaccessible to your audience. Are you sure you want to depublish the resource?'])
@include('admin._partial.mediaPopup',['galleries' => $galleries])
@include('admin._partial.coverPopup',['galleries' => $galleries])
@endsection('content')

@section('after-script')
@include('admin._partial.formjs')
@endsection('after-script')
