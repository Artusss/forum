<?php

namespace App\Policies;

use App\User;
use App\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
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
        return ($user && $user->is_admin()) ? true : null;
    }
    public function update(User $user, Topic $topic){
        return $user->id === $topic->author_id;
    }
    public function create(User $user){
        return $user->is_author();
    }
    public function delete(User $user, Topic $topic){
        return $user->id === $topic->author_id;
    }
    public function smashLike(User $user, Topic $topic){
        return $user->id !== $topic->author_id;
    }
}
