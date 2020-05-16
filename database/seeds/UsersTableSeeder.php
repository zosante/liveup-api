<?php

use Database\Seeds\BaseSeeder;

class UsersTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::updateOrcreate([
            'email' => 'test@example.com',
        ], [
            'name'     => $this->faker->name,
            'password' => bcrypt('KHJ97ysahisa8a09yo8diaugs8b'),
        ]);

        \App\User::updateOrCreate([
            'email' => 'test2@example.com',
        ], [
            'name'     => $this->faker->name,
            'password' => bcrypt('KHJ97ysahsisa8a09yoa8diaugsaawe8b'),
        ]);
    }
}
