<?php

namespace App\Repositories;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\MovieInterface;
use App\Traits\ResponseAPI;
use App\Models\Movie;
use App\Models\MovieActor;

class MovieRepository implements MovieInterface
{
    use ResponseAPI;

    public function getAllMovies()
    {
        try {
            $movies = Movie::all();
            return $this->success("All Movies", $movies);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getMovieById($id)
    {
        try {
            $movie = Movie::find($id);

            if (!$movie) return $this->error("No Movie with ID $id", 404);

            return $this->success("Movie detail", $movie);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestMovie(Request $request, $id = null)
    {

        $movie = Movie::updateOrCreate(
            ['id' => $id],
            ['name' => $request->name],
        );

        return $this->success(
            $id ? "Movie updated"
                : "Movie created",
            $movie, $id ? 200 : 201);

    }

    public function deleteMovie($id)
    {
        try {
            $movieactor = MovieActor::where('movie_id', $id)->delete();

            $movie = Movie::find($id);

            if (!$movie) return $this->error("No Movie with ID $id", 404);

            $movie->delete();

            return $this->success("Movie deleted", $movie);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function actorsByMovie($id)
    {
        $movie = Movie::find($id)->actors;

        return $this->success('List of actors by Movie', $movie);
    }

    public function getResult(Request $request)
    {
        if (!$request->has('command')) {
            return $this->error('Missing required parameter Command', 404);
        }
        if($request->has('orderby')) {
            $orderby = $request->input('orderby');
            $direct = True;
            if($request->has('direct')) {
                if($request->input('direct') == 'desc') {
                    $direct = False;
                }
            }
        } else {
            $orderby = NULL;
        }

        switch ($request->input('command')) {
            case 'list' :
                $result = [];
                if (is_null($orderby)) {
                    $movies = Movie::all();
                } else {
                    $movies = $direct ? Movie::all()->sortBy($orderby) : Movie::all()->sortByDesc($orderby);
                }
                foreach ($movies as $movie) {
                    $actors = $movie->actors;
                    $result[] = $movie;
                }
                return $this->success('List of Movies', $result);
            case 'search' :
                $result = []; $movies = NULL; $actors = NULL;
                if ($request->has('movie')) {
                    if (is_null($orderby)) {
                        $movies = Movie::where('name', 'LIKE', '%' . $request->input('movie') . '%')->get();
                    } else {
                        $movies = $direct ?
                            Movie::where('name', 'LIKE', '%' . $request->input('movie') . '%')->get()->sortBy($orderby) :
                            Movie::where('name', 'LIKE', '%' . $request->input('movie') . '%')->get()->sortByDesc($orderby);
                    }
                }
                if ($request->has('actor')) {
                    $actors = Actor::where('name', 'LIKE', '%' . $request->input('actor') . '%')->get();
                }

                if (is_null($movies)) {
                    foreach ($actors as $actor) {
                        $movies[] = $actor->movies;
                    }
                } else {
                }
                foreach ($movies as $movie) {
                    if (is_null($actors)) {
                        $result[] = $movie;
                    } else {
                        $result[] = $movie;
                        $result[] = $actors;
                    }
                }
                return $this->success('Search results of Movies', $result);
            default:
                return $this->error("Unknown command " . $request->input('command'), 404);

        }
    }
}
