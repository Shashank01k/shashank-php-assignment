<?php 

namespace App\Services;

use App\Models\User;
use App\Utils\ViewUserUtils;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Support\Facades\DB;

class UserSeederService
{
    static function runUserSeeder(int $count = null)
    {
        $databaseSeeder = new UsersTableSeeder;
        $databaseSeederResponse = $databaseSeeder->run($count);
        if($databaseSeederResponse)
        {
            $getUserData = ViewUserUtils::getUserData();
            $userDataArray = $getUserData->toArray();
            return response()->json([
                'status' => 'success',
                'message' => "User Data Inserted Successfully.✔️👍😎",
                'data' => $userDataArray
            ],200);
        } else {
            return response()->json([
                'data' => $databaseSeederResponse,
                'status' => 'error',
                'message' => "Get error while Seeder data inserting from user table.😥"
            ],500);
        }
    }

    static function deleteUserSeederData($commaSeparatedString)
    {
        // $commaSeparatedString ;
        // print_R($commaSeparatedString);
        if($commaSeparatedString != '' || $commaSeparatedString != null)
        {
            $collectIds = collect(explode(",", $commaSeparatedString))->unique();
            try
            {
                // User::whereIn('id', $collectIds)->delete();//for soft delete
                $user = User::whereIn('id', $collectIds)->update([
                    'deleted_at' => now(),
                    'is_deleted' => 1,
                ]);
            } catch (\Exception $e) {
               
                return response()->json(['error' => 'Database error'], 500);
            }
            $message = "User Seeder Data Deleted Successfully.✔️👍😎";
        }
        else
        {
            try
            {
                $user = User::query()->update([
                    'deleted_at' => now(),
                    'is_deleted' => 1,
                ]);

                /*
                    //START: a transaction
                        DB::beginTransaction();
                        
                        // User::query()->update(['is_deleted' => 1]);
                        // User::query()->delete();//using for soft delete

                        DB::commit();
                    //END: Commit the transaction
                */
            } catch (\Exception $e) {
                /*
                    // Rollback the transaction if an exception occurs
                    DB::rollBack();
                */
                return response()->json(['error' => 'Database error'], 500);
            }
            $message = "User All Seeder Data Deleted Successfully.✔️👍😎";
        }
        if($user == 0)
        {
            $message = "This user data already deleted.😐😐😐";
        }
        // dd($user);
        return response()->json(['message' => $message, 'status' => 'success'], 200);
    }

    public function truncateUserSeedData()
    {
        // Delete all records from the users table
        User::truncate();

        return response()->json(['message' => 'Seed data truncate(delete) forever successfully!'], 200);
    }
}