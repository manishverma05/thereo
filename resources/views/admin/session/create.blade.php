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
        <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta Settings</a></li>
        <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>

<form action="{{ url()->current() }}" method="post" enctype="multipart/form-data" id="form">
    @csrf 
    <input type="hidden" name="status" value="{{ old('status') }}"/>
    <div class="tab-content">
        <div id="session-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">The session page describes what the session is about.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the session to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Session title.">
                </div>
            </div>  
            <div class="col-sm-12 artctitle">
                <h5>Alternative Title: If you don't want the title of the page to be the same as the name of the session, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title_alt" value="{{ old('title_alt') }}" placeholder="Write something here...">
                </div>
            </div>
            <div class="col-sm-12 artcontent">
                <h5>Description: What would you like to say about the session?</h5>
                <div class="form-group">
                    <textarea name="description" id="editor" placeholder="Enter description.">
                       {{ old('description') }}
                    </textarea>
                </div>
            </div> 
        </div>
        <div id="attachment-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The session The video and material represents the main content of the session. Use the settings below to attach a video and material to the session.</div>
            <div class="col-sm-12 artcover">
                <p><span style="color: #fff;">Video Attachment: </span> This session is currently attached to the video displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-videoPopup">Attach Video</a>
            </div> 
            <div class="col-sm-12 media-wrapper">
                <div class="imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <input type="hidden" name="video_id" value=""/>
                        <video src="#" alt="video" id="video_attach_preview" class="image vdo"  style="width:100%" controls="">
                            <div class="middle">
                                <div class="text video_attach_name"></div>
                            </div>
                    </div>
                    <div class="col-sm-9 editimg video_attach_detail" style="display:none;">
                        <div class="postnbotm">
                            <h5 class="video_attach_name"></h5>
                            <!--<p><a href="javascript:void(0)"> Edit Video</a></p>-->
                        </div>
                    </div>   
                </div>
            </div>
            <div class="col-sm-12 artcover">
                <p><span style="color: #fff;">Material Attachment: </span> The material for this session is currently attached to the file displayed below.</p>
                <a href="#" data-toggle="modal" data-target="#modal-materialPopup">Attach Material</a>
            </div> 
            <div class="col-sm-12 media-wrapper">
                <div class="imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="{{ asset(config('constants.media.default_media_path_display')) }}" alt="material Image" id="material_preview" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text material_name"></div>
                        </div>
                    </div>
                    <input type="hidden" name="material_id" value=""/>
                    <div class="col-sm-9 editimg material_detail" style="display: none;">
                        <div class="postnbotm">
                            <h5 class="material_name"></h5>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <div id="meta-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The meta tab controls information relating to search engines - in addition to settings that help organize the article.</div>
            <div class="col-sm-12 artclmeta">
                <h5>URL: What address would you like the article to have?</h5>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">https//mythereo.com/articles/</span>
                    <input type="text" name="slug" class="form-control" id="basic-url" aria-describedby="basic-addon3" value="{{ old('slug')}}" placeholder="Enter prefer path without spaces.">
                </div>
            </div> 
            <div class="col-sm-12 meta-auther">
                <h5>Authors: Who are the authors of this article? <a href="#" class="nwauthr">New Author</a></h5>
                <div class="auth_wrap">
                    @foreach($authors as $author)
                    <label class="auth_container">{{ $author->firstname }}
                        <input type="radio"  name="author_id[]" value="{{ $author->id }}"  @if(is_array(old('author_id')) && in_array($author->id, old('author_id'))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 metatag">
                <h5>Tags: What keywords would you like the article to be associated with?</h5>
                <div class="form-group">
                    <strong>Tag:</strong>
                    <input type="text" name="tags" placeholder="Tags" value="{{ old('tags') }}" class="form-control tm-input tm-input-info"/>
                </div>
            </div> 
            <div class="col-sm-12 meta-auther">
                <h5>Categories: What categories would you like the article to belong to? <a href="{{ route('admin.session.category.create') }}" class="nwauthr">New Category</a></h5>
                <div class="auth_wrap">
                    @foreach($sessionCategories as $category)
                    <label class="auth_container">{{ $category->title }}
                        <input type="radio"  name="session_category_id[]"  value="{{ $category->id }}" @if(is_array(old('session_category_id')) && in_array($category->id, old('session_category_id'))) checked @endif >
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
                    <input type="text" class="form-control"  value="{{ old('cover_title') }}" name="cover_title">
                </div>
            </div>
            <div class="col-sm-12 artcover">
                <p>Image: The session is currently associated with the image displayed below.</p>
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
                        <input type="radio"  name="role_id[]" value="{{ $role->id }}"  @if(is_array(old('role_id')) && in_array($role->id, old('role_id'))) checked @endif >
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
                <ul style="opacity:0.5">
                    <li>Schedule for Republication</li>
                    <li>Republish Now</li>
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
@include('admin._partial.depublication',['message'=>'This action will make this session inaccessible to your audience. Are you sure you want to depublish the program?'])
@include('admin._partial.coverPopup',['galleries' => $galleries])
@include('admin._partial.videoPopup',['galleries' => $galleries])
@include('admin._partial.materialPopup',['galleries' => $galleries])
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
