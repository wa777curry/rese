@section('search−2')
<div class="header__search">
    <div class="search__form">
        <select class="select__area" name="area_id">
            @foreach($areas as $areaId => $areaName)
                <option value="{{ $areaId }}">{{ $areaName }}</option>
            @endforeach
        </select>
        <select class="select__genre" name="genre_id">
            @foreach($genres as $genreId => $genreName)
                <option value="{{ $genreId }}">{{ $genreName }}</option>
            @endforeach
        </select>
        <div class="search__icon"><i class="fa fa-search"></i></div>
        <input class="keyword" type="search" name="keyword" placeholder="Search...">
    </div>
</div>
@endsection
