<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    protected \Faker\Generator $faker;

    public function __construct(\Faker\Generator $faker)
    {
        $this->faker = $faker;
    }
}
