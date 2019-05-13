@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="{{ route('admin.program.update', [$program->unique_id]) }}">Return to Program</a></div>
@endsection('left-breadcrumb')

@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#session-tab">Session Page</a></li>
        <li><a data-toggle="tab" href="#attachment-tab">Attachments</a></li>
        <li><a data-toggle="tab" href="#resource-tab">Resources</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta Settings</a></li>
        <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>

<form action="{{ route('admin.program.session.update',[$program->unique_id,$session->unique_id]) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <input type="hidden" name="status" value="{{ old('status', $session->status) }}"/>
    <input type="hidden" name="status" value="{{ old('status',$session->status) }}"/>
    <div class="tab-content">
        <div id="session-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">The session page describes what the session is about.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the session to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title', $session->title) }}" placeholder="Session title.">
                </div>
            </div>  
            <div class="col-sm-12 artctitle">
                <h5>Alternative Title: If you don't want the title of the page to be the same as the name of the session, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title_alt" value="{{ old('title_alt', $session->title_alt) }}" placeholder="Write something here...">
                </div>
            </div>
            <div class="col-sm-12 artcontent">
                <h5>Description: What would you like to say about the session?</h5>
                <div class="form-group">
                    <textarea name="description" id="editor" placeholder="Enter description.">
                       {{ old('description', $session->description) }}
                    </textarea>
                </div>
            </div> 
        </div>
        <div id="attachment-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The session The video and material represents the main content of the session. Use the settings below to attach a video and material to the session.</div>
            <div class="col-sm-12 artcover">
                <p><span style="color: #fff;">Video Attachment: </span> This session is currently attached to the video displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-videoPopup">
                    @if(isset($session->video->unique_id)) 
                    Attach
                    @else
                    Change
                    @endif
                    Video</a>
            </div> 
            @php
            $video_attachemnt = asset(config('constants.media.default_media_path_display'));
            $filename = '';
            if(isset($session->video->media->file)):
            $videoFilename = $session->video->media->file; 
            $video_attachemnt = asset(config('constants.media.media_path_display').$session->video->media->file);
            endif;
            @endphp 
            <div class="col-sm-12 media-wrapper">
                <div class="imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <input type="hidden" name="video_id" value="{{@$session->video->media_id}}"/>
                        <video src="{{ $video_attachemnt }}" alt="video" id="video_attach_preview" class="image vdo"  style="width:100%" controls="">
                            <div class="middle">
                                <div class="text video_attach_name">{{ @$videoFilename }}</div>
                            </div>
                    </div>
                    <div class="col-sm-9 editimg video_attach_detail" @if(!@$videoFilename) {{ 'style=display:none;' }} @endif>
                         <div class="postnbotm">
                            <h5 class="video_attach_name">{{ @$videoFilename }}</h5>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="col-sm-12 artcover">
                <p><span style="color: #fff;">Material Attachment: </span> The material for this session is currently attached to the file displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-materialPopup">
                    @if(isset($session->material->unique_id)) 
                    Attach
                    @else
                    Change
                    @endif
                    Material</a>
            </div> 
            @php
            $material_attachemnt = asset(config('constants.media.default_media_path_display'));
            $filename = '';
            if(isset($session->material->media->file)):
            $materialFilename = $session->material->media->file; 
            $material_attachemnt = asset(config('constants.media.media_path_display').$session->material->media->file);
            endif;
            @endphp 
            <div class="col-sm-12 media-wrapper">
                <div class="imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="{{ $material_attachemnt }}" alt="material Image" id="material_preview" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text material_name">{{ @$materialFilename }}</div>
                        </div>
                    </div>
                    <input type="hidden" name="material_id" value="{{@$session->material->media_id}}"/>
                    <div class="col-sm-9 editimg material_detail" @if(!@$materialFilename) {{ 'style=display:none;' }} @endif>
                         <div class="postnbotm">
                            <h5 class="material_name">{{ @$materialFilename }}</h5>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <div id="resource-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The resource page helps you to feature all kinds of products that relate to the session; including, articles, other sessions, and links.</div>           
            <section id="filter">
                <div class="filter_hd">
                    <p>You may search, filter, organize, and edit the resources listed below.</p>
                    <a href="#" data-toggle="modal" data-target="#modal-resourcePopup" class="nw_article">Add Resource</a>
                </div>
                <div class="filter_option col-md-12">
                    <div class="col-sm-2">
                        <input type="text" value="" placeholder="Type here to search">
                    </div> 
                    <div class="col-sm-2">
                        <select>
                            <option>Filter</option>
                        </select>
                    </div> 
                    <div class="col-sm-5">
                        <p>{{ count($session->resources) }} Program Resources</p>
                    </div> 
                    <div class="col-sm-1 switch-view">
                        <a class="grid-btn switch-view-button" href="javascript:void(0)"> <i class="fa fa-th"></i> </a>
                    </div> 
                    <div class="col-sm-1 switch-view" style="display: none;">
                        <a class="grid-btn switch-view-button" href="javascript:void(0)"> <i class="fa fa-th-list"></i> </a>
                    </div> 
                    <div class="col-sm-2">
                        <select>
                            <option>Actions</option>
                        </select>
                        <a class="conf_btn" href="javascript:void(0)">Confirm</a>
                    </div> 
                </div>
                <div class="col-md-12 responder_table">
                    <!-- START: grid row -->
                    <div class="row articles-wrapper switch-view">
                        @foreach ($session->resources as $session_resource)
                        @php
                        $session_resource_cover_image = asset(config('constants.media.default_media_path_display'));
                        $mediaType = ($session_resource->resource->type == 'local'?'product' :($session_resource->resource->type == 'media' || $session_resource->resource->type == 'external'?'cover_media':'cover_media'));
                        if($mediaType)
                        if(isset($session_resource->resource->$mediaType->media->file)):
                        $session_resource_cover_image = asset(config('constants.media.media_path_display').$session_resource->resource->$mediaType->media->file);
                        endif;
                        @endphp
                        <!-- START: single grid -->
                        <div class="col-sm-3 articles-grid" style="background-image: url('{{ $session_resource_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                            <h3><a href="{{ route('admin.session.resource.update.'.$session_resource->resource->type,[$session->unique_id,$session_resource->resource->unique_id]) }}">{{ $session_resource->resource->title }}</a></h3>
                        </div> 
                        <!-- END: single grid -->
                        @endforeach
                    </div>         
                    <!-- END :grid row -->
                    <table class="table switch-view" style="display:none;" >
                        <thead>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="select-resource-th">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Title <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td>Created By<i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <!--<td>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>-->
                                <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($session->resources as $session_resource)
                            @php
                            $session_resource_cover_image = asset(config('constants.media.default_media_path_display'));
                            if(isset($session_resource->resource->product->media->file)):
                            $session_resource_cover_image = asset(config('constants.resource.media_path_display').$session_resource->resource->product->media->file);
                            endif;
                            @endphp
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="resource_id" class="select-resource-td" value="{{ $session_resource->resource->id }}">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.session.resource.update.'.$session_resource->resource->type,[$session->unique_id,$session_resource->resource->unique_id]) }}">
                                        <img class="article-thumb" src="{{ $session_resource_cover_image }}"> 
                                        {{ $session_resource->resource->title }}
                                    </a>
                                </td>
                                <td><a href="javascript::void(0)">{{ $session_resource->resource->creator->username }}</a></td>
                                <!--<td><a href="javascript::void(0)"></a></td>-->
                                <td><a href="javascript::void(0)">{{ $session_resource->resource->created_at }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div id="meta-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The meta tab controls information relating to search engines - in addition to settings that help organize the article.</div>
            <div class="col-sm-12 artclmeta">
                <h5>URL: What address would you like the article to have?</h5>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">https//mythereo.com/articles/</span>
                    <input type="text" name="slug" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ old('slug', $session->slug)}}" placeholder="Enter prefer path without spaces.">
                </div>
            </div> 
            <div class="col-sm-12 meta-auther">
                <h5>Authors: Who are the authors of this article? <a href="#" class="nwauthr">New Author</a></h5>
                <div class="auth_wrap">
                    @foreach($authors as $author)
                    <label class="auth_container">{{ $author->firstname }}
                        <input type="radio"  name="author_id[]" value="{{ $author->id }}"  @if(is_array(old('author_id',$sessionAuthors)) && in_array($author->id, old('author_id',$sessionAuthors))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 metatag">
                <h5>Tags: What keywords would you like the article to be associated with?</h5>
                <div class="form-group">
                    <strong>Tag:</strong>
                    <input type="text" name="tags" placeholder="Tags" value="{{ old('tags',$session->tags) }}" class="form-control tm-input tm-input-info"/>
                </div>
            </div> 
            <div class="col-sm-12 meta-auther">
                <h5>Categories: What categories would you like the article to belong to? <a href="{{ route('admin.session.category.create') }}" class="nwauthr">New Category</a></h5>
                <div class="auth_wrap">
                    @foreach($sessionCategories as $category)
                    <label class="auth_container">{{ $category->title }}
                        <input type="radio"  name="session_category_id[]"  value="{{ $category->id }}" @if(is_array(old('session_category_id',$sessionCategoryMaps)) && in_array($category->id, old('session_category_id',$sessionCategoryMaps))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="cover-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The cover represents the session. Add the settings below to control what the cover looks like.</div>
            <div class="col-sm-12 artctitle">
                <h5>Cover Title: If you don't want the label of the cover to be the same as the title of the session, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control"  value="{{ old('cover_title',$session->cover_title) }}" name="cover_title">
                </div>
            </div>
            <div class="col-sm-12 artcover">
                <p>Image: The session is currently associated with the image displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-coverPopup">
                    @if(isset($session->cover_media->unique_id)) 
                    Attach
                    @else
                    Change
                    @endif
                    Image</a>
            </div> 
            @php
            $cover_image = asset(config('constants.media.default_media_path_display'));
            $filename = '';
            if(isset($session->cover_media->media->file)):
            $filename = $session->cover_media->media->file; 
            $cover_image = asset(config('constants.media.media_path_display').$session->cover_media->media->file);
            endif;
            @endphp
            <div class="col-sm-12 imagewrap">
                <div class="col-sm-3 covercontainer">
                    <img src="{{ $cover_image }}" alt="Cover Image" id="cover_image_preview" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text cover_image_name">{{ $filename }}</div>
                    </div>
                </div>
                <input type="hidden" name="cover_id" value="{{ @$session->cover_media->media_id }}"/>
                <div class="col-sm-9 editimg cover_image_detail" @if(!$filename) {{ 'style=display:none;' }} @endif>
                     <div class="postnbotm">
                        <h5 class="cover_image_name">{{ $filename }}</h5>
                    </div>
                </div>   
            </div>
        </div>
        <div id="public-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The publication tab controls how and when you want the session to be published.</div>        
            <div class="col-sm-12 meta-auther userAccess">
                <h5>User Access: Who can view the session?</h5>
                <div class="auth_wrap">
                    <label class="auth_container">Everyone
                        <input type="radio"  name="role_id[]" value="" checked="">
                        <span class="checkmark"></span>
                    </label>
                    @foreach($roles as $role)
                    <label class="auth_container">{{ $role->name }}
                        <input type="radio"  name="role_id[]" value="{{ $role->id }}"  @if(is_array(old('role_id',$sessionRoles)) && in_array($role->id, old('role_id',$sessionRoles))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 presentation">
                <h5>Presentation Style: How prominent would you like the session to be displayed?</h5>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                    </div> 
                    <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                </div>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Publication: No changes have been made to the session. The option to republish the session will become available when changes have been made.</h5>
                <ul>
                    <li>Schedule for Republication</li>
                    <li><a href="#" data-toggle="modal" data-target="#modal-publication">Republish Now</a></li>
                </ul>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Depublication: You can depublish the session using the settings below.</h5>
                <ul>
                    <li>Schedule for Depublication</li>
                    <li><a href="#" data-toggle="modal" data-target="#modal-depublication">Depublish Now</a></li>
                </ul>
            </div>
        </div>
        <div id="analytic-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this article in particular.</div>
        </div>
    </div>
</form>
<!-- Start Navigation -->
@include('admin._partial.publication',['message'=>'No changes have been made to the session. The option to republish the session will become available when changes have been made.'])
@include('admin._partial.depublication',['message'=>'This action will make this session inaccessible to your audience. Are you sure you want to depublish the session?'])
@include('admin._partial.coverPopup',['galleries' => $galleries])
@include('admin._partial.videoPopup',['galleries' => $galleries])
@include('admin._partial.materialPopup',['galleries' => $galleries])
@include('admin._partial.resourcePopup',['relatedTo' => 'session'])
@endsection('content')
@section('after-script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js">
</script>
<script>
    ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

    $(document).ready(function () {
        $(".tm-input").tagsManager();
    });
</script>
@include('admin._partial.formjs')
@endsection('after-script')
