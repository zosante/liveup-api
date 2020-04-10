<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Services\SymptomsService;
use Illuminate\Http\Request;

class SymptomsController extends Controller
{
    private SymptomsService $symptomsService;

    public function __construct(SymptomsService $symptomsService)
    {
        $this->symptomsService = $symptomsService;
    }

    public function getAll()
    {
        /**
         * Getting models through a service class
         */
        return $this->symptomsService->getAll();
    }

    public function create(Request $request)
    {
        $data = $request->input([
            'name', 'description'
        ]);

        /**
         * Accessing model directly
         */
        return Symptom::create($data);
    }
}
