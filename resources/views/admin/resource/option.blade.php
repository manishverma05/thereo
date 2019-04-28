@extends('admin.layouts.app')
@section('after-style')
<style>
    .breadcrumb-section{
        visibility: hidden;
    }
</style>
@endsection('after-style')
@section('content') 
<div class="display-toggle">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-8">
            <div class="rjadmin_breadcrumb_left">
                <div class="rjadmin_back"><a href="javascript:void(0)" onclick="goBack()"><i class="fa fa-times"></i></a></div>
                <div class="rjadmin_back"><a href="{{ route("admin.$relatedTo.update",[$$relatedTo->unique_id]) }}">Close</a></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 responder_table main_table_addresource">
        <table class="table">
            <tbody>
                <tr>
                    <td class="resource_add">
                        What type of material will this be?
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
</div>   
@endsection('content')