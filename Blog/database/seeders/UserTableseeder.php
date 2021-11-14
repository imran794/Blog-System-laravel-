<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  DB:table('users')->insert([
        //     'role_id'    => '1',
        //     'name'       => 'MD.Admin',
        //     'username'   => 'admin',
        //     'email'      => 'admin@gmail.com',
        //     'password'   => bcrypt('123456789'),
            
        // ]);

        //  DB:table('users')->insert([
        //     'role_id'    =>  '2',
        //     'name'       => 'MD.Author',
        //     'username'   => 'author',
        //     'email'      => 'author@gmail.com',
        //     'password'   => bcrypt('123456789'),
            
        // ]);


          DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'MD.Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin.com'),
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'MD.Author',
            'username' => 'author',
            'email' => 'author@gmail.com',
            'password' => bcrypt('author.com'),
        ]);
    }
}
