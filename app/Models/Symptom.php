<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $guarded = ['id'];

    public function records()
    {
        return $this->hasMany(SymptomRecord::class, 'symptom_id', 'id');
    }
}
