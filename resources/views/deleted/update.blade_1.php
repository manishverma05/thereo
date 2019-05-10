@extends('admin.layouts.app')
@section('after-style')
@endsection('after-style')
@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#session-tab">Session Page</a></li>
        <li><a data-toggle="tab" href="#video-tab">Video</a></li>
        <li><a data-toggle="tab" href="#matirial-tab">Materials Page</a></li>
        <li><a data-toggle="tab" href="#resource-tab">Resource Page</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta Settings</a></li>
        <!--<li><a data-toggle="tab" href="#public-tab">Publication</a></li>-->
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>
<form action="{{ route('admin.program.session.update',[$program->unique_id,$session->unique_id]) }}" method="post" enctype="multipart/form-data">
    @csrf 
    <div class="tab-content">
        <div id="session-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">The session page describes what the session is about.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the article to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title', $session->title) }}" placeholder="Introduction to Stress.">
                </div>
            </div>  
            <div class="col-sm-12 artctitle">
                <h5>Alternative Title: If you don't want the title of the page to be the same as the name of the session, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title_alt" value="{{ old('title_alt', $session->title_alt) }}" placeholder="Alternative Title">
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
        <div id="video-tab" class="tab-pane fade in">
            @php
            $video = asset('administrator/images/no-image.png');
            $video_thumb = asset('administrator/images/no-image.png');
            $filename = '';
            if(isset($session->attachment->file)):
            $filename = $session->attachment->file; 
            $video = asset(config('constants.session.video_path_display').$session->attachment->file);
            $video_thumb = asset(config('constants.session.video_path_display').'thumb_'.$session->attachment->file);
            endif;
            @endphp
            <div class="admin-nav-head">The video is the main content of the session. Use the settings below to attach a video to the session.</div>
            <div class="col-sm-12 artcover">
                <p><span style="color: #fff;">Video Attachment: </span> This session is currently attached to the video displayed below.</p>
                <a href="javascript::void(0)" onclick="$('[name=video_attach]').click()">Add Video</a>
                <input type="file" name="video_attach" accept="video/*" style="display: none;" onchange="readVideoURL(this);" />
            </div> 
            <div class="row media-wrapper">
                <div class="col-sm-12 imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <video src="{{ $video }}" controls="true" alt="video" id="video_attach_preview" class="image vdo"  style="width:100%" >
                            <div class="middle">
                                <div class="text video_attach_name">{{ $filename }}</div>
                            </div>
                    </div>
                    <div class="col-sm-9 editimg editVideo" @if(!$filename) {{ 'style=display:none;' }} @endif >
                         <div class="postnbotm">
                            <h5 class="video_attach_name">{{ $filename }}</h5>
                            @if(isset($session->attachment->unique_id))
                            <p><a href="{{ route('admin.program.session.video.update',[$session->attachment->unique_id]) }}"> Edit Video</a></p>
                            @endif
                        </div>
                    </div>   
                </div>
            </div>
        </div>
        <div id="matirial-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Materials are important documents (such as worksheets or reading materials) that your audience may need when viewing the video.</div>
            <section id="filter">
                <div class="filter_hd">
                    <p>You may search, filter, organize, and edit the materials listed below.</p>
                    <a href="{{ route('admin.session.material.create.option',[$session->unique_id]) }}" class="nw_article">New Material</a>
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
                        <p>{{ count($session->materials) }} Materials</p>
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
                    <div class="row articles-wrapper switch-view">
                        @foreach ($session->materials as $material_session)
                        @php
                        $material_cover_image = asset('administrator/images/no-image.png');
                        $material_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($material_session->material->cover_media->file)):
                        $material_cover_image = asset(config('constants.material.cover_path_display').$material_session->material->cover_media->file);
                        $material_cover_image_thumb = asset(config('constants.material.cover_path_display').'thumb_'.$material_session->material->cover_media->file);
                        endif;
                        @endphp
                        <div class="col-sm-3 articles-grid" style="background-image: url('{{ $material_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                            <h3><a href="{{ route('admin.session.material.update.'.$material_session->material->type,[$session->unique_id,$material_session->material->unique_id]) }}" >{{ $material_session->material->title }}</a></h3>
                        </div> 

                        @endforeach
                    </div>        
                    <table class="table switch-view" style="display:none;">
                        <thead>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Title </td>
                                <td class="view_type_right">Type </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($session->materials as $material_session)
                            @php
                            $material_cover_image = asset('administrator/images/no-image.png');
                            $material_cover_image_thumb = asset('administrator/images/no-image.png');
                            if(isset($material_session->material->cover_media->file)):
                            $material_cover_image = asset(config('constants.material.cover_path_display').$material_session->material->cover_media->file);
                            $material_cover_image_thumb = asset(config('constants.material.cover_path_display').'thumb_'.$material_session->material->cover_media->file);
                            endif;
                            @endphp
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="material_id[]" class="select-material-td" value="{{ $material_session->material->id }}" >
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <p> loreum ipsum</p>                   
                                </td>
                                <td class="view_type_right">.mp4
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div id="resource-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Provide you audience with updates on the kinds of changes that you have been making to the session.</div>           
            <section id="filter">
                <div class="filter_hd">
                    <p>You may search, filter, organize, and edit the resources listed below.</p>
                    <a href="{{ route('admin.session.resource.create.option',[$session->unique_id]) }}" class="nw_article">New Resource</a>
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
                        <p>{{ count($session->resources) }} Session Resources</p>
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
                        $session_resource_cover_image = asset('administrator/images/no-image.png');
                        $session_resource_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($session_resource->resource->cover_media->file)):
                        $session_resource_cover_image = asset(config('constants.resource.cover_path_display').$session_resource->resource->cover_media->file);
                        $session_resource_cover_image_thumb = asset(config('constants.resource.cover_path_display').'thumb_'.$session_resource->resource->cover_media->file);
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
                                            <input type="checkbox" class="select-th">
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
                            $session_resource_cover_image = asset('administrator/images/no-image.png');
                            $session_resource_cover_image_thumb = asset('administrator/images/no-image.png');
                            if(isset($session_resource->resource->cover_media->file)):
                            $session_resource_cover_image = asset(config('constants.resource.cover_path_display').$session_resource->resource->cover_media->file);
                            $session_resource_cover_image_thumb = asset(config('constants.resource.cover_path_display').'thumb_'.$session_resource->resource->cover_media->file);
                            endif;
                            @endphp
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="session_id" class="select-td" value="{{ $session_resource->resource->id }}">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.session.resource.update.'.$session_resource->resource->type,[$session->unique_id,$session_resource->resource->unique_id]) }}">
                                        <img class="article-thumb" src="{{ $session_resource_cover_image_thumb }}"> 
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
                    <input type="text" name="slug" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ old('slug',$session->slug)}}" placeholder="Enter prefer path without spaces.">
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
                <h5>Categories: What categories would you like the article to belong to? <a href="#" class="nwauthr">New Category</a></h5>
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
            @php
            $cover_image = asset('administrator/images/no-image.png');
            $cover_image_thumb = asset('administrator/images/no-image.png');
            $filename = '';
            if(isset($session->cover_media->file)):
            $filename = $session->cover_media->file; 
            $cover_image = asset(config('constants.session.cover_path_display').$session->cover_media->file);
            $cover_image_thumb = asset(config('constants.session.cover_path_display').'thumb_'.$session->cover_media->file);
            endif;
            @endphp
            <div class="admin-nav-head">The cover is an image that represents the article. You can change the cover by altering the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Cover Title: If you don't want the title of the cover to be the same as the name of the article, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control"  value="{{ old('cover_title',$session->cover_title) }}" name="cover_title">
                </div>
            </div> 
            <div class="col-sm-12 artcover">
                <p>Content: What would you like to say in the article?</p>
                <a href="javascript::void(0)" onclick="$('[name=cover_image]').click()">Update Cover</a>
                <input type="file" name="cover_image" accept="image/*" style="display: none;" onchange="readURL(this);" />
            </div> 
            <div class="col-sm-12 imagewrap">
                <div class="col-sm-3 covercontainer">
                    <img src="{{ $cover_image }}" alt="Cover Image" id="cover_image_preview" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text cover_image_name">{{ $filename }}</div>
                    </div>
                </div>
                <div class="col-sm-9 editimg" @if(!$filename) {{ 'style=display:none;' }} @endif >
                     <div class="postnbotm">
                        <h5 class="cover_image_name">{{ $filename }}</h5>
                    </div>
                </div>   
            </div>
        </div>
        <!--        <div id="public-tab" class="tab-pane fade in">
                    <div class="admin-nav-head">The publication tab controls how and when you want the article to be published.</div>        
                    <div class="col-sm-12 meta-auther userAccess">
                        <h5>Access Level</h5>
                        <div class="auth_wrap">
                            @foreach($roles as $role)
                            <label class="auth_container">{{ $role->name }}
                                <input type="radio"  name="role_id[]" value="{{ $role->id }}"  @if(is_array(old('role_id',$sessionRoles)) && in_array($role->id, old('role_id',$sessionRoles))) checked @endif >
                                       <span class="checkmark"></span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 presentation">
                        <h5>Presentation Style: How prominent would you like the article to be displayed?</h5>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                            </div> /btn-group 
                            <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                        </div> /input-group 
                    </div>
                    <div class="col-sm-12 appearence">
                        <h5>Publication: How would you like to republish the article?</h5>
                        <ul>
                            <li>Schedule for Republication</li>
                            <li><input type="date" name="publish" value="{{ old('publish',$session->publish_on) }}"/></li>
                        </ul>
                    </div>
                    <div class="col-sm-12 appearence">
                        <h5>Depublication: You can depublish the article using the settings below.</h5>
                        <ul>
                            <li>Schedule for Republication</li>
                            <li><input type="date" name="unpublish" value="{{ old('unpublish',$session->unpublish_on) }}"/></li>
                        </ul>
                    </div>
                </div>-->
        <div id="analytic-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this article in particular.</div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Session</button>
