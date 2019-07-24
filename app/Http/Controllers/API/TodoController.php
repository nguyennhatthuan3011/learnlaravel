<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateStoreRequest;
use App\Todo;
use App\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Todo[]|Collection
     */
    public function index()
    {
        $todo = Todo::all();
        return $todo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function store(TodoStoreRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return false;
        }
        $user = User::find($request->get('user_id'));
        $todo = new Todo();
        $todo->fill($data);
        $user->todos()->save($todo);
        return response($data, 200)
            ->header('Content-Type', 'application/json');
//        return responder()->success($data)->respond();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return bool
     */
    public function update(TodoUpdateStoreRequest $request, $id)
    {
        $data = $request->validated();
        if(!$data){
            return false;
        }
        $todo = Todo::find($id);
        $todo->fill($data);
        $todo->save();
        return responder()->success($data)->respond();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return responder()->success($user)->respond(201);
    }
}
