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

        if (!$request->user()->symptoms()->where('symptom_id', $symptom->id)->exists()) {
            $request->user()
                ->symptoms()
                ->attach($symptom->id);
        }

        $request->user()
            ->symptomRecords()
            ->create(
                $validated + [
                    'symptom_id' => $symptom->id,
                ]);

        return $symptom;
    }

    public function getAll(Request $request)
    {
        return $request->user()->symptoms;
    }

    public function getAllRecords($symptom, Request $request)
    {
        $validated = $request->validate([
            'severity' => 'nullable|int|between:0,10',
        ]);

        $symptom = $request->user()->symptoms()->findOrFail($symptom->id);

        return tap($symptom->records(), function ($query) use ($validated) {
            if ($validated['severity'] ?? false) {
                $query->where([
                    'severity' => $validated['severity'],
                ]);
            }
        })->get();
    }

    public function getOne($symptomId, Request $request)
    {
        $validated = $request->validate([
            'severity' => 'nullable|int|between:0,10',
            'with_records' => 'nullable|bool',
        ]);

        $user = $request->user();
        $symptom = $user->symptoms()->findOrFail($symptomId);

        return tap($symptom, function ($query) use ($user, $validated) {

            if ($validated['with_records'] ?? false) {
                $query->load(['records' => function ($query) use ($user, $validated) {

                    $query->where(['user_id' => $user->id]);

                    if ($validated['severity'] ?? false) {
                        $query->where([
                            'severity' => $validated['severity'],
                        ]);
                    }

                }]);
            }
        });

    }
}
