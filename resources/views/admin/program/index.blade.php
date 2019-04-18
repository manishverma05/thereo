@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#progm-tab">Programs</a></li>
        <li><a data-toggle="tab" href="#cat-tab">Categories</a></li>
        <li><a data-toggle="tab" href="#sess-tab">Sessions</a></li>
        <li><a data-toggle="tab" href="#res-tab">Resources</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>
<div class="tab-content">
    <div id="progm-tab" class="tab-pane fade in active">
        <div class="admin-nav-head">Programs refer to your online video based products.</div>
        <section id="filter">
            <div class="filter_hd">
                <p>You may search, filter, and edit the Programs below.</p>
                <a href="{{ route('admin.program.create') }}" class="nw_article">New Program</a>
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
                    <p>22 Programs</p>
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
                    @foreach ($programs as $program)
                    @php
                    $program_cover_image = asset('administrator/images/no-image.png');
                    $program_cover_image_thumb = asset('administrator/images/no-image.png');
                    if(isset($program->cover_media->file)):
                    $program_cover_image = asset(config('constants.program.cover_path_display').$program->cover_media->file);
                    $program_cover_image_thumb = asset(config('constants.program.cover_path_display').'thumb_'.$program->cover_media->file);
                    endif;
                    @endphp
                    <!-- START: single grid -->
                    <div class="col-sm-3 articles-grid" style="background-image: url('{{ $program_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                        <h3><a href="{{ route('admin.program.update',[$program->unique_id]) }}">{{ $program->title }}</a></h3>
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
                            <td>Author<i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $program)
                        @php
                        $program_cover_image = asset('administrator/images/no-image.png');
                        $program_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($program->cover_media->file)):
                        $program_cover_image = asset(config('constants.program.cover_path_display').$program->cover_media->file);
                        $program_cover_image_thumb = asset(config('constants.program.cover_path_display').'thumb_'.$program->cover_media->file);
                        endif;
                        @endphp
                        <tr>  
                            <td class="checkbox-cell">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="program_id" class="select-td" value="{{ $program->id }}">
                                        <i class="helper"></i>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.program.update',[$program->unique_id]) }}">
                                    <img class="article-thumb" src="{{ $program_cover_image_thumb }}"> 
                                    {{ $program->title }}
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
    <div id="cat-tab" class="tab-pane fade in">
        <div class="admin-nav-head">Categories make it easier to organize and find your programs.</div>
        <section id="filter">
            <div class="filter_hd">
                <p>You may search, filter, and edit the categories below.</p>
                <a href="{{ route('admin.program.category.create') }}" class="nw_article">New Category</a>
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
                    <p>{{ count($programCategories) }} Categories</p>
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
                    <!-- START: grid row -->
                    <div class="row articles-wrapper switch-view">
                        @foreach ($programCategories as $category)
                        @php
                        $category_cover_image = asset('administrator/images/no-image.png');
                        $category_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($category->cover_media->file)):
                        $category_cover_image = asset(config('constants.program.category.cover_path_display').$category->cover_media->file);
                        $category_cover_image_thumb = asset(config('constants.program.category.cover_path_display').'thumb_'.$category->cover_media->file);
                        endif;
                        @endphp
                        <!-- START: single grid -->
                        <div class="col-sm-3 articles-grid" style="background-image: url('{{ $category_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                            <h3><a href="{{ route('admin.program.category.update',[$category->unique_id]) }}" >{{ $category->title }}</a></h3>
                        </div> 
                        <!-- END: single grid -->
                        @endforeach
                    </div>         
                    <!-- END :grid row -->
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
                            <td>Author<i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programCategories as $category)
                        @php
                        $category_cover_image = asset('administrator/images/no-image.png');
                        $category_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($category->cover_media->file)):
                        $category_cover_image = asset(config('constants.program.category.cover_path_display').$category->cover_media->file);
                        $category_cover_image_thumb = asset(config('constants.program.category.cover_path_display').'thumb_'.$category->cover_media->file);
                        endif;
                        @endphp
                        <tr>  
                            <td class="checkbox-cell">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="category_id" class="select-td" value="{{ $category->id }}">
                                        <i class="helper"></i>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.program.category.update',[$category->unique_id]) }}">
                                    <img class="article-thumb" src="{{ $category_cover_image_thumb }}"> 
                                    {{ $category->title }}
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
    <div id="sess-tab" class="tab-pane fade in">
        <div class="admin-nav-head">Programs are made up of video pages, called sessions, that are sequenced together.</div>
        <section id="filter">
            <div class="filter_hd">
                <p>You may search, filter, organize, and edit the sessions listed below.</p>
                <a href="{{ route('admin.session.create') }}" class="nw_article">New Session</a>
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
                    <p>{{ count($sessions) }} Sessions</p>
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
                <!-- START: grid row -->
                <div class="row articles-wrapper switch-view">
                    @foreach ($sessions as $session)
                    @php
                    $session_cover_image = asset('administrator/images/no-image.png');
                    $session_cover_image_thumb = asset('administrator/images/no-image.png');
                    if(isset($session->cover_media->file)):
                    $session_cover_image = asset(config('constants.session.cover_path_display').$session->cover_media->file);
                    $session_cover_image_thumb = asset(config('constants.session.cover_path_display').'thumb_'.$session->cover_media->file);
                    endif;
                    @endphp
                    <!-- START: single grid -->
                    <div class="col-sm-3 articles-grid" style="background-image: url('{{ $session_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                        <h3><a href="{{ route('admin.session.update',[$session->unique_id]) }}" >{{ $session->title }}</a></h3>
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
                            <td>Author<i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                        @php
                        $session_cover_image = asset('administrator/images/no-image.png');
                        $session_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($session->cover_media->file)):
                        $session_cover_image = asset(config('constants.session.cover_path_display').$session->cover_media->file);
                        $session_cover_image_thumb = asset(config('constants.session.cover_path_display').'thumb_'.$session->cover_media->file);
                        endif;
                        @endphp
                        <tr>  
                            <td class="checkbox-cell">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="session_id" class="select-td" value="{{ $session->id }}">
                                        <i class="helper"></i>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.session.update',[$session->unique_id]) }}">
                                    <img class="article-thumb" src="{{ $session_cover_image_thumb }}"> 
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
    <div id="res-tab" class="tab-pane fade in">
        <section id="filter">
            <div class="filter_hd">
                <p>You may search, filter, organize, and edit the sessions listed below.</p>
                <a href="{{ route('admin.resource.create.option') }}" class="nw_article">Add Resource</a>
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
                    <p>{{ count($resources) }} Resources</p>
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
                <!-- START: grid row -->
                <div class="row articles-wrapper switch-view">
                    @foreach ($resources as $resource)
                    @php
                    $resource_cover_image = asset('administrator/images/no-image.png');
                    $resource_cover_image_thumb = asset('administrator/images/no-image.png');
                    if(isset($resource->cover_media->file)):
                    $resource_cover_image = asset(config('constants.resource.cover_path_display').$resource->cover_media->file);
                    $resource_cover_image_thumb = asset(config('constants.resource.cover_path_display').'thumb_'.$resource->cover_media->file);
                    endif;
                    @endphp
                    <!-- START: single grid -->
                    <div class="col-sm-3 articles-grid" style="background-image: url('{{ $resource_cover_image }}');background-size:cover;background-repeat:no-repeat;">
                        <h3><a href="{{ route("admin.resource.update.$resource->type",[$resource->unique_id]) }}">{{ $resource->title }}</a></h3>
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
                            <td>Author<i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                            <td>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resources as $resource)
                        @php
                        $resource_cover_image = asset('administrator/images/no-image.png');
                        $resource_cover_image_thumb = asset('administrator/images/no-image.png');
                        if(isset($resource->cover_media->file)):
                        $resource_cover_image = asset(config('constants.resource.cover_path_display').$resource->cover_media->file);
                        $resource_cover_image_thumb = asset(config('constants.resource.cover_path_display').'thumb_'.$resource->cover_media->file);
                        endif;
                        @endphp
                        <tr>  
                            <td class="checkbox-cell">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="resource_id" class="select-td" value="{{ $resource->id }}">
                                        <i class="helper"></i>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route("admin.resource.update.$resource->type",[$resource->unique_id]) }}">
                                    <img class="article-thumb" src="{{ $resource_cover_image_thumb }}"> 
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
    <div id="analytic-tab" class="tab-pane fade in ">
        <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, all of your programs.</div>
    </div>
</div>   
<!-- Start Navigation -->
@endsection('content')

@section('after-script')
<script>
    $('body').on('click', '.switch-view-button', function () {
        $('.switch-view').toggle();
    });
    $('body').on('click', '.select-th', function () {
        if ($(this)[0].checked) {
            $('body .select-td').prop('checked', true);
        } else {
            $('body .select-td').prop('checked', false);
        }
    });
    $('body').on('click', '.select-td', function () {
        if (!$(this)[0].checked) {
            $('body .select-th').prop('checked', false);
        }
    });
</script>
@endsection('after-script')
