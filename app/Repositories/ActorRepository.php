<?php

namespace App\Repositories;

use App\Models\MovieActor;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ActorInterface;
use App\Traits\ResponseAPI;
use App\Models\Actor;

class ActorRepository implements ActorInterface
{
    use ResponseAPI;

    public function getAllActors()
    {
        try {
            $actors = Actor::all();
            return $this->success("All Actors", $actors);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getActorById($id)
    {
        try {
            $actor = Actor::find($id);

            if (!$actor) return $this->error("No Actor with ID $id", 404);

            return $this->success("Actor detail", $actor);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function requestActor(Request $request, $id = null)
    {
        try {
            // Если Актер с таким id существует, находим его
            // и после этого обновляем информацию о нем
            // иначе создаем нового
            $actor = Actor::updateOrCreate(
                ['id' => $id],
                ['name' => $request->name]
            );

            return $this->success(
                $id ? "Actor updated"
                    : "Actor created",
                $actor, $id ? 200 : 201);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function deleteActor($id)
    {
        try {
            $movieactor = MovieActor::where('actor_id', $id)->delete();

            $actor = Actor::find($id);

            if (!$actor) return $this->error("No Actor with ID $id", 404);

            $actor->delete();

            return $this->success("Actor deleted", $actor);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function assignActorToMovie($actor_id, $movie_id, $role_name)
    {

            MovieActor::updateOrCreate(
                ['movie_id' => $movie_id, 'actor_id' => $actor_id],
                ['role_name' => $role_name],
            );
            return $this->success("Actor assigned to movie", $role_name);

    }

    public function moviesByActor($id)
    {
        $movies = Actor::find($id)->movies;

        return $this->success('List of movies by Actor', $movies);
    }
}
