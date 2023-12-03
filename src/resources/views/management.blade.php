@extends('layouts.app')

@section('content')
<form action="{{ route('postManagement') }}" method="post">
    @csrf

    <div>
        <label for="shop_name">店舗名:</label>
        <input type="text" id="shop_name" name="shop_name" required>
    </div>
    <div>
        <label for="area">地域:</label>
        <input type="text" id="area" name="area" required>
    </div>
    <div>
        <label for="genre">ジャンル:</label>
        <input type="text" id="genre" name="genre" required>
    </div>
    <div>
        <label for="shop_summary">店舗概要:</label>
        <textarea id="shop_summary" name="shop_summary" rows="5" cols="50" required></textarea>
    </div>
    <div>
        <label for="image_url">画像URL:</label>
        <input type="text" id="image_url" name="image_url" required>
    </div>
    <div>
        <button type="submit">登録する</button>
</form>
@endsection