<?php

namespace App\Services;

use App\Repositories\SymptomRepository;

class SymptomsService
{
//    private SymptomRepository $symptomRepository;
    private  $symptomRepository;
    public function __construct(SymptomRepository $symptomRepository)
    {
        $this->symptomRepository = $symptomRepository;
    }

    public function getAll()
    {
        return $this->symptomRepository->getAll();
    }
}
