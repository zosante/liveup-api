<?php
/**
 * Created by PhpStorm.
 * User: ayobami
 * Date: 4/11/2020
 * Time: 1:13 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests\AddGroupRequest;
use App\Models\Group;
use App\User;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function getAll(Request $request)
    {
        return $request->user()->groups()->get();
    }

    public function create(AddGroupRequest $request)
    {
        $user = $request->user();
        $group = Group::create($request->validated() + ['user_id' => $user->id,]);
        $user->groups()->attach($group->id);

        return $group;
    }
}
