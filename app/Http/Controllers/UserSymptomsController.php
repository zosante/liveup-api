<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class UserSymptomsController extends Controller
{
    public function add(Symptom $symptom, Request $request)
    {
        $validated = $request->validate([
            'severity' => 'required|int|between:0,10',
            'started_at' => 'nullable|date_format:Y-m-d H:i'
        ]);

        return $request->user()
            ->symptoms()
            ->save($symptom, $validated);
    }
}
