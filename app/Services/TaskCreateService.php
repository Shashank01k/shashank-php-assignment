<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersTask;
use App\Models\UsersTaskMaster;
use App\Utils\ViewUserUtils;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TaskCreateService
{

    public function insertUserData($payload)
    {
        $UserDataArray = $payload->data;
        // $formattedUserDataResponse = true;
        $formattedUserDataResponse = $this->insertIntoUserTable($UserDataArray);
        if($formattedUserDataResponse == true)
        {
            return response()->json([
                "data" => $formattedUserDataResponse,
                "email_prefix" => 'user_'.Str::random(5),
                "status" => 'success',
                'meessage' => "Data insert into successfully...✔️😄😄😄"
            ],200);

        }
    }

    public function insertIntoUserTable(array $payloadArray) : bool
    {
        // dd($payload);
        foreach($payloadArray as $payloadValue){
            $name = $payloadValue['name'];
            $email = $payloadValue['email'];
            $title = $payloadValue['title'] ?? null;
            $description = $payloadValue['description'] ?? null;
            $due_date = $payloadValue['due_date'];

            $status = $payloadValue['status'];
            $statusId = ViewUserUtils::getUserStatusId($status);
            
            $password = $payloadValue['password'];
            $passwordHash = Hash::make($password);
            
            $user = new user();
            $user->name = $name;
            $user->email = $email;
            $user->password = $passwordHash;
            $user->remember_token = $password;
            $user->title = $title;
            $user->due_date = $due_date.' '.date('H:i:s');
            $user->description = $description;
            $user->status = $statusId;
            $userResponse = $user->save();
            // dd($userResponse);
        }
        return $userResponse;
    }

    public function createUsertask($payload)
    {
        $UserDataArray = $payload->data;
        $createTaskResponse = $this->createTask($UserDataArray);

        if($createTaskResponse == true)
        {
            $getUsersTaskMasterData = ViewUserUtils::getUsersTaskMasterData();
            $userTaskMasterDataArray = $getUsersTaskMasterData->toArray();
            $formattedUserTaskMasterData = ViewUserUtils::formattedUserTaskMasterData($userTaskMasterDataArray);

            return response()->json([
                "status" => 'success',
                'meessage' => "New Task created successfully...✔️😄😄😄",
                "data" => $formattedUserTaskMasterData
            ],200);
        }
        else
        {
            return response()->json([
                "data" => $createTaskResponse,
                "status" => 'error',
                'meessage' => "Getting error while creating task...😥😥😥"
            ],200);
        }
    }

    public function createTask(array $payload)
    {
        foreach($payload['task'] as $payloadValue){
            $usersTaskMaster = new UsersTaskMaster();
            $usersTaskMaster->task = $payloadValue;
            $usersTaskResponse = $usersTaskMaster->save();
        }
        return $usersTaskResponse;
    }
}