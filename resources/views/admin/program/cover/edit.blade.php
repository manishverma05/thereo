@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('content')    
@include('admin._partial.cover_edit',['cover'=>$programCover,'type'=>'program'])    
@endsection('content')

@section('after-script')
@endsection('after-script')
