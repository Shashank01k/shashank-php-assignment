<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\TaskDeleteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskDeleteController extends Controller
{
    //
    public function deleteTask($taskId = null)
    {
        $validator = Validator::make(['taskId' => $taskId], [
            'taskId' => 'required|integer',
        ]);
        // dd($validator);
        
        if ($validator->fails()) {
            return response()->json(
                [
                    'errors' => $validator->errors()
                ], 400);
        } else{
            // echo "test :: update"; die;
            $updateUserDataResponse = TaskDeleteService::deleteTask($taskId);
            // dd($updateUserDataResponse);
            return $updateUserDataResponse;
        }
    }
}
