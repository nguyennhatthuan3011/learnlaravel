<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateStoreRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::all();
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
//        $user = User::create([
//            'name' => $req('name'),
//            'username' => $req('username'),
//            'email' => $req('email'),
//            'phone' => $req('phone'),
//            'website' => $req('website'),
//        ]);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateStoreRequest $request
     * @param int $id
     * @return bool
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        if (!$user){
            return false;
        }
        $user->fill($data);
        $user->save();
        return $user;
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
        $user->save();
        return $user;
    }
}
