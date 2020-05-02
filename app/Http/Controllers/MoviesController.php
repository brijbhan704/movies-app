<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    //api_key = 37c78689f1bd1976138d7508df586551
    //Example API Request = https://api.themoviedb.org/3/movie/550?api_key=37c78689f1bd1976138d7508df586551
    //API Read Access Token (v4 auth) = eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIzN2M3ODY4OWYxYmQxOTc2MTM4ZDc1MDhkZjU4NjU1MSIsInN1YiI6IjVlYTk5ZTk5MmQxZTQwMDAxZDg0Y2YzYSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.8AwMmoeHXqW0E1iB70n2jkKITYb3gWTu4RSAx8hLhpg
    public function index()
    {

        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?api_key=37c78689f1bd1976138d7508df586551')
            ->json()['results'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/now_playing?api_key=37c78689f1bd1976138d7508df586551')
        ->json()['results'];

        $genreArray = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list?api_key=37c78689f1bd1976138d7508df586551')
        ->json()['genres'];


        $genres = collect($genreArray)->mapWithKeys(function($genre){
            return [$genre['id']=>$genre['name']];

        });
        //dump($popularMovies);

        return view('movies.index',[

            'popularMovies'     =>   $popularMovies,
            'nowPlayingMovies'  =>   $nowPlayingMovies,
            'genres'            =>   $genres,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $movies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images')
            ->json();
            //dump($movies);

        return view('movies.show',[
            'movies'=>$movies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
