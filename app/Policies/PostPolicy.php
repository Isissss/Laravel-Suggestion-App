<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;
    public function before(User $user)
    {
        if ($user->admin) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */

    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param Post $post
     * @return Response|bool
     */
    public function view(?User $user, Post $post)
    {
           return($post->category->active)
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return ($user->comments()->count() >= 3)
            ? Response::allow()
            : Response::deny('You have not reacted to 3 suggestions');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response|bool
     */
    public function update(User $user, Post $post)
    {
        if (!$post->user()->is($user)) {
            return $this->deny("You aren't authorized to edit this post");
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Post $post
     * @return Response|bool
     */
    public function delete(User $user, Post $post)
    {
        if (!$post->user()->is($user)) {
            return $this->deny("You aren't authorized to delete this post");
        } else {
            return true;
        }
    }



}
