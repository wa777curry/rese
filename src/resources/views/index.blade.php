@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection

@section('search')
<div class="header__search">
    <div class="search__form">
        <select class="select__area">
            <option value="">All area</option>
        </select>
        <select class="select__genre">
            <option value="">All genre</option>
        </select>
        <div class="search__icon"><i class="fa fa-search"></i></div>
        <input class="keyword" type="search" name="keyword" placeholder="Search...">
    </div>
</div>
@endsection

@section('content')
<div class="shop__list">
    @foreach($shops as $shop)
    <div class="shop__list--card">
        <div class="shop__list--img">
            <img src="{{ $shop->image_url }}">
        </div>
        <div class="shop__content">
            <div class="shop__content--name">{{ $shop->shop_name }}</div>
            <div class="shop__content--tag">#{{ $shop->area }}</div>
            <div class="shop__content--tag">#{{ $shop->genre }}</div>
            <div class="shop__content--detail">
                <a href="{{ route('detail', ['id' => $shop->id]) }}"><button class="button" type="submit">詳しく見る</button></a>
                <i class="fa fa-heart-o fa-lg"></i>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection