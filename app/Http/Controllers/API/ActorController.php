<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ActorRepository;

class ActorController extends Controller
{
    protected $actorRepo;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(ActorRepository $actorRepo)
    {
        $this->actorRepo = $actorRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->actorRepo->getAllActors();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->actorRepo->requestActor($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->actorRepo->getActorById($id);
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
        return $this->actorRepo->requestActor($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->actorRepo->deleteActor($id);
    }

    /**
     * @param Request $request
     */
    public function assignactor(Request $request) {
        return $this->actorRepo->assignActorToMovie($request->input('actor'), $request->input('movie'), $request->input('role_name'));
    }

    public function unassignactor(Request $request) {
        return $this->actorRepo->unassignActorFromMovie($request->input('actor'), $request->input('movie'));
    }

    public function moviesbyactor($id)
    {
        return $this->actorRepo->moviesByActor($id);
    }
}
