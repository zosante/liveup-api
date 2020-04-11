<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Services\SymptomService;
use Illuminate\Http\Request;

class SymptomsController extends Controller
{
    private SymptomService $symptomService;

    public function __construct(SymptomService $symptomService)
    {
        $this->symptomService = $symptomService;
    }

    public function getAll()
    {
        /**
         * Getting models through a service class
         */
        return $this->symptomService->getAll();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|unique:symptoms,name',
            'description' => 'nullable|min:2',
        ]);

        $data = $request->only([
            'name', 'description'
        ]);

        /**
         * Accessing model directly
         */
        return Symptom::create($data);
    }
}
