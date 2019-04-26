@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#category-tab">Category Details</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta Settings</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
        <!--<li><a data-toggle="tab" href="#public-tab">Publication</a></li>-->
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>

</div>

<!-- Start Navigation -->
<form action="{{ route('admin.program.category.create') }}" method="post" enctype="multipart/form-data">
    @csrf 
    <!-----Article Edit Section------>
    <div class="tab-content">
        <div id="category-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Edit this article using the settings below.</div>
            <div class="col-sm-12 artctitle">
                <h5>Title: What name would you like the category to have?</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter the title for the category.">
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
                        <!--<p><a href="javascript:void(0)">Edit Image</a></p>-->
                    </div>
                </div>   
            </div>
        </div>        
<!--        <div id="public-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The publication tab controls how and when you want the article to be published.</div>        
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
                    <li>Schedule for Republication <input type="date" name="publish" value="{{ old('publish') }}"/></li>
                    <li>Republication Now</li>
                </ul>
            </div>
            <div class="col-sm-12 appearence">
                <h5>Depublication: You can depublish the article using the settings below.</h5>
                <ul>
                    <li>Schedule for Republication <input type="date" name="unpublish" value="{{ old('unpublish') }}"/></li>
                    <li><a href="">Depublish Now</a></li>
                </ul>
            </div>
        </div>-->
        <div id="analytic-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this article in particular.</div>
        </div>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>
@endsection('content')

@section('after-script')
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js">
</script>
<script>
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
