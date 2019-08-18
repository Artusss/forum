<?php

namespace App\Policies;

use App\User;
use App\Decision;
use Illuminate\Auth\Access\HandlesAuthorization;

class DecisionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user){
        return $user->is_admin() ? true : null;
    }
    public function update(User $user, Decision $decision){
        return $user->id === $decision->author_id;
    }
    public function delete(User $user, Decision $decision){
        return $user->id === $decision->author_id;
    }
}
