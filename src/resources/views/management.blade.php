@extends('layouts.app')

@section('content')
<form action="{{ route('postManagement') }}" method="post">
    @csrf
    <div>
        <label for="shop_name">店舗名　　:</label>
        <input type="text" id="shop_name" name="shop_name" required value="{{ old('shop_name') }}">
    </div>
    <div>
        <label for="area">地域　　　:</label>
        <select id="area" name="area_id" required>
            @foreach($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="genre">ジャンル　:</label>
        <select id="genre" name="genre_id" required>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="shop_summary">店舗概要　:</label>
        <textarea id="shop_summary" name="shop_summary" rows="3" cols="70" required>{{ old('shop_summary') }}</textarea>
    </div>
    <div>
        <label for="image_url">画像ＵＲＬ:</label>
        <input type="text" id="image_url" name="image_url" required value="{{ old('image_url') }}">
    </div>
    <div>
        <button type="submit">登録する</button>
    </div>
</form>
@endsection