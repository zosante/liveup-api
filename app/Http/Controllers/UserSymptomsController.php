<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\User;
use Illuminate\Http\Request;

class UserSymptomsController extends Controller
{
    public function getAll(Request $request)
    {
        return $request->user()->symptoms()->get();
    }

    public function getOneFromList($symptomId, Request $request)
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

    public function getSymptomRecords($symptom, Request $request)
    {
        $validated = $request->validate([
            'severity' => 'nullable|int|between:0,10',
        ]);

        $symptom = $request->user()->symptoms()->findOrFail($symptom);
        $records = $request->user()->symptomRecords()->where('symptom_id', $symptom->id);

        return tap($records, function ($query) use ($validated) {
            if ($validated['severity'] ?? false) {
                $query->where([
                    'severity' => $validated['severity'],
                ]);
            }
        })->get();
    }

    public function addSymptomRecord(Symptom $symptom, Request $request)
    {
        $validated = $request->validate([
            'severity' => 'required|int|between:0,10',
            'started_at' => 'nullable|date_format:Y-m-d H:i'
        ]);

        if (!$request->user()
            ->symptoms()
            ->where('symptom_id', $symptom->id)
            ->exists()) {
            $request->user()
                ->symptoms()
                ->attach($symptom->id);
        }

        return $this->createSymptomRecord($request->user(), $symptom, $validated);
    }

    protected function createSymptomRecord(User $user, Symptom $symptom, array $record)
    {
        return $user->symptomRecords()
            ->create($record + ['symptom_id' => $symptom->id,])
            ->load('symptom');
    }
}
