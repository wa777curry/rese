@extends('layouts.app-ad')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<!-- resources/views/upload.blade.php -->
<form action="/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">アップロード</button>
</form>
@endsection