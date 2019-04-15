@php
switch($type){
case 'session':
$displayPath = config('constants.session.cover_path_display');
break;
case 'program':
$displayPath = config('constants.program.cover_path_display');
break;
}
$cover_image = asset('administrator/images/no-image.png');
$cover_image_thumb = asset('administrator/images/no-image.png');
$filename = '';
if(isset($cover->file)):
$filename = $cover->file; 
$cover_image = asset($displayPath.$cover->file);
$cover_image_thumb = asset($displayPath.'thumb_'.$cover->file);
endif;
@endphp
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#media-tab">Media Details</a></li>
        <li><a data-toggle="tab" href="#setting-tab">Settings</a></li>
        <li><a data-toggle="tab" href="#meta-tab">Meta</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>
    </ul>
</div>
<div class="tab-content">
    <div id="media-tab" class="tab-pane fade in active">
        <div class="admin-nav-head">Details about the media file are displayed below.</div> 
        <section class="media-info">
            <div class="row media-wrapper">
                <div class="col-sm-3">
                    <img src="{{ $cover_image }}">
                </div>
                <div class="col-sm-9" style="padding-top: 6%;">
                    <div class="media-row">
                        <p>Uploaded on <span>{{ $cover->created_at }}</span></p>
                    </div>
                    <div class="media-row">
                        <p>Is <span>141 KB</span> in size.</p>
                    </div>
                    <div class="media-row">
                        <p>Is <span>575x361</span> pixels large.</p>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <div id="setting-tab" class="tab-pane fade in">
    </div>
    <div id="meta-tab" class="tab-pane fade in">
    </div>
    <div id="analytic-tab" class="tab-pane fade in">
    </div>
</div>