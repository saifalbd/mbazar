<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{



    public function login(Request $request){
        $request->validate([
            'loginEmail'=>'required|string',
            'loginPassword' => 'required|string',
        ]);

        $data = ['email'=>$request->loginEmail,'has'=>'customer'];



       $user =  User::query()
        ->where($data)->first();

        $password = $request->loginPassword;


        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken('token-name');
            $user['token'] = $token->plainTextToken;
            return new AuthResource($user);
        }else {
            return response()->json([
                'message'=>__('auth.failed'),
                'errors'=>[
                    'loginEmail'=>[__('auth.failed')],
                    'loginPassword'=>[__('auth.failed')],
                    ]
            ],422);

        }
    }


       /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function registerValidator(array $data)
    {

        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'ip'=>request()->ip(),
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request){
        $this->registerValidator($request->all())->validate();
        $this->create($request->all());
        return response('',201);
    }

    public function update(Request $request){
        $user = $request->user();
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
            Rule::unique('users')
            ->whereNot('id', $user->id)->where('email', $request->email)],
        ]);
        $user->first_name = $request->firstName;
        $user->last_name =  $request->lastName;
        $user->email =  $request->email;
        $user->save();
        return new AuthResource($user);

    }

    public function updatePassword(Request $request){
        $user = $request->user();
        $request->validate([
            'oldPassword' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $oldPassword = $request->oldPassword;

        if ($user && Hash::check($oldPassword , $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();

            return new AuthResource($user);
        }else {
            return response()->json([
                'message'=>__('auth.failed'),
                'errors'=>[
                    'oldPassword'=>[__('auth.failed')],
                    'password'=>[__('auth.failed')],
                    ]
            ],422);

        }



    }

    public function updateThumb(Request $request){
        $user = $request->user();
        $request->validate([
            'image' => ['required', 'image'],

        ]);


        $user->replaceThumb($request->image);
        $user->refresh();
        return new AuthResource($user);







    }


}
