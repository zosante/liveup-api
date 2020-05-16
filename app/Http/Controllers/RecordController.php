<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;

class RecordController extends Controller
{
    public function getUserRecords(User $user)
    {
        /**
         * @var User $authUser
         */
        $authUser = auth()->user();

        $authUserGroups = $authUser->groups()->pluck('groups.id');
        $useGroups = $user->groups()->pluck('groups.id');

        abort_if($authUserGroups->intersect($useGroups)->isNotEmpty(), Response::HTTP_FORBIDDEN);

        return $user->symptomRecords;
    }
}
