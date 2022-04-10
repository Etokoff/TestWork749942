<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface ActorInterface
{
    /**
     * Получить всех актеров
     *
     * @method  GET api/actors
     * @access  public
     */
    public function getAllActors();

    /**
     * Получить актера по ID
     *
     * @param   integer     $id
     *
     * @method  GET api/actors/{id}
     * @access  public
     */
    public function getActorById($id);

    /**
     * Создание | Обновление информации об актере
     *
     * @param   Request    $request
     * @param   integer    $id
     *
     * @method  POST    api/actors        для создания
     * @method  PUT     api/actors/{id}   для обновления
     * @access  public
     */
    public function requestActor(Request $request, $id = null);

    /**
     * Удаление актера
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/actors/{id}
     * @access  public
     */
    public function deleteActor($id);

    /**
     * Назначение актера на роль в фильме
     *
     * @param $actor_id
     * @param $movie_id
     * @param $role_name
     * @return mixed
     */
    public function assignActorToMovie($actor_id, $movie_id, $role_name);

    /**
     * Получение фильмов в которых играл актер
     *
     * @param $id
     * @return mixed
     */
    public function moviesByActor($id);
}
