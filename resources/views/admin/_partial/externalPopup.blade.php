<style>
    .modal-fullscreen{
        padding: 0 !important;
    }
    .modal-dialog {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .modal-content {
        height: auto;
        min-height: 100%;
        border: 0 none;
        border-radius: 0;
    }
    .modal-content{
        background: #292c32;
    }
</style>
<!-- Modal Fullscreen -->
<div class="modal fade modal-fullscreen" id="modal-externalPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="gallery_wrap">
                        <!-- Start Admin Header -->
                        <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-8">
                                <div class="rjadmin_breadcrumb_left">

                                    <div class="rjadmin_back"><a href="#" data-dismiss="modal"><i class="fa fa-close"></i></a></div>
                                    <div class="rjadmin_back"><a href="#"  data-dismiss="modal">Cancel</a></div>
                                </div>
                            </div>
                        </div>
                        <!-- End Admin Header -->

                        <!-- Start Navigation -->
                        <br>
                        <section id="filter">
                            <div class="filter_hd" style="margin-bottom: 5px;margin-top: 5px;">
                                <p>Upload a new image, or select on from the library below, to attach it as a external, to the article you wish to make.</p>
                                <a href="{{ route('admin.media.add') }}" target="_blank"  class="nw_article">Upload Images</a>
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
                                    <p>100 Images</p>
                                </div> 
                                <div class="col-sm-2">

                                </div> 
                                <div class="col-sm-1">
                                    <a class="grid-btn" href="#"> <i class="fa fa-th-list"></i> </a>
                                </div> 
                            </div>
                            @php $galleries_chunk = array_chunk($galleries->toArray(),4); @endphp
                            <div class="col-md-12 responder_table"> 
                                @foreach($galleries_chunk as $galleries)
                                <!-- START: grid row -->
                                <div class="row articles-wrapper gallery-grid">
                                    @foreach($galleries as $gallery)
                                    @if(isset($gallery['file']) && !empty($gallery['file']))
                                    @php 
                                    $gallery_file = asset(config('constants.media.media_path_display').$gallery['file']);
                                    @endphp
                                    <!-- START: single grid -->
                                    <div class="col-sm-3 covercontainer" onclick="updateExternal(this)" style="padding: 2px;">
                                        <img src="{{ $gallery_file }}" data-name="{{ $gallery['file'] }}" id="{{ $gallery['id'] }}" class="image" style="width:100%">
                                        <div class="middle">
                                            <div class="text ">{{ $gallery['file'] }}</div>
                                        </div>
                                    </div>
                                    <!-- END: single grid -->
                                    @endif
                                    @endforeach
                                </div>  
                                <!-- END :grid row -->
                            </div>
                            @endforeach
                        </section>
                        <!-- Start Navigation -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>