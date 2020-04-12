<?php

namespace App\Repositories;

use App\Models\SymptomRecord;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SymptomRecordRepository extends BaseRepository
{
    public function __construct(SymptomRecord $model)
    {
        $this->model = $model;
    }

    public function getLatestWithSymptom(User $user, array $attributes = []): SymptomRecord
    {
        $record = tap($user->symptomRecords(), function (HasMany $query) use ($attributes) {
            if ($attributes) {
                $query->where($attributes);
            }
        })->latest()
            ->firstOrFail();

        return $this->load('symptom', $record);
    }
}
