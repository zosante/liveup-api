<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsToMany(User::class, "group_user");
    }

}
