<?php

namespace App\Http\Controllers;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;

class Movie extends Controller
{
    public function getAll( Request $request )
    {
        $filter   = $request->filter;
        $search   = $request->search;
        $per_page = ( $request->per_page ) ? $request->per_page : 10;
        $page     = ($request->page ) ? (int)$request->page  :  1;
        $order_by = ( $request->order_by )? $request->order_by  :'id:desc';
        $order_by = explode( ':', $order_by );

        $data = [];
        $count_all = 0;


        if( $filter ) {
            $data = $this->handleFilter( $filter, $per_page, $page, $order_by, $search );
            $count_all = $this->countHandleFilter( $filter, $per_page, $page, $order_by, $search );

        }else if( $search ){
            $data = $this->handleSearch( $per_page, $page, $order_by, $search );
            $count_all = $this->countHandleSearch( $per_page, $page, $order_by, $search );

        }else{
            $data = Movies::orderBy( $order_by[0], $order_by[1])->skip( $this->getOffset( $per_page, $page ) )->take( $per_page )->get();
            $count_all = Movies::orderBy( $order_by[0], $order_by[1])->count();
        }

        $pagination = [
            "page" => $page,
            "offset" => $this->getOffset( $per_page, $page ),
            "per_page" => $per_page,
            "count_all" => $count_all,
        ];

        $output = [ "data" => $data, "pagination" => $pagination ];

        return response()->json($output, 200);


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

    private function countHandleFilter( $filter, $per_page, $page, $order_by, $search ){
        $offset = $this->getOffset( $per_page, $page );
        $data = [];

        if( $filter  ){
            $filters = explode( ';', $filter );
            foreach ($filters as $fil) {
                $f = explode(':', $fil);

                if( count( $f ) === 2 && $search ){
                    $data = Movies::where($f[0],$f[1])
                    ->where("title","like","%". $search ."%")
                    ->orWhere("description","like","%". $search . "%")->orderBy( $order_by[0], $order_by[1])->count();
                }else if( count( $f ) === 3 && $search  ) {
                    $data = Movies::where($f[0],$f[1],$f[2])
                    ->where("title","like","%". $search ."%")
                    ->orWhere("description","like","%". $search . "%")->orderBy( $order_by[0], $order_by[1])->count();
                }else if( count( $f ) === 2 && ! $search ){
                    $data = Movies::where($f[0],$f[1])->orderBy( $order_by[0], $order_by[1])->count();
                }else{
                    $data = Movies::where($f[0],$f[1],$f[2])->orderBy( $order_by[0], $order_by[1])->count();
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

    private function countHandleSearch( $per_page, $page, $order_by, $search ){
        $offset = $this->getOffset( $per_page, $page );
        return Movies::where("title","like","%". $search ."%")
        ->orWhere("description","like","%". $search . "%")
        ->orderBy($order_by[0],$order_by[1])
        ->count();
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
        $image->storeAs('.', $name_poster,['disk' => 'public_uploads'] );

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
        $rules = [
            'title'     => 'required',
            'description' => 'required',
            'genre' => 'required',
        ];

        if( $request->poster ){
           $rules['poster'] = 'image|mimes:png,jpg,jpeg';
        }

        $validator = Validator::make($request->all(), $rules);


        if( $validator->fails() )
        {
            $message = $validator->errors();
            return response()->json([ "message" => $message ], 402);
        }

        $data = [
            "title" => $request->title,
            "description" => $request->description,
            "genre" => $request->genre,
            "rating" => $request->rating,
        ];

        $image       = $request->file('poster');

        if( $request->poster && $image ){
            $name_poster = date('mdYHis') . uniqid().$image->hashName();
            $image->storeAs('.', $name_poster,['disk' => 'public_uploads'] );
            $data["poster"] = $name_poster;
            if( File::exists( public_path()."/assets/".$request->old_poster) ){
                File::delete( public_path()."/assets/".$request->old_poster);
            }
        }

        Movies::whereId( $id )->update( $data );


        $output=[
            "success" => TRUE,
            "message" => "Data Berhasil Di Edit"
        ];

        return response()->json($output, 200 );
    }

    public function delete( Request $request, $id )
    {

        $image = Movies::find( $id );
        $image = $image->poster;

        $movie = Movies::findOrFail( $id );
        $movie->delete();

        if( File::exists( public_path()."/assets/".$image) ){
            File::delete( public_path()."/assets/".$image );
        }

        $output = [
            "success" => TRUE,
            "message" => "Data Berhasil dihapus"
        ];
        return response()->json($output, 200);
    }
}
