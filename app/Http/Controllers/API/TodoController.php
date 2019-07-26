<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateStoreRequest;
use App\Todo;
use App\Transformers\TodoTransformer;
use App\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Todo[]|Collection
     */
    public function index(Request $request)
    {
        if ($perPage = $request->get('perPage'))
        {
            $todo = Todo::paginate($perPage);
        }else {
            $todo = Todo::all();
        }
        return responder()->success($todo, TodoTransformer::class)->respond();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TodoStoreRequest $request
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
        return responder()->success($todo, TodoTransformer::class)->respond();
    }

    public function showTodo($id){
        $todo = Todo::find($id);
        return responder()->success($todo, TodoTransformer::class)->respond();
    }

        /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $user_id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $user_id)
    {
        if ($perPage = $request->get('perPage')){
            $todo = Todo::where('user_id', $user_id)->paginate($perPage);
        }else{
            $todo = Todo::where('user_id', $user_id);
        }
        return responder()->success($todo, TodoTransformer::class)->respond();
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
        return responder()->success($todo, TodoTransformer::class)->respond();
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
        return responder()->success($todo,TodoTransformer::class)->respond(204);
    }
}
