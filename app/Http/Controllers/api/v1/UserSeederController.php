<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\UserSeederService;
use Illuminate\Support\Facades\Validator;

class UserSeederController extends Controller
{
    public function runSeeder($seederCount = null)
    {
        $validator = Validator::make(['seederCount' => $seederCount], [
            'seederCount' => 'nullable|integer|max:100',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        } else{
            $seederResponse = UserSeederService::runUserSeeder($seederCount);
            // dd($seederResponse);
            return $seederResponse;
        }
        // dd($seederCount);
    }
    public function deleteSeederData($seederId = null)
    {
        $validator = Validator::make(['seederId' => $seederId], [
            'seederId' => 'nullable|regex:/^(?!.*,\0{1,})(?!.*,\Z)((?!0)\d{1,18},?){1,20}$/',
        ], [
            'seederId.regex' => 'The :attribute must be a comma-separated list of positive integers with no duplicates and maximum 20 elements and no extra spaces.',
            'seederId.*' => 'Each value in :attribute must be a positive integer.',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        } else{
            $seederResponse = UserSeederService::deleteUserSeederData($seederId);
            return $seederResponse;
        }
        // dd($seederId);
    }
}
