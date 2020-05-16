<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecordController extends Controller
{
    public function getUserRecords(User $user, Request $request)
    {
        /**
         * @var User $authUser
         */
        $authUser = auth()->user();

        $request->validate([
            'group_id' => [
                'required',
                'exists:groups,id'
            ],
        ]);

        $group = Group::findOrFail($request->input('group_id'));

        $count = $group->users()->whereIn('user_id', [$user->id, $authUser->id])
            ->count();

        abort_if($count < 2, Response::HTTP_FORBIDDEN);

        return $user->symptomRecords->groupBy('symptom_id');
    }
}
