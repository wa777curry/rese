<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Genre;
use DB;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request) {
        $areas = Area::all();
        $genres = Genre::all();

        $a = $request->input('a');
        $g = $request->input('g');
        $k = $request->input('k');

        $query = DB::table('shops');
        $query->join('areas', 'shops.area_id', '=', 'areas.id');
        $query->join('genres', 'shops.genre_id', '=', 'genres.id');
        $query->select('shops.*', 'areas.area_name', 'genres.genre_name',);
        $query->orderBy('shops.id', 'asc');

        if($k !== null) {
            //全角を半角に
            $search_split = mb_convert_kana($k, 's');
            //半角で文字を切り分けて、配列に入れる
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);
            //配列をforeachでまわして、where条件を付け加える
            foreach($search_split2 as $value){
                $query->where('shop_name', 'LIKE', '%' . $value . '%');
            }
        }
        if($a !== null) {
            $query->where('area_id', '=', $a);
        }
        if($g !== null) {
            $query->where('genre_id', '=', $g);
        }

        $shops = $query->get();

        return view('index', compact('shops', 'areas', 'genres', 'k', 'a', 'g'));
    }
    /*
    public function index(Request $request) {
        $area = $request->input('area');
        $genre = $request->input('genre');
        $keyword = $request->input('keyword');

        $query = Shop::query();
        $query->join('areas', function ($query) {
            $query->on('shops.area_id', '=', 'areas.id');
        })->join('genres', function  ($query) {
            $query->on('shops.genre_id', '=', 'genres.id');
        });

        if(!empty($area)) {
            $query->where('area.area_name', 'LIKE', $area);
        }

        if (!empty($genre)) {
            $query->where('genre.genre_name', 'LIKE', $genre);
        }

        if (!empty($keyword)) {
            $query->where('shop.shop_name', 'LIKE', "%{$keyword}%");
        }

        $shops = $query->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('shops', 'keyword', 'area', 'genre', 'areas', 'genres'));
    }*/
}