<?php

namespace App\Services;

use App\Utils\ViewUserUtils;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserLoginService
{
    static function validateLoginUser($payload) : JsonResponse
    {
        $userEmail = $payload['user_email'];
        $password = $payload['password'];
       
        $getUserDataByEmail = ViewUserUtils::getUserDataByEmail($userEmail);

        if(!$getUserDataByEmail){
            return response()->json([
                'status' => 'error',
                'message' => "Entered user email is not found!...🧐🧐🧐",
            ], 404);
        }
        elseif(!Hash::check($password, $getUserDataByEmail->password)){
            return response()->json([
                'status' => 'error',
                'message' => "Wrong password entered, Need to check!👽",
            ], 404);
        }

        $token = $getUserDataByEmail->createToken('mytoken')->plainTextToken;

        $userId = $getUserDataByEmail->id;
        $getUserTaskDataByUserId = ViewUserUtils::getUserTaskDataByUserId($userId);
        
        if($getUserTaskDataByUserId->isEmpty())
        {
            $data = "Please assign task this user...🤓🤓🤓";
        }
        else
        {
            $userTaskArray = $getUserTaskDataByUserId->toArray();
            $formatUserDataResponse = ViewUserUtils::formatUserData($userTaskArray);
            $data = $formatUserDataResponse;
        }

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'message' => "Loggedin Successfully...✔️👍😎✔️",
            'data' => $data,
        ], 200);
    }
}