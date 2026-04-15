<?php

namespace App\Policies;

use App\Models\Income;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IncomePolicy
{
    public function update(User $user, Income $income): Response
    {
        return $user->id === $income->user_id
            ? Response::allow()
            : Response::deny('You do not own this income.');
    }

    public function delete(User $user, Income $income): Response
    {
        return $user->id === $income->user_id
            ? Response::allow()
            : Response::deny('You do not own this income.');
    }
}
