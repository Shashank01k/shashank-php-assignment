<?php

namespace App\Utils;

use App\Constants\ViewUserConstant;
use App\Models\User;
use App\Models\UsersTask;
use App\Models\UsersTaskMaster;
use Faker\Core\DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ViewUserUtils
{
    //TODO:add comment for every functions:

    protected array $allUserTaskArray;
    protected array $userDataArray;
    
    static function formatUserData(array $requestArray):array
    {
        foreach($requestArray as $requestValue){
            $utId = $requestValue['ut_id'];
            $utUserId = $requestValue['ut_user_id'];
            $utTaskId = $requestValue['ut_task_id'];
            $uName = $requestValue['u_name'];
            $uEmail = $requestValue['u_email'];
            $utmTask = $requestValue['utm_task'];
            $usersTasksTitle = $requestValue['users_tasks_title'] ?? 'NA';
            $usersTasksDescription = $requestValue['users_tasks_description'] ?? 'NA';
            $tomorrow = date("d M Y", time() + 86400);
            $usersTasksDueDate = $requestValue['users_tasks_due_date'] ?? $tomorrow;
            $usersTasksStatus = $requestValue['users_tasks_status'];
            $usersTasksCreatedAt = $requestValue['users_tasks_created_at'];
            $usersTasksUpdatedAt = $requestValue['users_tasks_updated_at'];
            $status = ViewUserConstant::USER_STATUS_MAP[$usersTasksStatus]?? 'Pending';

            $userDataArray[$utUserId]['USER NAME'] = ucwords($uName);
            $userDataArray[$utUserId]['USER EMAIL'] = $uEmail;
            $userDataArray[$utUserId][$utTaskId][$utId]['TASK'] = ucwords($utmTask);
            $userDataArray[$utUserId][$utTaskId][$utId]['TITLE'] = $usersTasksTitle;
            $userDataArray[$utUserId][$utTaskId][$utId]['DESCRIPTION'] = $usersTasksDescription;
            $userDataArray[$utUserId][$utTaskId][$utId]['DUE DATE'] = date('d M Y', strtotime($usersTasksDueDate));
            $userDataArray[$utUserId][$utTaskId][$utId]['STATUS'] = $status;
            $userDataArray[$utUserId][$utTaskId][$utId]['CREATED AT'] = date('d M Y', strtotime($usersTasksCreatedAt));
            $userDataArray[$utUserId][$utTaskId][$utId]['UPDATED AT'] = date('d M Y', strtotime($usersTasksUpdatedAt));
            $allUserTaskArray = $userDataArray;
        }
        return $allUserTaskArray;
    }

    static function currentDateTime()
    {
        return Carbon::now('Asia/Kolkata');
    }

    static function getUserStatusId(?string $status)
    {
        $statusId = '0';
        $getUserStatusMap = ViewUserConstant::USER_STATUS_MAP;
        if(in_array($status,$getUserStatusMap))
        {
            return $statusId = (string)array_search($status,$getUserStatusMap);
        }
        return $statusId;
    }
    
    static function getUsersTaskMasterDataById($taskId)
    {
        $usersTaskMaster = UsersTaskMaster::select('*')
        ->where('id', $taskId)->first();

        return $usersTaskMaster;
    }

    static function getUserDataById($userId)
    {
        $user = User::select('*')
        ->where('id', $userId)->first();
        return $user;
    }

    static function getUserData()
    {
        $user = User::all();
        return $user;
    }

    static function getUserTaskDataByUserIdAndTaskId($usersTasksUserId = '',$usersTasksTaskId = '', $userTaskId = '')
    {
        $usersTask = UsersTask::select('*');
        if($userTaskId != '')
        {
            $usersTask->where('id', $userTaskId);
        }
        if($usersTasksUserId != '')
        {
            $usersTask->where('user_id', $usersTasksUserId);
        }
        if($usersTasksTaskId != '')
        {
            $usersTask->where('task_id', $usersTasksTaskId);
        }
        $usersTask->where('is_deleted', 0);
        $getUsersTask = $usersTask->first();
        return $getUsersTask;
    }

    static function getUserTaskData(): object
    {
        $getUserTaskTableColumns = self::getUserTaskTableColumns();
        $usersTaskQuery = $getUserTaskTableColumns;

        $usersTask = $usersTaskQuery->where('users_tasks.is_deleted', 0)
        ->get();
        return $usersTask;
    }

    static function getUserDataByEmail(string $email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }

    static function getUserTaskDataByUserId(int $userTaskIdUserId)
    {
        $getUserTaskTableColumns = self::getUserTaskTableColumns();
        $usersTaskQuery = $getUserTaskTableColumns;

        $usersTask = $usersTaskQuery->where('users_tasks.user_id', $userTaskIdUserId)
        ->where('users_tasks.is_deleted', 0)->get();

        return $usersTask;
    }

    static function getUserTaskDataById(int $userTaskId)
    {
        $getUserTaskTableColumns = self::getUserTaskTableColumns();
        $usersTaskQuery = $getUserTaskTableColumns;

        $usersTask = $usersTaskQuery->where('users_tasks.id', $userTaskId)
        ->where('users_tasks.is_deleted', 0)->get();

        return $usersTask;
    }

    static function getUserTaskDataByUserIdStatusAndDueDate(array $dataArray)
    {
        $getUserTaskTableColumns = self::getUserTaskTableColumns();
        $usersTaskQuery = $getUserTaskTableColumns;

        foreach($dataArray as $dataKey => $dataValue){
            $dbColumn = ViewUserConstant::DEFAULT_USER_FILTER_COLUMN_ARRAY[$dataKey] ?? null;
            
            if ($dataValue !== null && $dbColumn !== null) {
                if($dbColumn == 'users_tasks.status')
                {
                    $statusId = self::getUserStatusId($dataValue);
                    $dataValue = $statusId;
                    $usersTaskQuery->where($dbColumn, $dataValue);
                }
                if($dbColumn == 'users_tasks.due_date')//TODO: need modify in due_date filter
                {
                    // $usersTaskQuery->where($dbColumn,'>=',$dataValue);
                    $getAfterOneDayDateTime = self::getAfterOneDayDateTime();
                    $usersTaskQuery->whereBetween($dbColumn,[$dataValue.' 00:00:00', $getAfterOneDayDateTime]);
                }
                if($dbColumn == 'users_tasks.assigned_user_id')
                {
                    $usersTaskQuery->where($dbColumn, $dataValue);
                }
            }
        }
        $usersTaskQuery->where('users_tasks.is_deleted', 0);
        $usersTask = $usersTaskQuery->get();
        // $data = $usersTaskQuery->toSql();
        // dd($data);
        // dd($usersTask);
        return $usersTask;
    }

    /**
     * Retrieve user task table columns.
     *
     * This function fetches data related to user tasks and additional details.
     * It performs a left join on the users and users_tasks_masters tables.
     *
     * @return \Illuminate\Database\Eloquent\Builder The query builder instance.
     */

    static function getUserTaskTableColumns():Builder
    {
        // Construct the query to fetch user task table columns
        $usersTask = UsersTask::leftJoin('users AS u', 'users_tasks.user_id', '=', 'u.id')
        ->leftJoin('users_tasks_masters AS utm', 'users_tasks.task_id', '=', 'utm.id')
        ->select(
            'users_tasks.id AS ut_id',
            'users_tasks.user_id AS ut_user_id',
            'users_tasks.task_id AS ut_task_id',
            'u.name AS u_name',
            'u.email AS u_email',
            'utm.task AS utm_task',
            'users_tasks.title AS users_tasks_title',
            'users_tasks.description AS users_tasks_description',
            'users_tasks.due_date AS users_tasks_due_date',
            'users_tasks.status AS users_tasks_status',
            'users_tasks.created_at AS users_tasks_created_at',
            'users_tasks.updated_at AS users_tasks_updated_at'
        );
        return $usersTask;
    }

    static function getAfterOneDayDateTime()
    {
        $currentDateTime = Carbon::now();
        // Add one day to the current date and time
        return $currentDateTime->addDay();
    }

    static function getUsersTaskMasterData()
    {
        $usersTaskMaster = UsersTaskMaster::select('*')->get();
        return $usersTaskMaster;
    }

    static function formattedUserTaskMasterData(array $payloadArray)
    {
        // dd($payloadArray);
        $allResponseArray = [];
        foreach($payloadArray as $payloadValue){
            // dd($payloadValue);
            $id = $payloadValue['id'];
            $task = $payloadValue['task'];
            $created_at = $payloadValue['created_at'];
            $updated_at = $payloadValue['updated_at'];
            $userTaskMasterArray['TASK ID'] = $id;
            $userTaskMasterArray['TASK NAME'] = $task;
            $userTaskMasterArray['CREATED DATE'] = $created_at;
            $userTaskMasterArray['UPDATED DATE'] = $updated_at;
            $allResponseArray[] = $userTaskMasterArray;
        }
        return $allResponseArray;
    }

}