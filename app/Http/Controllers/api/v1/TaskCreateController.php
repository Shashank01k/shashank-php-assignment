<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;
use App\Services\TaskCreateService;
use App\Http\Requests;

class TaskCreateController extends Controller
{
    protected object $taskCreateService;
    //
    public function __construct(TaskCreateService $taskCreateService) {
        $this->taskCreateService = $taskCreateService;
    }

    public function create(TaskCreateRequest $requestPayload){
        $insertUserDataResponse = $this->taskCreateService->insertUserData($requestPayload);
        // $insertUserDataResponse = taskCreateService::insertUserData($requestPayload);
        // dd($insertUserDataResponse);
        return $insertUserDataResponse;
    }
    public function createTask(TaskCreateRequest $requestPayload){

        $insertUserDataResponse = $this->taskCreateService->createUsertask($requestPayload);
        // dd($insertUserDataResponse);
        return $insertUserDataResponse;
    }
}
