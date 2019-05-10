@extends('admin.layouts.app')

@section('after-style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="{{ route('admin.program.list') }}">Return to Programs</a></div>
@endsection('left-breadcrumb')

@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#progdetail-tab">Program</a></li>
        <li><a data-toggle="tab" href="#session-tab">Sessions</a></li>
        <li><a data-toggle="tab" href="#update-tab">Updates</a></li>
        <li><a data-toggle="tab" href="#resource-tab">Resources</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta</a></li>
        <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>

<!-- Start Navigation -->
<form action="{{ route('admin.program.update',[$program->unique_id]) }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <!-----Article Edit Section------>
    <input type="hidden" name="program_id" value="{{ $program->id }}"/>
    <input type="hidden" name="status" value="{{ old('status',$program->status) }}"/>
    <div class="tab-content">
        <div id="progdetail-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Edit this program using the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What would you like the title of the program to be?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title',$program->title) }}" placeholder="Enter the title for the program.">
                </div>
            </div> 
            <div class="col-sm-12 artcontent">
                <h5>Description: What would you like to say about the program?</h5>
                <div class="form-group">
                    <textarea name="description" id="editor" placeholder="Enter description." rows="5">
                       {{ old('description',$program->description) }}
                    </textarea>
                </div>
            </div> 
        </div>
        <div id="session-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Programs are made up of video pages, called sessions, that are sequenced together.</div>
            <section id="filter">
                <div class="filter_hd">
                    <p>You may search, filter, organize, and edit the sessions listed below.</p>
                    <a href="{{ route('admin.program.session.create',[$program->unique_id]) }}" class="nw_article">New Session</a>
                </div>
                <div class="filter_option col-md-12">
                    <div class="col-sm-2">
                        <input type="text" value="" placeholder="Search">
                    </div> 
                    <div class="col-sm-2">
                        <select>
                            <option>Filter</option>
                        </select>
                    </div> 
                    <div class="col-sm-5">
                        <p>{{ count($program->sessions) }} Sessions</p>
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
                        <a class="conf_btn" href="#">Confirm</a>
                    </div> 
                </div>
                <div class="col-md-12 responder_table">
                    <div class="row articles-wrapper switch-view">
                        @foreach ($program->sessions as $program_session)
                        @php
                        $program_session->session_cover_image = asset(config('constants.media.default_media_path_display'));
                        if(isset($program_session->session->cover_media->media->file)):
                        $program_session->session_cover_image = asset(config('constants.media.media_path_display').$program_session->session->cover_media->media->file);
                        endif;
                        @endphp
                        <div class="col-sm-3 articles-grid" style="background-image: url('{{ $program_session->session_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                            <h3><a href="{{ route('admin.program.session.update',[$program->unique_id,$program_session->session->unique_id]) }}" >{{ $program_session->session->title }}</a></h3>
                        </div>
                        @endforeach
                    </div>        
                    <table class="table switch-view" style="display:none;">
                        <thead>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" class="select-session-th">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Title <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td>Author<i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($program->sessions as $program_session)
                            @php
                            $program_session->session_cover_image = asset(config('constants.media.default_media_path_display'));
                            if(isset($program_session->session->cover_media->media->file)):
                            $program_session->session_cover_image = asset(config('constants.media.media_path_display').$program_session->session->cover_media->media->file);
                            endif;
                            @endphp
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="session_id[]" class="select-session-td" value="{{ $program_session->session->id }}" >
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript::void(0)">
                                        <img class="article-thumb" src="{{ $program_session->session_cover_image }}"> 
                                        {{ $program_session->session->title }}
                                    </a>
                                </td>
                                <td><a href="javascript::void(0)">Feedback</a></td>
                                <td><a href="javascript::void(0)">18/07/22</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div id="update-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Provide you audience with updates on the kinds of changes that you have been making to the program.</div>
            <section id="filter">
                <div class="filter_hd">
                    <p>You may search, filter, organize, and edit the updates listed below.</p>
                    <a href="{{ route('admin.program.update.create',[$program->unique_id]) }}" class="nw_article">New Update</a>
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
                        <p>{{ count($program->updates) }} Program Updates</p>
                    </div>
                    <div class="col-sm-2">
                        <select>
                            <option>Actions</option>
                        </select>
                        <a class="conf_btn" href="javascript:void(0)">Confirm</a>
                    </div> 
                </div>

                <div class="col-md-12 responder_table">
                    <table class="table">
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
                            @foreach ($program->updates as $program_update)
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="program_id" class="select-td" value="{{ $program_update->id }}">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.program.update.update',[$program->unique_id,$program_update->unique_id]) }}">
                                        {{ $program_update->title }}
                                    </a>
                                </td>
                                <td><a href="javascript::void(0)">{{ $program_update->creator->username }}</a></td>
                                <!--<td><a href="javascript::void(0)"></a></td>-->
                                <td><a href="javascript::void(0)">{{ $program_update->created_at }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div id="resource-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The resource page helps you to feature all kinds of products that relate to the program; including, articles, other programs, and links.</div>           
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
                        <p>{{ count($program->resources) }} Program Resources</p>
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
                        @foreach ($program->resources as $program_resource)
                        @php
                        $program_resource_cover_image = asset(config('constants.media.default_media_path_display'));
                        $mediaType = ($program_resource->resource->type == 'local'?'product' :($program_resource->resource->type == 'media' || $program_resource->resource->type == 'external'?'cover_media':'cover_media'));
                        if($mediaType)
                        if(isset($program_resource->resource->$mediaType->media->file)):
                        $program_resource_cover_image = asset(config('constants.media.media_path_display').$program_resource->resource->$mediaType->media->file);
                        endif;
                        @endphp
                        <!-- START: single grid -->
                        <div class="col-sm-3 articles-grid" style="background-image: url('{{ $program_resource_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                            <h3><a href="{{ route('admin.program.resource.update.'.$program_resource->resource->type,[$program->unique_id,$program_resource->resource->unique_id]) }}">{{ $program_resource->resource->title }}</a></h3>
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
                            @foreach ($program->resources as $program_resource)
                            @php
                            $program_resource_cover_image = asset(config('constants.media.default_media_path_display'));
                            if(isset($program_resource->resource->product->media->file)):
                            $program_resource_cover_image = asset(config('constants.resource.media_path_display').$program_resource->resource->product->media->file);
                            endif;
                            @endphp
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="resource_id" class="select-resource-td" value="{{ $program_resource->resource->id }}">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.program.resource.update.'.$program_resource->resource->type,[$program->unique_id,$program_resource->resource->unique_id]) }}">
                                        <img class="article-thumb" src="{{ $program_resource_cover_image }}"> 
                                        {{ $program_resource->resource->title }}
                                    </a>
                                </td>
                                <td><a href="javascript::void(0)">{{ $program_resource->resource->creator->username }}</a></td>
                                <!--<td><a href="javascript::void(0)"></a></td>-->
                                <td><a href="javascript::void(0)">{{ $program_resource->resource->created_at }}</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div id="cover-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The cover represents the program. Edit the settings below to control what the cover looks like.</div>
            <div class="col-sm-12 artctitle">
                <h5>Cover Title: If you don't want the label of the cover to be the same as the title of the program, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control"  value="{{ old('cover_title',$program->cover_title) }}" name="cover_title">
                </div>
            </div>
            <div class="col-sm-12 artcover">
                <p>Image: The program is currently associated with the image displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-coverPopup">
                    @if(isset($program->cover_media->unique_id)) 
                    Attach
                    @else
                    Change
                    @endif
                    Image</a>
            </div>             
            @php
            $cover_image = asset(config('constants.media.default_media_path_display'));
            $filename = '';
            if(isset($program->cover_media->media->file)):
            $filename = $program->cover_media->media->file; 
            $cover_image = asset(config('constants.media.media_path_display').$program->cover_media->media->file);
            endif;
            @endphp
            <div class="col-sm-12 imagewrap">
                <div class="col-sm-3 covercontainer">
                    <img src="{{ $cover_image }}" alt="Cover Image" id="cover_image_preview" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text cover_image_name">{{ $filename }}</div>
                    </div>
                </div>
                <input type="hidden" name="cover_id" value="{{ @$program->cover_media->media_id }}"/>
                <div class="col-sm-9 editimg cover_image_detail" @if(!$filename) {{ 'style=display:none;' }} @endif>
                     <div class="postnbotm">
                        <h5 class="cover_image_name">{{ $filename }}</h5>
                        @if(isset($program->cover_media->media_id))
                        @endif
                    </div>
                </div>   
            </div>
        </div>  
        <div id="meta-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The meta tab controls information relating to search engines - in addition to settings that help organize the program.</div>
            <div class="col-sm-12 artclmeta">
                <h5>Slug: What address would you like the program to have?</h5>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">https//mythereo.com/program/</span>
                    <input type="text" name="slug" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ old('slug',$program->slug)}}" placeholder="Enter prefer path without spaces.">
                </div>
            </div> 
            <div class="col-sm-12 meta-auther">
                <h5>Authors: Who are the authors of this program? <a href="#" class="nwauthr">New Author</a></h5>
                <div class="auth_wrap">
                    @foreach($authors as $author)
                    <label class="auth_container">{{ $author->firstname }}
                        <input type="radio"  name="author_id[]" value="{{ $author->id }}"  @if(is_array(old('author_id',$programAuthors)) && in_array($author->id, old('author_id',$programAuthors))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 metatag">
                <h5>Tags: What keywords would you like the program to be associated with?</h5>
                <div class="form-group">
                    <strong>Tag:</strong>
                    <input type="text" name="tags" placeholder="Tags" value="{{ old('tags',$program->tags) }}" class="form-control tm-input tm-input-info"/>
                    <!--<input type="hidden" name="hidden-tags" value="{{ old('tags',$program->tags) }}">-->
                </div>
            </div> 
            <div class="col-sm-12 meta-auther">
                <h5>Categories: What categories would you like the program to belong to? <a href="{{ route('admin.program.category.create') }}" class="nwauthr">New Category</a></h5>
                <div class="auth_wrap">
                    @foreach($programCategories as $category)
                    <label class="auth_container">{{ $category->title }}
                        <input type="radio"  name="program_category_id[]"  value="{{ $category->id }}" @if(is_array(old('program_category_id',$programCategoryMaps)) && in_array($category->id, old('program_category_id',$programCategoryMaps))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>      
        <div id="public-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The publication tab controls how and when you want the program to be published.</div>        
            <div class="col-sm-12 meta-auther userAccess">
                <h5>User Access: Who can view the program?</h5>
                <div class="auth_wrap">
                    <label class="auth_container">Everyone
                        <input type="radio"  name="role_id[]" value="" checked="">
                        <span class="checkmark"></span>
                    </label>
                    @foreach($roles as $role)
                    <label class="auth_container">{{ $role->name }}
                        <input type="radio"  name="role_id[]" value="{{ $role->id }}"  @if(is_array(old('role_id',$programRoles)) && in_array($role->id, old('role_id',$programRoles))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 presentation">
                <h5>Presentation Style: How prominent would you like the program to be displayed?</h5>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                    </div> 
                    <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                </div>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Publication: No changes have been made to the program. The option to republish the program will become available when changes have been made.</h5>
                <ul>
                    <li>Schedule for Republication</li>
                    <li><a href="#" data-toggle="modal" data-target="#modal-publication">Republish Now</a></li>
                </ul>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Depublication: You can depublish the program using the settings below.</h5>
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
@include('admin._partial.publication',['message'=>'No changes have been made to the program. The option to republish the program will become available when changes have been made.'])
@include('admin._partial.depublication',['message'=>'This action will make this program inaccessible to your audience. Are you sure you want to depublish the program?'])
@include('admin._partial.coverPopup',['galleries' => $galleries])
@include('admin._partial.resourcePopup',['relatedTo' => 'program'])
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
</script>
@include('admin._partial.formjs')
@endsection('after-script')
