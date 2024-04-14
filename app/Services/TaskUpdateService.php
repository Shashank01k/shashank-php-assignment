<?php

namespace App\Services;

use App\Constants\ViewUserConstant;
use App\Models\User;
use App\Models\UsersTaskMaster;
use App\Utils\ViewUserUtils;

class TaskUpdateService
{
    static function updateTask($requestPayload, $userId)
    {
        $success = ViewUserConstant::SUCCESS;
        $error = ViewUserConstant::ERROR;

        $usersTaskMaster = ViewUserUtils::getUsersTaskMasterDataById($userId);
        if($usersTaskMaster === null)
        {
            return response()->json([
                    'status' => $error,
                    'message' => 'Given task id not found in the system!🤔🤔🤔'
            ], 200);
        }
            
        $usersTaskMaster->task = $requestPayload['data']['task'];
        $usersTaskMaster->updated_at = now();
        $usersTaskMaster->save();
            
        $usersTaskMasterArray = array($usersTaskMaster->toArray());
        $formattedUserTaskMasterData = ViewUserUtils::formattedUserTaskMasterData($usersTaskMasterArray);
        if(count($usersTaskMaster->getChanges()) == 0)
        {
            return response()->json(
                [
                    'status' => $success,
                    'message' => 'This Task already updated...✔️😃😃😃',
                    'data' => $formattedUserTaskMasterData
            ], 200);
        }

        return response()->json(
            [
                'status' => $success,
                'message' => 'New Task updated successfully...✔️😃😃😃',
                'data' => $formattedUserTaskMasterData
        ], 200);
    }
}