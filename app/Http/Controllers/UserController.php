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

   

    public function index(Request $request)
    {
        $users = User::paginate(10);
        $collection =  UserResource::collection($users);
        if ($request->has('email'))
        {
            // return $collection->where('email', 'like', '%' . $request->input('email') . '%');
            return $collection->where('email',  $request->input('email'));
        }
        if($request->has('name'))
        {
            // return $collection->where('name', 'like', '%' . $request->input('name') . '%');
            return $collection->where('name',  $request->input('name'));
        }
        return $users;

    }


  
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $data = $validated;
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        // return response()->json($user, 201);
        return response(['user' => new UserResource($user), 'message' => 'Created successfully'], 201);
    }

  
    public function show(User $user)
    {
        return response(['user' => new UserResource($user), 'message' => 'Retrieved successfully'], 200);
    }

   
   
    public function destroy(User $user)
    {
        $users->delete();
        return response(['message' => 'Deleted']);
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

    public function import() 
    {
        return Excel::import(new UsersImport,request()->file('file'));
        // $array = Excel::toArray(new UsersImport, request()->file('file'));
        // return $array;
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


}
