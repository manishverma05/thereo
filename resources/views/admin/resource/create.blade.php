@extends('admin.layouts.app')
@section('after-style')
<style>
    .display-toggle{
        display: none;
    }
</style>
@endsection('after-style')

@section('content') 
<div class="display-toggle" style="display: block !important ">

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-8">
            <div class="rjadmin_breadcrumb_left">
                <div class="rjadmin_back"><a href="javascript:void(0)"><i class="fa fa-times"></i></a></div>
                <div class="rjadmin_back"><a href="javascript:void(0)">Close</a></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 responder_table main_table_addresource">
        <table class="table">
            <tbody>
                <tr>
                    <td class="resource_add">
                        What type of resource will this be?
                    </td>
                </tr>
                <tr>
                    <td class="resource_add">
                        <a href="javascript:void(0)" onclick="switchResouce(1)">Local Product</a>
                    </td>
                </tr>
                <tr>
                    <td class="resource_add">
                        <a href="javascript:void(0)" onclick="switchResouce(2)">Media File</a>
                    </td>
                </tr>
                <tr>
                    <td class="resource_add">
                        <a href="javascript:void(0)" onclick="switchResouce(3)"> External Link</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<form action="{{ route('admin.resource.create') }}" method="post" enctype="multipart-formdata">
    <div id="resouceType1" style="display: none;">
        <div class="rjadmin_navigation">
            <ul class="menu_tab nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#local-tab">Local Product</a></li>
                <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
                <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
                <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="local-tab" class="tab-pane fade in active">
                <div class="admin-nav-head">Some basic details about this media file are shown below.</div>
                <section class="local_start_wrapper">
                    <div class="row">
                        <div class="col-sm-12 local_start_head">
                            <h4><span>Title: </span>What name would you like the resource to have?</h4>
                        </div>
                        <div class="col-sm-12 local_start_title">
                            <input type="text" class="form-control" value="lorem lorem">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 presentation">
                            <h5><span style="color: #fff;">Presentation Style: </span>How prominent would you like the article to be displayed?</h5>
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                                </div><!-- /btn-group -->
                                <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                            </div><!-- /input-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 local_start_head">
                            <h4><span>Product Attachment: </span>This resurce is currently to the product displayed below.</h4> <a href="admin_programs_edit_resources_edit_local_start_attach.php" class="nwauthr">Change Product</a>
                        </div>
                    </div>
                    <div class="row media-wrapper">
                        <div class="col-sm-12 imagewrap">
                            <div class="col-sm-3 covercontainer">
                                <img src="../images/program-2.jpg" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Lorem ipsum </div>
                                </div>
                            </div>
                            <div class="col-sm-9 editimg">
                                <div class="postnbotm">
                                    <h5>black-woman-stressed.jpg</h5>
                                    <p>Edit Product</p>
                                </div>
                            </div>   
                        </div>
                    </div>
                </section>
            </div>
            <div id="cover-tab" class="tab-pane fade in">
                <div class="admin-nav-head">The cover is an image that represents the article. You can change the cover by altering the settings below.</div>
                <div class="col-sm-12 artctitle">
                    <h5><span style="color: #fff;">Cover Title: </span>If you don't want the title of the cover to be the same as the name of the resource, you may input something different here instead.</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" id="usr" value="Write something here...">
                    </div>
                </div> 
                <div class="col-sm-12 artcover">
                    <p><span style="color: #fff;">Cover Image: </span> The cover for this resource is currently attached to the image displayed below.</p>
                    <a href="#">Change Image</a>
                </div> 
                <div class="col-sm-12 imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="../images/program-2.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text">Lorem ipsum </div>
                        </div>
                    </div>
                    <div class="col-sm-9 editimg">
                        <div class="postnbotm">
                            <h5>black-woman-stressed.jpg</h5>
                            <p>Edit Image</p>
                        </div>
                    </div>   
                </div>
            </div>
            <div id="public-tab" class="tab-pane fade in">
                <div class="admin-nav-head">The publication tab controls how and when you want the resource to be published.</div>
                <div class="col-sm-12 appearence">
                    <h5><span style="color: #fff;">Publication: </span>No changes have been made to the program. The option to republish the program will program will become available when changes have been made.</h5>
                    <ul>
                        <li>Schedule for Republication</li>
                        <li>Republication Now</li>
                    </ul>
                </div>
                <div class="col-sm-12 appearence">
                    <h5><span style="color: #fff;">Depublication: </span>You can depublish the program using the settings below.</h5>
                    <ul>
                        <li>Schedule for Depublication</li>
                        <li><a href="admin_programs_edit_resources_edit_local_publication_depublication.php">Depublish Now</a></li>
                    </ul>
                </div>
            </div>
            <div id="analytic-tab" class="tab-pane fade in">
                <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this resource in particular.</div>
            </div>
        </div>    
    </div>
