<?php

namespace App\Services;

use App\Models\UsersTask;
use App\Models\UsersTaskMaster;
use App\Utils\ViewUserUtils;

class TaskUnAssignService
{
    static function unAssignTask($payload,$userTaskId)
    {
        $payloadArray = $payload->toarray();
        $response = TaskUnAssignService::validateIdAndPayloadAndUnassignTask($payloadArray,$userTaskId);
        return $response;
    }

    static function validateIdAndPayloadAndUnassignTask(array $payloadArray, $userTaskId)
    {
        $getUserTaskDataByUserId = ViewUserUtils::getUserTaskDataById($userTaskId);
        if($getUserTaskDataByUserId->isEmpty()){
            return response()->json([
                'data' => array('userTaskTableId' => $getUserTaskDataByUserId),
                'status' => 'error',
                'message' => "Id not found in the `users_tasks` table...☹️☹️☹️",
            ], 200);
        }
        $getUserTaskArray = $getUserTaskDataByUserId->toArray();
        $utUserId = $getUserTaskArray[0]['ut_user_id'];
        $utTaskId = $getUserTaskArray[0]['ut_task_id'];

        foreach($payloadArray as $payloadValue){
            $userId = (int) $payloadValue["user_id"];
            $taskId = (int) $payloadValue["task_id"];
            // dd($userId);
            
            if($utUserId != $userId){
                return response()->json([
                    'data' => array('userId' => $userId),
                    'status' => 'error',
                    'message' => "user id not found in the `users_tasks` table...☹️☹️☹️",
                ], 200);
            }

            if($utTaskId != $taskId){
                return response()->json([
                    'data' => array('taskId' => $taskId),
                    'status' => 'error',
                    'message' => "Task id not found in the `users_tasks` table...☹️☹️☹️",
                ], 200);
            }

            $usersTaskResponse = UsersTask::where('id', $userTaskId)->update([
                'deleted_at' => now(),
                'is_deleted' => 1,
            ]);
            $message = "Task Unassign successfully...✔️👍😎";

            if($usersTaskResponse == 0)
            {
                $message = "This task already Unassign.😐😐😐";
            }
        }

        return response()->json([
            "status" => 'success',
            "data" => $usersTaskResponse,
            'meessage' => $message
        ],200);
    }
}