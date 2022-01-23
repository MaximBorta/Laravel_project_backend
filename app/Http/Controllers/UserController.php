<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $user;
    public function __construct(){
        $this->middleware("auth:api",["except" => ["login","register"]]);
        $this->user = new User;
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 500);
        }
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];
        $createdtUser = $this->user->create($data);
        if($createdtUser) event(new UserRegistered());
        $responseMessage = "Registration Successfully :)";
        return response()->json([
            'success' => true,
            'message' => $responseMessage,
            'data' => $createdtUser
        ], 200);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 500);
        }
        $credentials = $request->only(["email","password"]);
        $user = User::where('email',$credentials['email'])->first();
        if($user){
            if(!auth()->attempt($credentials)){
                $responseMessage = "Invalid username or password :)";
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            }
            $accessToken = auth()->user()->createToken('authToken');
            $responseMessage = "Login Successful :)";
            return $this->respondWithToken($accessToken,$responseMessage,auth()->user());
        }
        else{
            $responseMessage = "Sorry, this user does not exist :)";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }

    public function viewProfile(){
        $responseMessage = "Hello ". Auth::guard('api')->user()->name. ' !!! :)';
        $data =  UserResource::make(Auth::guard("api")->user());
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" => $data
        ], 200);
    }

    public function logout(){
        $user = Auth::guard("api")->user()->token();
        $user->revoke();
        $responseMessage = "successfully logged out :)";
        return response()->json([
            'success' => true,
            'message' => $responseMessage
        ], 200);
    }

    public function uploadAvatar(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Error to Upload :D'
            ], 500);
        }

        if ($request->hasFile('user_avatar')) {
            $file_name = $request->user_avatar->getClientOriginalName();
            $request->user_avatar->move('avatars/', $file_name);
            auth()->user()->update(['user_avatar' => $file_name]);

            return response()->json([
                'success' => true,
                'message' => 'Avatar uploaded successfully :D !!!',
                'data' => $file_name,
            ]);
        }
    }

    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()->toArray()
            ], 500);
        }

        $data = [
            "name" => $request->name,
            "email" => $request->email,
        ];
        auth()->user()->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Profile updated :)',
        ]);
    }
}
