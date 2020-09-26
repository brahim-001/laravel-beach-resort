<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class AuthController extends Controller
{
    // public function register(Request $request){

    //     $validateData = $request->validate([
    //         'name'=>'required|max:55',
    //         'email'=>'email|required|unique:users',
    //         'password'=>'required'
    //         ]);


    //     $validateData['password'] = bcrypt($request->password);
    //     $user = User::create($validateData);

        
    //     $accessToken = $user->createToken('authToken')->accessToken;  

    //     return response(['user'=>$user, 'access_token'=>$accessToken]);
    // }

    // public function login(Request $request){
        
    //     $loginData = $request->validate([
    //         'email'=>'email|required',
    //         'password'=>'required',
    //         'role' => 'required'

    //         ]);

    //      if(!auth()->attempt($loginData)){
    //          return response(['message'=>'invalid credentials']);
    //      } 

    //      $accessToken = auth()->user()->createToken('authToken')->accessToken;  

    //      return response(['user'=>auth()->user(), 'access_token'=>$accessToken]);
  

    // }



    public function login(Request $request){
 
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
     
        if( auth()->attempt($credentials) ){
          $user = Auth::user();
      $success['token'] =  $user->createToken('AppName')->accessToken;
      $role =  $user->role;
          return response()->json(['success' => $success ,'role' => $role], 200);
        } else {
    return response()->json(['error'=>'Unauthorised'], 401);
        }
      }


      
        
      public function register(Request $request)
      {
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required',
        ]);
     
        if ($validator->fails()) {
          return response()->json([ 'error'=> $validator->errors() ]);
        }
    $data = $request->all();
    $data['password'] = Hash::make($data['password']);
    $user = User::create($data);
    $success['token'] =  $user->createToken('AppName')->accessToken;
    return response()->json(['success'=>$success], 200);
     
      }

//     public function show(Request $request, $userId)
//     {
//         $user = User::find($userId);

//         if($user) {
//             return response()->json($user);
//         }

//         return response()->json(['message' => 'User not found!'], 404);
//     }


public function user_detail()
{
$user = Auth::user();
return response()->json(['success' => $user], 200);
}
}