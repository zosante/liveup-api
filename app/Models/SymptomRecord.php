<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SymptomRecord extends Model
{
    protected $table = 'symptom_records';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }
}
