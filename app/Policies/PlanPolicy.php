<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
//        return $user->type != 'owner' || !empty($user->company);
        return true;
    }

    /**
     * Determine whether the user can subscribe to the plan.
     *
     * @param  \App\User  $user
     * @param  \Rinvex\Subscriptions\Models\Plan $plan
     * @return mixed
     */
    public function subscribe(User $user, $plan)
    {
        $type = $user->type;
        return
            ($type != 'owner' || !empty($user->company)) &&
            strncmp($type, $plan->slug, strlen($type)) === 0;
    }

}
