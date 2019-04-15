@extends('admin.layouts.app')

@section('after-style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.css">
@endsection('after-style')

@section('content')
<!--@if ($errors->any())
{{ implode('', $errors->all(':message')) }}
@endif-->
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#progdetail-tab">Program Details</a></li>
        <li><a data-toggle="tab" href="#session-tab">Sessions</a></li>
        <li><a data-toggle="tab" href="#update-tab">Updates</a></li>
        <li><a data-toggle="tab" href="#overview-tab">Overview Page</a></li>
        <li><a data-toggle="tab" href="#resource-tab">Resource Page</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta Settings</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
        <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>

</div>

<!-- Start Navigation -->
<form action="{{ route('admin.program.create') }}" method="post" enctype="multipart/form-data">
    @csrf 
    <!-----Article Edit Section------>
    <div class="tab-content">
        <div id="progdetail-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Edit this article using the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the program to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter the title for the program.">
                    @if ($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
            </div> 
        </div>
        <div id="session-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Programs are made up of video pages, called sessions, that are sequenced together.</div>
            <section id="filter">
                <div class="col-md-12 responder_table">
                    <table class="table switch-view">
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
                                <td>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="session_id[]" class="select-session-td" value="{{ $session->id }}" @if(is_array(old('session_id')) && in_array($session->id, old('session_id'))) checked @endif>
                                                   <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript::void(0)">
                                        <img class="article-thumb" src="../images/session-1.jpg"> 
                                        {{ $session->title }}
                                    </a>
                                </td>
                                <td><a href="javascript::void(0)">Feedback</a></td>
                                <td><a href="javascript::void(0)">Bradly Mence</a></td>
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
                    <p>You may search, filter, organize, and edit the resources listed below.</p>
                    <a href="#" class="nw_article">New Update</a>
                </div>
                <div class="filter_option col-md-12">
                    <div class="col-sm-2">
                        <input type="text" value="Search">
                    </div> 
                    <div class="col-sm-2">
                        <select>
                            <option>Filter</option>
                        </select>
                    </div> 
                    <div class="col-sm-5">
                        <p>7 Resources</p>
                    </div> 
                    <div class="col-sm-1">
                       <!-- <select>
                          <option>Actions</option>
                       </select>
                       <a class="conf_btn" href="#">Confirm</a> -->
                        <a class="grid-btn" href="#"> <i class="fa fa-th-list"></i> </a>
                    </div> 
                    <div class="col-sm-2">

                        <select>
                            <option>Actions</option>
                        </select>
                        <a class="conf_btn" href="#">Confirm</a>
                    </div> 
                </div>
                <div class="col-md-12 responder_table">          
                    <table class="table">
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
                                <td>Title <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td class="view_type_right">Type <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    Lorem Ipsum
                                </td>

                                <td class="view_type_right">Bradly Mence
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>

                            </tr>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    Lorem Ipsum                
                                </td>

                                <td class="view_type_right">Bradly Mence
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>

                            </tr>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td> 
                                    Lorem Ipsum
                                </td>

                                <td class="view_type_right">Bradly Mence
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>

                            </tr>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td> Lorem Ipsum </td>

                                <td class="view_type_right">Bradly Mence
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>

                            </tr>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td> Lorem Ipsum</td>

                                <td class="view_type_right">Bradly Mence
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>
                            </tr>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td> Lorem Ipsum</td>

                                <td class="view_type_right">Bradly Mence
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>
                            </tr>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" value="">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td> Lorem Ipsum</td>

                                <td class="view_type_right">Bradly Mence
                                    <i class="fa fa-arrows-v" style="font-size: 22px; color: #8FB8C9; margin-left: 16px;"></i></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div id="overview-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Programs are made up of video pages, called sessions, that are sequenced together.</div>
            <div class="admin-nav-head">The overview page provides your audience with information about the program; in addition to displaying all the section videos involved within it.</div>
            <div class="col-sm-12 artctitle">
                <h5>Alternative Title: If you don't want the title of the page to be the same as the name of the program, you may input something different instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title_alt" value="{{ old('title_alt') }}" placeholder="Alternative Title">
                    @if ($errors->has('title_alt'))
                    <div class="text-danger">{{ $errors->first('title_alt') }}</div>
                    @endif
                </div>
            </div> 
            <div class="col-sm-12 artcontent">
                <h5>Description: What would you like to say about the program?</h5>
                <div class="form-group">
                    <textarea name="description" id="editor" placeholder="Enter description.">
                       {{ old('description') }}
                    </textarea>
                </div>
            </div> 
        </div>
        <div id="resource-tab" class="tab-pane fade in">
            <section id="filter">
                <div class="col-md-12 responder_table">
                    <table class="table switch-view">
                        <thead>
                            <tr>
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="" class="select-resource-th">
                                            <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>Title <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td>Author<i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                                <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($resources as $resource)
                            <tr>  
                                <td class="checkbox-cell">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="resource_id[]" class="select-resource-td" value="{{ $resource->id }}" @if(is_array(old('resource_id')) && in_array($resource->id, old('resource_id'))) checked @endif>
                                                   <i class="helper"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript::void(0)">
                                        <img class="article-thumb" src="../images/resource-1.jpg"> 
                                        {{ $resource->title }}
                                    </a>
                                </td>
                                <td><a href="javascript::void(0)">Feedback</a></td>
                                <td><a href="javascript::void(0)">Bradly Mence</a></td>
                                <td><a href="javascript::void(0)">18/07/22</a></td>
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
                    <input type="text" name="tags" placeholder="Tags" class="form-control tm-input tm-input-info"/>
                </div>
            </div> 
            <div class="col-sm-12 meta-auther">
                <h5>Categories: What categories would you like the article to belong to? <a href="#" class="nwauthr">New Category</a></h5>
                <div class="auth_wrap">
                    @foreach($programCategories as $category)
                    <label class="auth_container">{{ $category->title }}
                        <input type="radio"  name="program_category_id[]"  value="{{ $category->id }}" @if(is_array(old('program_category_id')) && in_array($category->id, old('program_category_id'))) checked @endif >
                               <span class="checkmark"></span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="cover-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The cover is an image that represents the article. You can change the cover by altering the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Cover Title: If you don't want the title of the cover to be the same as the name of the article, you may input something different here instead.</h5>
                <div class="form-group">
                    <input type="text" class="form-control"  value="{{ old('cover_title') }}" name="cover_title">
                </div>
            </div> 
            <div class="col-sm-12 artcover">
                <p>Content: What would you like to say in the article?</p>
                <a href="javascript::void(0)" onclick="$('[name=cover_image]').click()">Add Cover</a>
                <input type="file" name="cover_image" accept="image/*" style="display: none;" onchange="readURL(this);" />
            </div> 
            <div class="col-sm-12 imagewrap">
                <div class="col-sm-3 covercontainer">
                    <img src="{{ asset('administrator/images/no-image.png') }}" alt="Cover Image" id="cover_image_preview" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text cover_image_name"></div>
                    </div>

                </div>
                <div class="col-sm-9 editimg" style="display: none;">
                    <div class="postnbotm">
                        <h5 class="cover_image_name"></h5>
                        <!--<p><a href="admin_program_edit_cover_media.php">Edit Image</a></p>-->
                    </div>
                </div>   
            </div>
        </div>
        
        <div id="public-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The publication tab controls how and when you want the article to be published.</div>        
            <div class="col-sm-12 meta-auther userAccess">
                <h5>Access Level</h5>
                <div class="auth_wrap">
                    @foreach($roles as $role)
                    <label class="auth_container">{{ $role->name }}
                        <input type="radio"  name="role_id[]" value="{{ $role->id }}"  @if(is_array(old('role_id')) && in_array($role->id, old('role_id'))) checked @endif >
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
                    </div><!-- /btn-group -->
                    <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                </div><!-- /input-group -->
            </div>
            <div class="col-sm-12 appearence">
                <h5>Publication: How would you like to republish the article?</h5>
                <ul>
                    <li>Schedule for Republication</li>
                    <li><input type="date" name="publish" value="{{ old('publish') }}"/></li>
                </ul>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Depublication: You can depublish the article using the settings below.</h5>
                <ul>
                    <li>Schedule for Republication</li>
                    <li><input type="date" name="unpublish" value="{{ old('unpublish') }}"/></li>
                </ul>
            </div>
        </div>
        <div id="analytic-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this article in particular.</div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Add Program</button>
</form>
@endsection('content')

@section('after-script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tagmanager/3.0.2/tagmanager.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

    $(document).ready(function () {
        $(".tm-input").tagsManager();
    });
    //Select deselect session
    $('body').on('click', '.select-session-th', function () {
        if ($(this)[0].checked) {
            $('body .select-session-td').prop('checked', true);
        } else {
            $('body .select-session-td').prop('checked', false);
        }
    });
    $('body').on('click', '.select-session-td', function () {
        if (!$(this)[0].checked) {
            $('body .select-session-th').prop('checked', false);
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#cover_image_preview').attr('src', e.target.result);
            };
            $('.editimg').show();
            $('.cover_image_name').text(input.files[0].name);
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection('after-script')
