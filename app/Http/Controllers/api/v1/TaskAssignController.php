<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskAssignRequest;
use App\Services\TaskAssignService;
use Illuminate\Http\Request;

class TaskAssignController extends Controller
{
    public function assignTask(TaskAssignRequest $taskAssignRequest){
        $assignTaskResponse = TaskAssignService::assignTask($taskAssignRequest);
        // dd($assignTaskResponse);
        return $assignTaskResponse;
    }
}