</form>
<!-- Start Navigation -->
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

    $('body').on('click', '.switch-view-button', function () {
        $('.switch-view').toggle();
    });
    $('body').on('click', '.select-material-th', function () {
        if ($(this)[0].checked) {
            $('body .select-material-td').prop('checked', true);
        } else {
            $('body .select-material-td').prop('checked', false);
        }
    });
    $('body').on('click', '.select-material-td', function () {
        if (!$(this)[0].checked) {
            $('body .select-material-th').prop('checked', false);
        }
    });
    //Select deselect resource
    $('body').on('click', '.select-resource-th', function () {
        if ($(this)[0].checked) {
            $('body .select-resource-td').prop('checked', true);
        } else {
            $('body .select-resource-td').prop('checked', false);
        }
    });
    $('body').on('click', '.select-resource-td', function () {
        if (!$(this)[0].checked) {
            $('body .select-resource-th').prop('checked', false);
        }
    });
    //Select deselect material
    $('body').on('click', '.select-material-th', function () {
        if ($(this)[0].checked) {
            $('body .select-material-td').prop('checked', true);
        } else {
            $('body .select-material-td').prop('checked', false);
        }
    });
    $('body').on('click', '.select-material-td', function () {
        if (!$(this)[0].checked) {
            $('body .select-material-th').prop('checked', false);
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cover_image_preview').attr('src', e.target.result);
            };
            $('.editimg').show();
            $('.editimgLink').hide();
            $('.cover_image_name').text(input.files[0].name);
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readVideoURL(input) {
        $('.editVideo').show();
        $('.video_attach_name').text(input.files[0].name);
        var fileUrl = window.URL.createObjectURL(input.files[0]);
        $("#video_attach_preview").attr("src", fileUrl);
    }
</script>
@endsection('after-script')
