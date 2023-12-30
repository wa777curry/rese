@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@endsection

@section('search')
<div class="header__search">
    <form action="{{ route('index') }}" method="get">
        @csrf
        <div class="search__form">
            <select class="select__area" id="a" name="a" onchange="submit(this.form)">
                <option value="">All area</option>
                @foreach($areas as $area)
                <option value="{{ $area->id }}" @if($a==$area->id) selected @endif>{{ $area->area_name }}</option>
                @endforeach
            </select>
            <select class="select__genre" id="g" name="g" onchange="submit(this.form)">
                <option value="">All genre</option>
                @foreach($genres as $genre)
                <option value="{{ $genre->id }}" @if($g==$genre->id) selected @endif>{{ $genre->genre_name }}</option>
                @endforeach
            </select>
            <div class="search__icon"><i class="fa fa-search"></i></div>
            <input class="keyword" type="search" id="k" name="k" value="{{ $k }}" placeholder="Search...">
        </div>
    </form>
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
            <div class="shop__content--tag">#{{ $shop->area_name }}</div>
            <div class="shop__content--tag">#{{ $shop->genre_name }}</div>
            <div class="shop__content--detail">
                <a href="{{ route('detail', ['id' => $shop->id]) }}"><button class="button" type="submit">詳しく見る</button></a>
                @auth
                    @if(auth()->user()->favorites->contains($shop->id))
                        <!-- お気に入り登録済みの場合 -->
                        <form action="{{ route('nofavorite', ['shop' => $shop->id]) }}" method="get">
                            @csrf
                            <button class="f-button" type="submit"><i class="fa fa-heart fa-lg fa-2x on-color"></i></button>
                        </form>
                    @else
                        <!-- お気に入り未登録の場合 -->
                        <form action="{{ route('favorite', ['shop' => $shop->id]) }}" method="get">
                            @csrf
                            <button class="f-button" type="submit"><i class="fa fa-heart fa-lg fa-2x off-color"></i></button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection