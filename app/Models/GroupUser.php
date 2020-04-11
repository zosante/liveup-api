<?php
/**
 * Created by PhpStorm.
 * User: ayobami
 * Date: 4/11/2020
 * Time: 3:23 PM
 */

namespace App\Models;


use App\User;
use App\Group;

class GroupUser extends Model
{
    protected $table = 'group_user';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsTo(Group::class);
    }
}
