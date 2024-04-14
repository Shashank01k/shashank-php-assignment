<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected static ?array $userFakeData;

    public function run($count = null)
    {
        $count = $count ?? 5;
        /**
         * insert data 5 times if not get
         */
        for ($i = 0; $i < $count; $i++) {
            $userFactory = new UserFactory;
            $userFakeData[] = $userFactory->userFakeData();
        }
        $user = User::insert($userFakeData);
        return $user;
        // $user = User::create($userFakeData[0]);
        // $token = $user->createToken('mytoken')->plainTextToken;//TODO:
    }
}
