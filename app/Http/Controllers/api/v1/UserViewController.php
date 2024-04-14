<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\ViewUserDataService;
use Illuminate\Support\Facades\Validator;

class UserViewController extends Controller
{
    //
    public function view()
    {
        $displayUserData = ViewUserDataService::displayUserData();
        return $displayUserData;
    }

    public function byId($userId)
    {
        // echo "test "; die;
        $validator = Validator::make(['userId' => $userId], [
            'userId' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        } else{
            $getUserDataResponse = ViewUserDataService::getUserDataById($userId);
            return $getUserDataResponse;
        }
    }
}
