<?php
/**
 * Created by PhpStorm.
 * User: ayobami
 * Date: 4/11/2020
 * Time: 3:31 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\AddGroupUserRequest;
use App\Models\Group;

class GroupUserController extends Controller
{
    public function addGroupUser(Group $group, AddGroupUserRequest $request)
    {
        $user = $request->user();
        $user_id = $request->get('user_id');
        $group = $user->groups()->where(['group_id' => $group->id])->firstorFail();

        return tap($group, function ($group) use ($user_id) {
            $group->users()->attach($user_id);
        });
    }
}
