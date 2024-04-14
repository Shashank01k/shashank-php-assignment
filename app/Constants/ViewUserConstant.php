<?php 

namespace App\Constants;

class ViewUserConstant
{
    public const USER_STATUS_MAP = [
        0 => 'Pending',
        1 => 'In-Progress',
        2 => 'Completed'
    ];

    public const DEFAULT_USER_FILTER_COLUMN_ARRAY = [
        'assigned_user_id' => 'users_tasks.user_id',
        'status' => 'users_tasks.status',
        'due_date' => 'users_tasks.due_date'
    ];

    public const ERROR = 'error';
    public const SUCCESS = 'success';
}