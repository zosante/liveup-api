<?php

namespace Tests\Feature\Record;

use App\Models\Group;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\FeatureTestCase;

class RecordTest extends FeatureTestCase
{
    use WithFaker;

    public function testGetOthersRecordsSuccess()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $group = factory(Group::class)->create([
          'user_id' => $user1->id
        ]);

        $group->users()->attach([$user1->id, $user2->id,]);

        $this->actingAs($user2)->getJson(route('api.users.records', $user1->id))
            ->assertSuccessful();
    }
}
