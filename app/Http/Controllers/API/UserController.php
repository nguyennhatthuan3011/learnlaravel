<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateStoreRequest;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return User[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $user = User::query();
        $user->when(request('username'), function ($user) use ($request) {
            $username = $request->get('username');
           return $user->where('username', 'like' ,'%' .$username. '%');
        })
        ->when(request('name'), function ($user) use ($request){
            $name = $request->get('name');
            return $user->where('name', 'like' ,'%' .$name. '%');
        });
        if($perPage = $request->get('perPage')){
            $user = $user->paginate($perPage);
        }else{
            $user = $user->get();
        }
        return responder()->success($user, UserTransformer::class)->respond();
    }

    public function showUsername(Request $request){
        $username = $request->get('username');
        $user = User::where('username', $username);
        return $user;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return bool
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        if (!$data) {
            return false;
        }
        $user = new User();
        $user->fill($data);
        $user->save();
        return responder()->success($user)->respond(201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $user = User::find($id);
        return responder()->success($user, new UserTransformer)->respond();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateStoreRequest $request
     * @param int $id
     * @return bool
     */
    public function update(UserUpdateStoreRequest $request, $id)
    {
        $data = $request->validated();
        $user = User::find($id);
        if (!$user){
            return false;
        }
        $user->fill($data);
        $user->save();
        return responder()->success($user,UserTransformer::class)->respond(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return responder()->success($user)->respond(204);
    }
}
