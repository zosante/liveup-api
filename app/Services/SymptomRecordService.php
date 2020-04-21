<?php

namespace App\Services;

use App\Models\SymptomRecord;
use App\Repositories\SymptomRecordRepository;
use App\User;

class SymptomRecordService
{
    private SymptomRecordRepository $symptomRecordRepository;

    public function __construct(SymptomRecordRepository $symptomRecordRepository)
    {
        $this->symptomRecordRepository = $symptomRecordRepository;
    }

    public function getLatestRecord(User $user, int $symptomId): SymptomRecord
    {
        return $this->symptomRecordRepository->getLatestWithSymptom($user, [
            'symptom_id' => $symptomId
        ]);
    }
}
