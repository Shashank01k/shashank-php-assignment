<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskUpdateRequest;
use App\Services\TaskUpdateService;
use Illuminate\Support\Facades\Validator;

class TaskUpdateController extends Controller
{
    //
    protected array $taskUpdateRequest;

    public function updateTask(TaskUpdateRequest $taskUpdateRequest, $taskId = null)
    {
        $validator = Validator::make(['taskId' => $taskId], [
            'taskId' => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors()
                ], 400);
        } else{
            $updateUserDataResponse = TaskUpdateService::updateTask($taskUpdateRequest,$taskId);
            return $updateUserDataResponse;
        }
    }
}
