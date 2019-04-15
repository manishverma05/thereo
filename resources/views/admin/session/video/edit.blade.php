@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('content')    
@include('admin._partial.video_edit',['attachment'=>$sessionAttachment,'type'=>'session'])    
@endsection('content')

@section('after-script')
@endsection('after-script')
