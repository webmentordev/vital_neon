<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        return view('searches', [
            'searches' => Search::latest()->paginate(200)
        ]);
    }
}
