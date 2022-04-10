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
}
