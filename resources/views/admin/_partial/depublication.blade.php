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
<div class="modal fade modal-fullscreen" id="modal-depublication" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <!-- Start Admin Header -->
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-8">
                            <div class="rjadmin_breadcrumb_left">
                                <div class="rjadmin_back" data-dismiss="modal"><a href="javascript:void(0)"><i class="fa fa-times"></i></a></div>
                                <div class="rjadmin_back" data-dismiss="modal"><a href="javascript:void(0)">Cancel</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 responder_table main_table_addresource">
                        <table class="table">
                            <tbody>

                                <tr>
                                    <td class="resource_add_red">{{ $message }}</td>
                                </tr>
                                <tr>
                                    <td class="resource_add">
                                        <a href="javascript:void(0)" onclick="formSubmit('0');">Yes</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>