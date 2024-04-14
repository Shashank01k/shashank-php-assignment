<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\UserLoginService;

class UserLoginController extends Controller
{
    public function login(UserLoginRequest $requestPayload){
        $validateLoginUser = UserLoginService::validateLoginUser($requestPayload);
        // dd($validateLoginUser);
        return $validateLoginUser;
        array
        (
            $validateLoginUser
        );
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Successfully logout!'
        ]);
    }
}
