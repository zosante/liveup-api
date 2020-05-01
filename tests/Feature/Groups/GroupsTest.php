<?php

namespace Tests\Feature\Groups;

use App\User;
use Tests\Feature\FeatureTestCase;

class GroupsTest extends FeatureTestCase
{
    public function testCreateGroup()
    {
        $this->actingAs(factory(User::class))
            ->postJson(route('api.groups.create'));
    }
}
