<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = [
          [
             'name'=>'Admin User',
             'email'=>'admin@email.com',
             'type'=>1,
             'password'=> bcrypt('secret'),
          ],
          [
             'name'=>'Manager User',
             'email'=>'manager@email.com',
             'type'=> 2,
             'password'=> bcrypt('secret'),
          ],
          [
             'name'=>'User',
             'email'=>'user@email.com',
             'type'=>0,
             'password'=> bcrypt('secret'),
          ],
      ];

      foreach ($users as $key => $user) {
          User::create($user);
      }
    }
}
