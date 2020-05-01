<?php

namespace Tests\Feature\Groups;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;

class GroupsTest extends FeatureTestCase
{
    use WithFaker;

    public function testCreateGroupSuccess()
    {
        $this->actingAs(factory(User::class)->create())
            ->postJson(route('api.user.groups.create'),[
                'name' => $this->faker->firstName,
                'description' => $this->faker->sentence(30),
            ])
            ->assertJsonStructure([
                'id', 'name'
            ])
            ->assertCreated();
    }
}
