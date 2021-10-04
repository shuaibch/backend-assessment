<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;
// use Illuminate\Support\Fecades\Auth;
use App\User;
use Validator;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditRequest;
use App\Http\Resources\UserResource;
use App\Imports\UsersImport;
use App\Exports\UsersExport;

use Maatwebsite\Excel\Facades\Excel;




class UserController extends Controller
{
    public function index(){
        //need to add filter
        return UserResource::collection(User::paginate(4));
    }
    public function login(Request $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = Auth::user();
            $resArr = [];
            $resArr['token'] = $user->createToken('api-application')->accessToken;
            return response()->json($resArr, 200);
        }
        else{
            return response()->json(['error'=>'Unauthorized Access']);
        }
    }

    public function view(Request $request, $id){
        $user = User::find($id);
        return $user;
    }

    public function Update(EditRequest $request, $id){
        $validated = $request->validated();
        $user = User::find($id);

        // return $validated->name;
        $user['name'] = $validated['name'];
        $user['email'] = $validated['email'];
        $user['password'] = $validated['password'];

        // $user['email'] = $validated->email;
        // $user['password'] = bcrypt($validated->password);
        $result = $user->save();
        // $request->user()->token()->revoke();

        return response()->json($result, 201);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::destroy($id);
        return response()->json(null, 204);
    }
    public function create(UserRequest $request){
        $validated = $request->validated();
        $data = $validated;
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json($user, 201);
    }

    public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
        // $array = Excel::toArray(new UsersImport, request()->file('file'));



        return $array;

    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


}
