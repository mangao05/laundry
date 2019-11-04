<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class AuthController extends Controller
{
    public function login(Request $request){
        $http = new Client;

        // try{
            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_secret' => 'nSfD2Uffviy9xXLyUtDDXWkohQuvJG3xU67sIRyK',
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            // return $response;
            // return $response->getBody();
        // }catch(\GuzzleHttp\Exception\BadResponseException $e){
        //     if($e->getCode() == 400){
        //         return response()->json('Invalid Request. Please enter username or a password.', $e->getCode());
        //     }else if($e->getCode() == 401){
        //         return response()->json('Your credentials are incorrect. Please try again.', $e->getCode());
        //     }
        //     return response()->json('Something went wrong on the server.', $e->getCode());
        // }
    }


    public function register(Request $request){
         $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);


        return User::create([
            'name' => $request->name,
            'email'=>$request->email,
            'password' => \Hash::make($request->password)
        ]);
    }
}
