<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSymptom extends Model
{
    protected $table = 'symptom_user';

    protected $guarded = ['id'];
}
