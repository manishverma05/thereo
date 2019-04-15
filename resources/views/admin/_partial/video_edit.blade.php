@php
switch($type){
case 'session':
$displayPath = config('constants.session.video_path_display');
break;
case 'program':
$displayPath = config('constants.program.video_path_display');
break;
}
$video = asset('administrator/images/no-image.png');
$video_thumb = asset('administrator/images/no-image.png');
$filename = '';
if(isset($attachment->file)):
$filename = $attachment->file; 
$video = asset($displayPath.$attachment->file);
$video_thumb = asset($displayPath.'thumb_'.$attachment->file);
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
                <div class="col-sm-3 covercontainer">
                    <video src="{{ $video }}" alt="video" id="video_attach_preview" class="image vdo"  style="width:100%" autoplay="">
                        <div class="middle">
                            <div class="text video_attach_name">{{ $filename }}</div>
                        </div>
                </div>
                <div class="col-sm-9" style="padding-top: 6%;">
                    <div class="media-row">
                        <p>Uploaded on <span>{{ $attachment->created_at }}</span></p>
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