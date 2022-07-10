<?php

namespace App\Http\Controllers;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Movie extends Controller
{
    public function getAll( Request $request )
    {
        $filter   = $request->filter;
        $search   = $request->search;
        $per_page = $request->per_page ?? 10;
        $page     = $request->page ?? 1;
        $order_by = $request->order_by ?? 'id:desc';
        $order_by = explode( ':', $order_by );

        $data = [];

        if( $filter ) {
            $data = $this->handleFilter( $filter, $per_page, $page, $order_by, $search );
            return response()->json( $data, 200 );
        }

        if( $search ){
            $data = $this->handleSearch( $per_page, $page, $order_by, $search );
            return response()->json( $data, 200 );
        }

        $data = Movies::orderBy( $order_by[0], $order_by[1])->skip( $this->getOffset( $per_page, $page ) )->take( $per_page )->get();

        return response()->json($data, 200);


    }

    private function getOffset( $per_page, $page )
    {
        return ( $page - 1 ) * $per_page;
    }

    private function handleFilter( $filter, $per_page, $page, $order_by, $search ){
        $offset = $this->getOffset( $per_page, $page );
        $data = [];

        if( $filter  ){
            $filters = explode( ';', $filter );
            foreach ($filters as $fil) {
                $f = explode(':', $fil);

                if( count( $f ) === 2 && $search ){
                    $data = Movies::where($f[0],$f[1])
                    ->where("title","like","%". $search ."%")
                    ->orWhere("description","like","%". $search . "%")->skip( $offset) ->take( $per_page )->orderBy( $order_by[0], $order_by[1])->get();
                }else if( count( $f ) === 3 && $search  ) {
                    $data = Movies::where($f[0],$f[1],$f[2])
                    ->where("title","like","%". $search ."%")
                    ->orWhere("description","like","%". $search . "%")->skip( $offset) ->take( $per_page )->orderBy( $order_by[0], $order_by[1])->get();
                }else if( count( $f ) === 2 && ! $search ){
                    $data = Movies::where($f[0],$f[1])->skip( $offset) ->take( $per_page )->orderBy( $order_by[0], $order_by[1])->get();
                }else{
                    $data = Movies::where($f[0],$f[1],$f[2])->skip( $offset) ->take( $per_page )->orderBy( $order_by[0], $order_by[1])->get();
                }
            }
        }

        return $data;
    }

    private function handleSearch( $per_page, $page, $order_by, $search ){
        $offset = $this->getOffset( $per_page, $page );
        return Movies::where("title","like","%". $search ."%")
        ->orWhere("description","like","%". $search . "%")
        ->orderBy($order_by[0],$order_by[1])
        ->skip( $offset )
        ->take( $per_page )
        ->get();
    }


    public function store( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'poster'     => 'required|image|mimes:png,jpg,jpeg',
            'title'     => 'required|unique:movies,title',
            'description' => 'required',
            'genre' => 'required',
        ]);

        if( $validator->fails() )
        {
            $message = $validator->errors();
            return response()->json([ "message" => $message ], 402);
        }


        //upload image
        $image       = $request->file('poster');
        // var_dump( $image );
        // exit();
        $name_poster = date('mdYHis') . uniqid().$image->hashName();
        $image->storeAs('public/poster', $name_poster );

        $data = [
            "title" => $request->title,
            "poster" => $name_poster,
            "description" => $request->description,
            "genre" => $request->genre,
            "rating" => $request->rating ?? 5,
        ];

        Movies::create( $data );
        $output = [
            "success" => TRUE,
            "message" => "Data ". $request->title." Berhasil Di Tambahkan"
        ];

        return response()->json($output, 201);
    }

    public function update( Request $request, $id )
    {
        $validator = Validator::make($request->all(), [
            // 'poster'     => 'required|image|mimes:png,jpg,jpeg',
            'title'     => 'required|unique:movies,title',
            'description' => 'required',
            'genre' => 'required',
        ]);

        if( $validator->fails() )
        {
            $message = $validator->errors();
            return response()->json([ "message" => $message ], 402);
        }


        $data = [
            "title" => $request->title,
            // "poster" => $request->poster,
            "description" => $request->description,
            "genre" => $request->genre,
            // "rating" => $request->rating,
        ];

        Movies::whereId( $id )->update( $data );

        $output=[
            "success" => TRUE,
            "message" => "Data Berhasil Di Edit"
        ];

        return response()->json($output, 200 );
    }

    public function delete( Request $request, $id )
    {
        $movie = Movies::findOrFail( $id );
        $movie->delete();

        $output = [
            "success" => TRUE,
            "message" => "Data Berhasil dihapus"
        ];
        return response()->json($output, 200);
    }
}
