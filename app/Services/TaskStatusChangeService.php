<?php

namespace App\Services;

use App\Models\UsersTask;
use App\Utils\ViewUserUtils;

class TaskStatusChangeService
{
    static function changeTaskStatus($requestPayload, $taskUserTableId)
    {
        $usersTask = UsersTask::find($taskUserTableId);
        if($usersTask === null)
        {
            return response()->json(
                [
                'status' => 'success',
                'message' => 'Given user task id not found in the system!🤔🤔🤔'
            ], 200);
        }
    //  dd($requestPayload['data']);

        $status = $requestPayload['data']['status'];
        $statusId = ViewUserUtils::getUserStatusId($status);

        $usersTask->status = $statusId;
        $usersTask->save();

        if(count($usersTask->getChanges()) == 0)
        {
            return response()->json(
                [
                    'data' => $usersTask,
                    'status' => 'success',
                    'message' => 'This Task Status already updated...✔️😃😃😃'
            ], 200);
        }

        return response()->json(
            [
                'data' => $usersTask,
                'status' => 'success',
                'message' => 'Task status updated successfully...✔️😃😃😃'
        ], 200);
    }
}