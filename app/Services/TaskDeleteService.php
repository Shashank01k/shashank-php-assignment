<?php

namespace App\Services;

use App\Models\UsersTaskMaster;
use Illuminate\Http\JsonResponse;

class TaskDeleteService
{
    static function deleteTask(int $taskId) : JsonResponse
    {
        try
        {
            // echo 98; die;
            $usersTaskMaster = UsersTaskMaster::where('id', $taskId)->update([
                'deleted_at' => now(),
                'is_deleted' => 1,
            ]);
            // dd($usersTaskMaster);
        } catch (\Exception $e) {
            
            return response()->json(['status' => 'error','message' => 'Database error'], 500);
        }
        $message = "Task Deleted Successfully.✔️👍😎";

        if($usersTaskMaster == 0)
        {
            $message = "This task already deleted.😐😐😐";
        }
        return response()->json(
            [
                'message' => $message, 
                'status' => 'success'
        ], 200);
    }
}