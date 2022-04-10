<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface MovieInterface
{
    /**
     * Получить все фильмы
     *
     * @method  GET api/movie
     * @access  public
     */
    public function getAllMovies();

    /**
     * Получить фильм по ID
     *
     * @param   integer     $id
     *
     * @method  GET api/movie/{id}
     * @access  public
     */
    public function getMovieById($id);

    /**
     * Создание | Обновление информации о фильме
     *
     * @param   Request    $request
     * @param   integer    $id
     *
     * @method  POST    api/movie        для создания
     * @method  PUT     api/movie/{id}  для обновления
     * @access  public
     */
    public function requestMovie(Request $request, $id = null);

    /**
     * Удаление фильма
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/movie/{id}
     * @access  public
     */
    public function deleteMovie($id);

    /**
     * Поиск фильмов по параметрам (название фильма, имя актера, роль актера)
     *
     * @param integer       $id
     */
    public function actorsByMovie($id);
}
