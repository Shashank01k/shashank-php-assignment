<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSearchRequest;
use App\Services\UserSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSearchController extends Controller
{
    //
    public function search(UserSearchRequest $UserSearchRequest){
        // dd($UserSearchRequest);
        $filterUsersTaskResponse = UserSearchService::filterUsersTask($UserSearchRequest);
        // dd($filterUsersTaskResponse);
        return $filterUsersTaskResponse;
    }
}
