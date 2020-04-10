<?php

namespace App\Repositories;

use App\Models\Symptom;

class SymptomRepository extends BaseRepository
{
    public function __construct(Symptom $symptom)
    {
        $this->model = $symptom;
    }
}
