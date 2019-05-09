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
<div class="modal fade modal-fullscreen" id="modal-resourcePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                            <a href="{{ route("admin.$relatedTo.resource.create.local",[$$relatedTo->unique_id]) }}">Local Product</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="resource_add">
                                            <a href="{{ route("admin.$relatedTo.resource.create.media",[$$relatedTo->unique_id]) }}">Media File</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="resource_add">
                                            <a href="{{ route("admin.$relatedTo.resource.create.external",[$$relatedTo->unique_id]) }}"> External Link</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Start Navigation -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>