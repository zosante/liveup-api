<?php
/**
 * Created by PhpStorm.
 * User: ayobami
 * Date: 4/11/2020
 * Time: 3:31 PM
 */

namespace App\Http\Controllers;


use App\Models\Group;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
    public function addGroupUser(Group $group, Request $request)
    {
        $request->validate([
            'user_id' => 'required|int|exists:users,id',
        ]);
        $user = $request->user();
        $user_id = $request->get('user_id');
        $group = $user->groups()->where(['group_id'=>$group->id])->firstorFail();
        $group->user()->attach($user_id);
    }
}
