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
     * @return Response
     */
    public function index(Request $request)
    {
        if($perPage = $request->get('perPage')){
            $user = User::paginate($perPage);
        }else{
            $user = User::all();
        }
        return responder()->success($user , UserTransformer::class)->respond();
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
        $user->Delete();
        return responder()->success($user)->respond(204);
    }
}
