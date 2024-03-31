@extends('layouts.app-ad')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">CSV取り込み内容</div>
                <div class="card-body">
                    @if (count($shops) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>代表者ID</th>
                                <th>店舗名</th>
                                <th>エリアID</th>
                                <th>ジャンルID</th>
                                <th>店舗概要</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $data)
                            <tr>
                                <td width="100px" nowrap>{{ $data['representative_id'] }}</td>
                                <td width="100px" nowrap>{{ $data['shop_name'] }}</td>
                                <td width="100px" nowrap>{{ $data['area_name'] }}</td>
                                <td width="100px" nowrap>{{ $data['genre_name'] }}</td>
                                <td width="400px" nowrap>{{ $data['shop_summary'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>取り込みデータはありません</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection