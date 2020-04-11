<?php
/**
 * Created by PhpStorm.
 * User: ayobami
 * Date: 4/11/2020
 * Time: 3:31 PM
 */

namespace App\Http\Controllers;


use App\Models\GroupUser;

class GroupUserController extends Controller
{
    public function addGroupUser(GroupUser $groupuser)
    {

        return GroupUser::create(['user_id'=>$groupuser->user_id,'group_id'=>$groupuser->group_id]);
    }
}
