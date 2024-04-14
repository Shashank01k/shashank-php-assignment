<?php

namespace App\Services;

use App\Constants\ViewUserConstant;
use App\Models\UsersTask;
use App\Utils\ViewUserUtils;
use Carbon\Carbon;

class TaskAssignService
{
    protected bool $usersTaskResponse = false;
    static function assignTask($payload)
    {
        // dd($payload);
        $error = ViewUserConstant::ERROR;
        $success = ViewUserConstant::SUCCESS;

        $payloadArray = $payload->toArray();
        $insertIntoUserTaskResponse = TaskAssignService::insertIntoUserTask($payloadArray);

        return $insertIntoUserTaskResponse;
        if($insertIntoUserTaskResponse == true)
        {
            return response()->json([
                "data" => $insertIntoUserTaskResponse,
                "status" => $success,
                'meessage' => "Task assign user successfully...✔️😄😄😄"
            ],200);

        }else{
            return response()->json([
                "data" => $insertIntoUserTaskResponse,
                "status" => $error,
                'meessage' => "Something went wrong need to check...😯😯😯"
            ],200);
        }
    }

    static function insertIntoUserTask($payloadArray)
    {
        $error = ViewUserConstant::ERROR;
        $success = ViewUserConstant::SUCCESS;

        // dd($payloadArray);
        foreach($payloadArray as $payloadValue){
            $taskId = (int) $payloadValue["task_id"];
            $userIdArray = $payloadValue["user_id"];

            $getUsersTaskMasterResponse = ViewUserUtils::getUsersTaskMasterDataById($taskId);
            if(!$getUsersTaskMasterResponse){
                return response()->json([
                    'data' => array('task_id' => $taskId),
                    'status' => $error,
                    'message' => "Task id not found in the `users_tasks_masters` table...",
                ], 200);
            }
           
            foreach($userIdArray as $userIdValue){

                $getUserDataResponse = ViewUserUtils::getUserDataById($userIdValue);
                if(!$getUserDataResponse){
                    return response()->json([
                        'data' => array('user_id' => $userIdValue),
                        'status' => $error,
                        'message' => "user id not found in the `users` table...",
                    ], 200);
                }

                $getUserTaskDataResponse = ViewUserUtils::getUserTaskDataByUserIdAndTaskId($userIdValue,$taskId);
                if($getUserTaskDataResponse){
                    return response()->json([
                        'data' => array('task_id' => $taskId, "user_id" => $userIdValue),
                        'status' => $success,
                        'message' => "Task already assigned to this user...",
                    ], 200);
                }

                $usersTask = new UsersTask();
                $usersTask->task_id = $taskId;
                $usersTask->user_id = (int) $userIdValue;
                $usersTask->due_date = ViewUserUtils::getAfterOneDayDateTime();
                $usersTask->updated_at = now();
                $usersTask->status = "0";
                $usersTaskResponse = $usersTask->save();
                // dd($userIdValue);
            }
        }
        // return $usersTaskResponse;
        return response()->json([
            "data" => $usersTaskResponse,
            "status" => $success,
            'meessage' => "Task assign user successfully...✔️😄😄😄"
        ],200);
    }
}