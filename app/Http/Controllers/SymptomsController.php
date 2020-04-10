<?php

namespace App\Http\Controllers;

use App\Services\SymptomsService;

class SymptomsController extends Controller
{
    private SymptomsService $symptomsService;

    public function __construct(SymptomsService $symptomsService)
    {
        $this->symptomsService = $symptomsService;
    }

    public function getAll()
    {
        return $this->symptomsService->getAll();
    }
}
