<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function index()
//     {
//         $users = User::all();
//         // return response([ 'users' => UserResource::collection(User::paginate(4)), 'message' => 'Retrieved successfully'], 200);
//         // //need to add filter
//         return UserResource::collection(User::paginate(10));
//     }

//     /**
//      * Store a newly created resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return \Illuminate\Http\Response
//      */
//     public function store(UserRequest $request)
//     {
//         $validated = $request->validated();
//         $data = $validated;
//         $data['password'] = bcrypt($data['password']);
//         $user = User::create($data);

//         // return response()->json($user, 201);
//         return response(['user' => new UserResource($user), 'message' => 'Created successfully'], 201);
//     }

//     /**
//      * Display the specified resource.
//      *
//      * @param  \App\User  $user
//      * @return \Illuminate\Http\Response
//      */
//     public function show(User $user)
//     {
//         return response(['user' => new UserResource($user), 'message' => 'Retrieved successfully'], 200);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \App\User  $user
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, User $user)
//     {
//         $user->update($request->all());

//         return response(['users' => new UserResource($user), 'message' => 'Update successfully'], 200);
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\User  $user
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy(User $user)
//     {
//         $users->delete();
//         return response(['message' => 'Deleted']);
//     }
}
