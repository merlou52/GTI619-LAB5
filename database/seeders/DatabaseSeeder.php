<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    //TODO remplir la db avec des utilisateurs, des rôles, des client et une association user<->rôle
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Creates 10 random clients
         */

         \App\Models\Client::factory(10)->create();

        /**
         * Creates the 3 users (admin, user1 and user2)
         */

        DB::table('users')->insert([
            'id'=> 1,
            'name' => 'Administrateur',
            'email' => 'admin@gti619.net',
            'password' => Hash::make('super1mot2passe'),
            'remember_token' => Str::random(20),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Utilisateur1',
            'email' => 'user1@gti619.net',
            'password' => Hash::make('tropb1en'),
            'remember_token' => Str::random(20),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Utilisateur2',
            'email' => 'user2@gti619.net',
            'password' => Hash::make('wow56affaires'),
            'remember_token' => Str::random(20),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        /**
         * Creates the 3 roles (admin, clients, affaires)
         */

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'ROLE_ADMIN',
            'description' => 'rôle administrateur',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'ROLE_PREPOSE_CLIENTS_RESIDENTIELS',
            'description' => 'rôle préposé aux clients résidentiels',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'ROLE_PREPOSE_CLIENTS_AFFAIRE',
            'description' => 'rôle préposé aux clients affaires',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        /**
         * Creates the links users-roles
         */

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        /**
         * Creates the differents types of clients
         */

        DB::table('types')->insert([
            'id' => 1,
            'name' => 'CLIENT_AFFAIRES',
            'description' => 'client professionnel ayant un contact privilégié',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('types')->insert([
            'id' => 2,
            'name' => 'CLIENT_RESIDENTIEL',
            'description' => 'client residentiel',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        /**
         * Creates the links types - client
         */

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 5,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 6,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 7,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 8,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 9,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('client_type')->insert([
            'type_id' => rand(1,2),
            'client_id' => 10,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

    }
}
