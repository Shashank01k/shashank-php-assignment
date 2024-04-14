<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskUnAssignRequest;
use App\Services\TaskUnAssignService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskUnAssignController extends Controller
{
    //
    public function unAssignTask(TaskUnAssignRequest $taskUnAssignRequest, $userTaskId)
    {
        $validator = Validator::make(['userTaskId' => $userTaskId], [
            'userTaskId' => 'required|integer',
        ]);
        // dd($validator);
        
        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors()
                ], 400);
        } else{
            $UnAssignTaskResponse = TaskUnAssignService::unAssignTask($taskUnAssignRequest,$userTaskId);
            // dd($UnAssignTaskResponse);
            return $UnAssignTaskResponse;
        }
    }
}
