<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Movie extends Controller
{
    public function getAll( Request $request )
    {
        $filter   = $request->input('filter');
        $search   = $request->input('search');
        $per_page = $request->input('per_page');
        $page     = $request->input('page');

        dd( $filter );
        dd( $search );
        dd( $per_page );
        dd( $page );
    }
}
