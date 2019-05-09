@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('content')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<p>
    This is the most minimal example of Dropzone. The upload in this example
    doesn't work, because there is no actual server to handle the file upload.
</p>
<!-- Change /upload-target to your upload address -->
<form action="{{ route('admin.media.add') }}" class="dropzone">
    @csrf
</form>
@endsection('content')

@section('after-script')
<script src="{{ asset('administrator/js/dropzone.js') }}"></script>
@endsection('after-script')
