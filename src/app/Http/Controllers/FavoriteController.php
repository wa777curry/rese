<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class FavoriteController extends Controller
{
    public function favorite(Shop $shop) {
        auth()->user()->favorites()->attach($shop->id);
        return back();
    }

    public function nofavorite(Shop $shop)  {
        auth()->user()->favorites()->detach($shop->id);
        return back();
    }
}
