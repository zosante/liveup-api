<?php

use Database\Seeds\BaseSeeder;

class SymptomsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Symptom::create([
            'name' => $this->faker->name,
            'description' => $this->faker->sentence
        ]);
    }
}