</form>
<form action="{{ route('admin.resource.create') }}" method="post" enctype="multipart-formdata">
    <div id="resouceType2" style="display: none;">
        <div class="rjadmin_navigation">
            <ul class="menu_tab nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#media-tab"> Media File</a></li>
                <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
                <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
                <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="media-tab" class="tab-pane fade in active">
                <div class="admin-nav-head">Attach an existing file from the media library (pdf, document, etc.), to the resource, using the settings below.</div>
                <section class="local_start_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="artctitle">
                                <h5>Title: What name would you like the resource to have?</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usr" value="Lorem ipsum dolor sit amet...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="presentation">
                                <h5><span style="color: #fff;">Presentation Style: </span>How prominent would you like the article to be displayed?</h5>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                                    </div><!-- /btn-group -->
                                    <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 artcover">
                        <p><span style="color: #fff;">Media Attachment:</span>This resource is currently attached to the media file displayed below.</p>
                        <a href="#">Change Media</a>
                    </div> 
                    <div class="col-sm-12 imagewrap media-wrapper">
                        <div class="col-sm-3 covercontainer">
                            <img src="../images/program-2.jpg" alt="Avatar" class="image" style="width:100%">
                            <div class="middle">
                                <div class="text">Lorem ipsum </div>
                            </div>
                        </div>
                        <div class="col-sm-9 editimg">
                            <div class="postnbotm">
                                <h5>.pdf</h5>
                                <p>Edit Media</p>
                            </div>
                        </div>   
                    </div>
                </section>
            </div>
            <div id="cover-tab" class="tab-pane fade in">
                <div class="admin-nav-head">The cover is an image that represents the article. You can change the cover by altering the settings below.</div>
                <div class="col-sm-12 artctitle">
                    <h5><span style="color: #fff;">Cover Title: </span>If you don't want the title of the cover to be the same as the name of the resource, you may input something different here instead.</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" id="usr" value="Write something here...">
                    </div>
                </div> 
                <div class="col-sm-12 artcover">
                    <p><span style="color: #fff;">Cover Image: </span> The cover for this resource is currently attached to the image displayed below.</p>
                    <a href="#">Change Image</a>
                </div> 
                <div class="col-sm-12 imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="../images/program-2.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text">Lorem ipsum </div>
                        </div>
                    </div>
                    <div class="col-sm-9 editimg">
                        <div class="postnbotm">
                            <h5>black-woman-stressed.jpg</h5>
                            <p>Edit Image</p>
                        </div>
                    </div>   
                </div>
            </div>
            <div id="public-tab" class="tab-pane fade in">
                <div class="admin-nav-head">The publication tab controls how and when you want the resource to be published.</div>
                <div class="col-sm-12 appearence">
                    <h5><span style="color: #fff;">Publication: </span>No changes have been made to the program. The option to republish the program will program will become available when changes have been made.</h5>
                    <ul>
                        <li>Schedule for Republication</li>
                        <li>Republication Now</li>
                    </ul>
                </div>
                <div class="col-sm-12 appearence">
                    <h5><span style="color: #fff;">Depublication: </span>You can depublish the program using the settings below.</h5>
                    <ul>
                        <li>Schedule for Depublication</li>
                        <li><a href="admin_programs_edit_resources_edit_local_publication_depublication.php">Depublish Now</a></li>
                    </ul>
                </div>
            </div>
            <div id="analytic-tab" class="tab-pane fade in">
                <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this resource in particular.</div>
            </div>
        </div>
    </div>
