<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'georgz', 'email' => "admin@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 1],
            ['id' => 2, 'name' => 'Ardit', 'email' => "eros0820@protonmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 3, 'name' => 'John', 'email' => "john@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 3],
            ['id' => 4, 'name' => 'Panda', 'email' => "panda@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 3],
            ['id' => 5, 'name' => 'Ted', 'email' => "ted@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 6, 'name' => 'Angel', 'email' => "angel@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 7, 'name' => 'Kinda', 'email' => "kinda@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 8, 'name' => 'Johnson', 'email' => "johnson@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 9, 'name' => 'Mary', 'email' => "mary@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 10, 'name' => 'Gaz', 'email' => "gaz@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 11, 'name' => 'Surin', 'email' => "surin@gmail.com", 'password' => '$2a$10$epVj4MXedq9N6yk7P2uGNewBWKh11NhnnOHgIqnfoIb20jTeM7wbq', 'is_valid' => true, 'id_role' => 2],
            ['id' => 12, 'name' => 'Petr', 'email' => "jetfightzer@gmail.com", 'password' => '$2y$12$/eUjSM9qdr0cgKO7vWfHfe5HDTjWtQuqFI2Rgx19BlH.FDkTZm.SG', 'is_valid' => true, 'id_role' => 1],

        ];
        foreach($items as $item)
        {
            \App\Models\User::create($item);
        }
    }
}
