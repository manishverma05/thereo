@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('content')    
@include('admin._partial.cover_edit',['cover'=>$sessionCover,'type'=>'session'])    
@endsection('content')

@section('after-script')
@endsection('after-script')
