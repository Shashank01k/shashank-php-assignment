<?php

namespace App\Services;

use App\Utils\ViewUserUtils;
use Illuminate\Http\JsonResponse;

class UserSearchService
{
    static function filterUsersTask(object $requestPayload) : JsonResponse
    {
        $dataArray = $requestPayload->data;

        $getUserTaskDataByUserIdStatusAndDueDate = ViewUserUtils::getUserTaskDataByUserIdStatusAndDueDate($dataArray);
        
        //TODO:add one more filter status and also modify due_date filter use only date not time and also name filter string to lower

        if ($getUserTaskDataByUserIdStatusAndDueDate->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => "No data found!😗😗😗",
            ], 200);
        }
      
        $usersTaskArray = $getUserTaskDataByUserIdStatusAndDueDate->toarray();
        $formatUserDataResponse = ViewUserUtils::formatUserData($usersTaskArray);

        return response()->json([
            "status" => 'success',
            'meessage' => "Data get from DB successfully...✔️🙂🙂",
            "data" => $formatUserDataResponse
        ],200);
    }
}