</form>
<form action="{{ route('admin.resource.create') }}" method="post" enctype="multipart-formdata">
    <div id="resouceType3" style="display: none;">
        <div class="rjadmin_navigation">
            <ul class="menu_tab nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#media-tab"> External Link</a></li>
                <li><a data-toggle="tab" href="#cover-tab">Cover Settings</a></li>
                <li><a data-toggle="tab" href="#public-tab">Publication</a></li>
                <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="media-tab" class="tab-pane fade in active">
                <div class="admin-nav-head">Attach an external link (https://example.com), as the resource, using the settings below.</div>
                <section class="local_start_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="artctitle">
                                <h5>Title: What name would you like the resource to have?</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="usr" value="Lorem ipsum dolor sit amet...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="presentation">
                                <h5><span style="color: #fff;">Presentation Style: </span>How prominent would you like the article to be displayed?</h5>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></button>
                                    </div><!-- /btn-group -->
                                    <input type="text" class="form-control" aria-label="..." value="Dynamic Profile">
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 artcover">
                        <p><span style="color: #fff;">Link Attachment:</span> This resource is currently attached to the link displayed below.</p>
                    </div> 
                    <div class="col-sm-12 imagewrap media-wrapper">
                        <div class="col-sm-3 covercontainer">
                            <img src="../images/program-2.jpg" alt="Avatar" class="image" style="width:100%">
                            <div class="middle">
                                <div class="text">Lorem ipsum </div>
                            </div>
                        </div>
                        <div class="col-sm-9 editimg">
                            <div class="postnbotm">
                                <h5>Link Attachment:</h5>
                                <p>Edit Link</p>
                            </div>
                        </div>   
                    </div>
                </section>
            </div>
            <div id="cover-tab" class="tab-pane fade in">
                <div class="admin-nav-head">The cover is an image that represents the article. You can change the cover by altering the settings below.</div>
                <div class="col-sm-12 artctitle">
                    <h5><span style="color: #fff;">Cover Title: </span>If you don't want the title of the cover to be the same as the name of the resource, you may input something different here instead.</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" id="usr" value="Write something here...">
                    </div>
                </div> 
                <div class="col-sm-12 artcover">
                    <p><span style="color: #fff;">Cover Image: </span> The cover for this resource is currently attached to the image displayed below.</p>
                    <a href="#">Change Image</a>
                </div> 
                <div class="col-sm-12 imagewrap">
                    <div class="col-sm-3 covercontainer">
                        <img src="../images/program-2.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text">Lorem ipsum </div>
                        </div>
                    </div>
                    <div class="col-sm-9 editimg">
                        <div class="postnbotm">
                            <h5>black-woman-stressed.jpg</h5>
                            <p>Edit Image</p>
                        </div>
                    </div>   
                </div>
            </div>
            <div id="public-tab" class="tab-pane fade in">
                <div class="admin-nav-head">The publication tab controls how and when you want the resource to be published.</div>
                <div class="col-sm-12 appearence">
                    <h5><span style="color: #fff;">Publication: </span>No changes have been made to the program. The option to republish the program will program will become available when changes have been made.</h5>
                    <ul>
                        <li>Schedule for Republication</li>
                        <li>Republication Now</li>
                    </ul>
                </div>
                <div class="col-sm-12 appearence">
                    <h5><span style="color: #fff;">Depublication: </span>You can depublish the program using the settings below.</h5>
                    <ul>
                        <li>Schedule for Depublication</li>
                        <li><a href="admin_programs_edit_resources_edit_local_publication_depublication.php">Depublish Now</a></li>
                    </ul>
                </div>
            </div>
            <div id="analytic-tab" class="tab-pane fade in">
                <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, this resource in particular.</div>
            </div>
        </div>     
    </div>
</form>
@endsection('content')

@section('after-script')
<script>
    function switchResouce(viewNum) {
        $('.display-toggle').toggle();
        $('#resouceType' + viewNum).show();
    }
</script>
@endsection('after-script')
