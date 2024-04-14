<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersTask;
use App\Utils\ViewUserUtils;
use Illuminate\Http\JsonResponse;

class ViewUserDataService{
    
    static function displayUserData()
    {
        $getUserTaskData = ViewUserUtils::getUserTaskData();
        if($getUserTaskData->isEmpty()) {
            return response([
                'status' => 'success',
                'message' => "No data found!",
            ], 200);
        }

        $usersTaskArray = $getUserTaskData->toArray();
        $formatUserDataResponse = ViewUserUtils::formatUserData($usersTaskArray);
        return response()->json([
            "data" => $formatUserDataResponse,
            "status" => 'success',
            'meessage' => "Data get from DB successfully...✔️🙂🙂🙂"
        ],200);
    }

    static function getUserDataById(int $userId):JsonResponse
    {
        // echo "singal user data";
        // die;
        // $test = ViewUserConstant::STATUS[0];
        // dd($test);

        $user = User::select('id', 'name', 'email', 'title', 'description', 'due_date', 'status')
            ->where('id', $userId)
            ->first();

            // dd($userArray);
        if(!$user){
        return response()->json([
                'status' => 'success',
                'message' => "No data found!",
            ], 200);
        }
        
        // $userArray = array($user);
        $userArray = array($user->toArray());
        $formatUserDataResponse = ViewUserUtils::formatUserData($userArray);
        // dd($formatUserDataResponse);
        return response()->json([
            "data" => $formatUserDataResponse,
            "status" => 'success',
            'meessage' => "Data get from DB successfully...✔️🙂🙂🙂"
        ],200);
    }
}