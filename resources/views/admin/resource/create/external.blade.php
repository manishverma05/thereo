@extends('admin.layouts.app')
@section('after-style')
@endsection('after-style')
@section('content')
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#external-tab"> External File</a></li>
        <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
        <!--<li><a data-toggle="tab" href="#public-tab">Publication</a></li>-->
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>
<form action="{{ route("admin.$relatedTo.resource.create.external",[$$relatedTo->unique_id]) }}" method="post" enctype="multipart/form-data">
    @csrf 
    <div class="tab-content">
        <div id="local-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Attach an existing file from the media library (pdf, document, etc.), to the resource, using the settings below.</div>
            <section class="local_start_wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="artctitle">
                            <h5>Title: What name would you like the program to have?</h5>
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter the title for the program.">
                            </div>
                        </div>
                    </div>
                </div>
<!--                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="presentation">
                            <h5><span style="color: #fff;">Presentation Style: </span>How prominent would you like the article to be displayed?</h5>
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                                </div> /btn-group 
                                <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                            </div> /input-group 
                        </div>
                    </div>
                </div>-->
                <div class="col-sm-12 artcover">
                    <p><span style="color: #fff;">Cover Image: </span> The cover for this resource is currently attached to the image displayed below.</p>
                    <a href="javascript::void(0)" onclick="$('[name=attachment]').click()">Add Attachment</a>
                    <input type="file" name="attachment" style="display: none;" onchange="readAttachmentURL(this);" />
                </div> 
                <div class="col-sm-12 imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="{{ asset('administrator/images/no-image.png') }}" alt="attachment" id="attachment_preview" class="image"  style="width:100%" >
                        <div class="middle">
                            <div class="text attachment_name"></div>
                        </div>
                    </div>
                    <div class="col-sm-9 editimg editAttachment" style="display:none;">
                        <div class="postnbotm">
                            <h5 class="attachment_name"></h5>
                            <!--<p><a href="javascript:void(0)"> Edit Attachment</a></p>-->
                        </div>
                    </div>   
                </div>
            </section>
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
<!--        <div id="public-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The publication tab controls how and when you want the resource to be published.</div>
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
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this resource in particular.</div>
        </div>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary">Add Resource</button>        
</form>
@endsection('content')
@section('after-script')
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
    function readAttachmentURL(input) {
        if (input.files && input.files[0]) {
            $('.editAttachment').show();
            $('.attachment_name').text(input.files[0].name);
            var fileUrl = window.URL.createObjectURL(input.files[0]);
            $("#attachment_preview").attr("src", fileUrl);
        }
    }
</script>
@endsection('after-script')
