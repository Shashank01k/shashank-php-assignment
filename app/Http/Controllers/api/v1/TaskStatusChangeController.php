<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStatusChangeRequest;
use App\Services\TaskStatusChangeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskStatusChangeController extends Controller
{
    //
    public function changeTaskStatus(TaskStatusChangeRequest $taskStatusChangeRequest, $taskUserTableId = NULL)
    {
        $validator = Validator::make(['taskUserTableId' => $taskUserTableId], [
            'taskUserTableId' => 'required|integer',
        ]);
        // dd($taskStatusChangeRequest);
        
        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors()
                ], 400);
        } else{
            $updateUserTaskStatusResponse = TaskStatusChangeService::changeTaskStatus($taskStatusChangeRequest,$taskUserTableId);
            // dd($updateUserTaskStatusResponse);
            return $updateUserTaskStatusResponse;
        }
    }

}
